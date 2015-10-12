<?php

$app->get('/home(/:page(/:name(/:occupation(/:company(/:city(/:country(/:category)))))))', function ($page = 1, $name='$', $occupation='$', $company='$', $city='$', $country='$', $category='$') use ($use) {
    session("user_id");
    $use->template->prepare('home.html');
    
    // hooks for cards list
    $cards_param = (object) ["page"=>$page, "name"=>$name, "occupation"=>$occupation, "company"=>$company, "city"=>$city, "country"=>$country, "category"=>$category, 'results' => [], 'found'=>true];
    $use->app->applyHook('cards', $cards_param);
    
    // hooks for pagging
    $pages_param = (object) ["page"=>$page, "name"=>$name, "occupation"=>$occupation, "company"=>$company, "city"=>$city, "country"=>$country, "category"=>$category, 'results' => []];
    $use->app->applyHook('pagging', $pages_param);
    
    // hooks for autocomplete hints
    $hint_param = (object) ['name' => "", 'company' => "", 'occupation' => "", 'country' => "", 'category' => ""];
    $use->app->applyHook('hint', $hint_param);
    
    $use->template->param("privilege", Privilege($use->users["permission"]));
    
    //users detail
    $use->template->param("users", $use->users);
    
    // cards list data
    $use->template->param("cards", $cards_param->results["cards"]);
    $use->template->param("cards_count", $cards_param->results["count"]);
    
    // if cards not found
    $use->template->param("cards_found", $cards_param->found);
    
    // hint autocomplete for search form
    $use->template->param("hint", array(
        "name"=>'',
        "company"=>$hint_param->company,
        "occupation"=>$hint_param->occupation,
        "country"=>$hint_param->country,
        "category"=>$hint_param->category,
    ));
    
    // url list
    $use->template->param("url", array(
            "company-list"=>$use->app->urlFor('company-list', array("page"=>'')),
            "occupation-list"=>$use->app->urlFor('occupation-list', array("page"=>'')),
            "country-list"=>$use->app->urlFor('country-list', array("page"=>'')),
            "category-list"=>$use->app->urlFor('category-list', array("page"=>'')),
            "new"=>$use->app->urlFor('new'),
//            "activation"=>$use->app->urlFor('doregsiter', array('resend'=>'true','user_id'=>$use->users["user_id"],'email'=>$use->users["email"])),
    ));
    
    // check if account is activated
    $use->template->param("activated", ($use->users["activated"] == 0 ? true : false));
    if(count($use->groups) < 1 && $use->users["permission"] != "superuser"){
        $use->template->param("no_group", true);
//        $data_mst["url"]["group_register"]="http://google.com";
    }
    // parameter list
    $use->template->param("parameter",array(
            "search"=>($name != '$' || $occupation != '$' || $company != '$' || $city != '$' || $country != '$' || $category != '$' ? true : false),
            "name"=>($name != '$' ? $name : false),
            "occupation"=>($occupation != '$' ? $occupation : false),
            "company"=>($company != '$' ? $company : false),
            "city"=>($city != '$' ? $city : false),
            "country"=>($country != '$' ? $country : false),
            "category"=>($category != '$' ? $category : false)
    ));
    
    $use->template->param("counter", array(
        "cards"=>$use->db->query("select count(card_id) from cards")->fetchColumn(),
        "users"=>$use->db->query("select count(user_id) from users")->fetchColumn(),
        "groups"=>$use->db->query("select count(group_id) from groups")->fetchColumn(),
    ));

    
    // pagging
    $use->template->param("page", $pages_param->results["pagging"]);
    $use->template->param("page_count", ($page*10));
    $use->template->param("page_now", ($page*10)-9);
    
    $use->template->execute();
})->name('home');

$app->post('/search', function () use ($use) {
    $name       = $use->app->request->post('name');
    $company    = $use->app->request->post('company');
    $occupation = $use->app->request->post('occupation');
    $country_city    = explode(',', $use->app->request->post('country'));
    $category   = $use->app->request->post('category');
    $city = (isset($country_city[1]) ? $country_city[0] : null);
    $country = (isset($country_city[1]) ? $country_city[1] : $country_city[0]);
    $use->app->redirect($use->app->urlFor('home', array(
        "page"=>1,
        "name"=>($name!=null? $name : "$"),
        "occupation"=>($occupation!=null? $occupation : "$"),
        "company"=>($company!=null? $company : "$"),
        "city"=>($city!=null? $city : "$"),
        "country"=>($country!=null? $country : "$"),
        "category"=>($category!=null? $category : "$"),
    )));
})->name('search');

$app->hook('cards', function ($param) use ($use) {
    $name=$param->name;
    $occupation=$param->occupation;
    $company=$param->company;
    $city=$param->city;
    $country=$param->country;
    $category=$param->category;
    $page=$param->page;
    $limit = 10;
    $start = $limit*($page-1);
    $query = "
            select 
                DISTINCT c.card_id, c.group_id, 
                ci.city_name, co.country_name, cm.company_name,  
                GROUP_CONCAT(oc.occupation_name SEPARATOR ', ') as occupation_name,  
                GROUP_CONCAT(ca.category_name SEPARATOR ', ') as category_name, 
                c.card_name, c.card_phone, c.card_mobile, c.card_fax, 
                c.card_email, c.card_website, c.card_address, c.card_image, 
                IF(SUBSTRING_INDEX(c.card_image,'.',-1)='pdf', true, false) as is_pdf, 
                IF(SUBSTRING_INDEX(c.card_image,'.',-1)='pdf', false, true) as is_image, 
                c.card_note 
            from 
                cards c, groups g, users u, users_groups ug,
                cards_occupations coc, occupations oc,
                cards_company cm, 
                cards_city ci, cards_country co, 
                cards_categories cca, categories ca 
            where 
                c.card_id=coc.card_id and c.company_id=cm.company_id and c.city_id=ci.city_id and c.card_id=cca.card_id and
                c.group_id=g.group_id and g.group_id=ug.group_id and ug.user_id=u.user_id and
                coc.occupation_id=oc.occupation_id and ci.country_id=co.country_id and cca.category_id=ca.category_id and
                c.card_name ".($name != '$' ? "like" : "not like")." CONCAT('%', :card_name '%') and 
                oc.occupation_name ".($occupation != '$' ? "=" : "!=")." :card_occupation and 
                cm.company_name ".($company != '$' ? "=" : "!=")." :card_company and 
                ci.city_name ".($city != '$' ? "=" : "!=")." :card_city and 
                co.country_name ".($country != '$' ? "=" : "!=")." :card_country and 
                ca.category_name ".($category != '$' ? "=" : "!=")." :card_category 
            group by c.card_id limit ".$start.", ".$limit;
    $select = $use->db->prepare($query);
    $select->bindParam(':card_name', $name, PDO::PARAM_STR);
    $select->bindParam(':card_occupation', $occupation, PDO::PARAM_STR);
    $select->bindParam(':card_company', $company, PDO::PARAM_STR);
    $select->bindParam(':card_city', $city, PDO::PARAM_STR);
    $select->bindParam(':card_country', $country, PDO::PARAM_STR);
    $select->bindParam(':card_category', $category, PDO::PARAM_STR);
    if($select->execute()){
        $result["cards"]=$select->fetchAll(PDO::FETCH_ASSOC);
        $result["count"]=$select->rowCount();
        $param->results=$result;
        if($select->rowCount() == 0){
            $param->found=true;   
        }else{
            $param->found=false;   
        }
    }
});

$app->hook('pagging', function ($param) use ($use) {
    $name=$param->name;
    $occupation=$param->occupation;
    $company=$param->company;
    $city=$param->city;
    $country=$param->country;
    $category=$param->category;
    $page=$param->page;
    $limit = 10;
    $start = $limit*($page-1);
    $query = "
            select 
                DISTINCT c.card_id, c.group_id, 
                ci.city_name, co.country_name, cm.company_name,  
                GROUP_CONCAT(oc.occupation_name SEPARATOR ', ') as occupation_name,  
                GROUP_CONCAT(ca.category_name SEPARATOR ', ') as category_name, 
                c.card_name, c.card_phone, c.card_mobile, c.card_fax, 
                c.card_email, c.card_website, c.card_address, c.card_image, 
                IF(SUBSTRING_INDEX(c.card_image,'.',-1)='pdf', true, false) as is_pdf, 
                IF(SUBSTRING_INDEX(c.card_image,'.',-1)='pdf', false, true) as is_image, 
                c.card_note 
            from 
                cards c, groups g, users u, users_groups ug,
                cards_occupations coc, occupations oc,
                cards_company cm, 
                cards_city ci, cards_country co, 
                cards_categories cca, categories ca 
            where 
                c.card_id=coc.card_id and c.company_id=cm.company_id and c.city_id=ci.city_id and c.card_id=cca.card_id and
                c.group_id=g.group_id and g.group_id=ug.group_id and ug.user_id=u.user_id and
                coc.occupation_id=oc.occupation_id and ci.country_id=co.country_id and cca.category_id=ca.category_id and
                c.card_name ".($name != '$' ? "like" : "not like")." CONCAT('%', :card_name '%') and 
                oc.occupation_name ".($occupation != '$' ? "=" : "!=")." :card_occupation and 
                cm.company_name ".($company != '$' ? "=" : "!=")." :card_company and 
                ci.city_name ".($city != '$' ? "=" : "!=")." :card_city and 
                co.country_name ".($country != '$' ? "=" : "!=")." :card_country and 
                ca.category_name ".($category != '$' ? "=" : "!=")." :card_category 
            group by c.card_id";
    $select = $use->db->prepare($query);
    $select->bindParam(':card_name', $name, PDO::PARAM_STR);
    $select->bindParam(':card_occupation', $occupation, PDO::PARAM_STR);
    $select->bindParam(':card_company', $company, PDO::PARAM_STR);
    $select->bindParam(':card_city', $city, PDO::PARAM_STR);
    $select->bindParam(':card_country', $country, PDO::PARAM_STR);
    $select->bindParam(':card_category', $category, PDO::PARAM_STR);
    if($select->execute()){
        $count=$select->rowCount();
        $data_mst=array();
        $data_mst["pages"] = array();
        for($i=1;$i<(ceil($count/$limit)+1);$i++){
            if($page > 1){
                $data_mst["prev"]=array(
                        "url"=>1,
                        "title"=>1
                );
            }
            $thispagging = array(
                "url"=>$i,
                "title"=>$i,
                "active"=>($page==$i ? 'active' : ''),
            );
            array_push($data_mst["pages"], $thispagging);
            if($page != $i){
                $data_mst["next"]=array(
                        "url"=>$i,
                        "title"=>$i
                );
            }
        }
        $result["pagging"]=$data_mst;
        $result["count"]=(ceil($count/$limit)+1);
        $param->results=$result;
    }
});

$app->hook('hint', function ($param) use ($use) {
    // HINT FORM COMPANY_NAME
    $company_hint = function() use ($use){
        $select = $use->db->prepare("select co.company_name from users_groups u, groups g, cards c, cards_company co where u.group_id=g.group_id AND g.group_id=c.group_id and c.company_id=co.company_id and u.user_id=:user_id group by co.company_name order by co.company_name");
        $select->bindParam(':user_id', $use->users["user_id"]);
        $select->execute();
        $result = array();
        foreach($select->fetchAll(PDO::FETCH_NUM) as $row){
            array_push($result, $row[0]);
        }
        return $result;
    };
    $param->company = json_encode($company_hint());
    //HINT FORM OCCUPATION_NAME
    $occupation_hint = function() use ($use){
        $select = $use->db->prepare("select o.occupation_name from users_groups u, groups g, cards c, cards_occupations co, occupations o WHERE u.group_id=g.group_id AND g.group_id=c.group_id and c.card_id=co.card_id and co.occupation_id=o.occupation_id and u.user_id=:user_id group by o.occupation_name order by o.occupation_name");
        $select->bindParam(':user_id', $use->users["user_id"]);
        $select->execute();
        $result = array();
        foreach($select->fetchAll(PDO::FETCH_NUM) as $row){
            array_push($result, $row[0]);
        }
        return $result;
    };
    $param->occupation = json_encode($occupation_hint());
    // HINT FORM COUNTRY AND CITY
    $country_hint = function() use ($use){
        $result = array();
        $select = $use->db->prepare("SELECT co.country_name, co.country_name_ind FROM  users_groups u, groups g, cards c, cards_city ci, cards_country co WHERE u.group_id=g.group_id AND g.group_id=c.group_id and c.city_id=ci.city_id AND ci.country_id=co.country_id and u.user_id=:user_id group by ci.city_name order by co.country_name");
        $select->bindParam(':user_id', $use->users["user_id"]);
        $select->execute();
        foreach($select->fetchAll(PDO::FETCH_NUM) as $row){
            array_push($result, $row[0]);
            array_push($result, $row[1]);
        }
        $select = $use->db->prepare("SELECT ci.city_name, co.country_name, co.country_name_ind FROM  users_groups u, groups g, cards c, cards_city ci, cards_country co WHERE u.group_id=g.group_id AND g.group_id=c.group_id and c.city_id=ci.city_id AND ci.country_id=co.country_id and u.user_id=:user_id group by ci.city_name order by ci.city_name, co.country_name");
        $select->bindParam(':user_id', $use->users["user_id"]);
        $select->execute();
        foreach($select->fetchAll(PDO::FETCH_NUM) as $row){
            array_push($result, $row[0].",".$row[1]);
            array_push($result, $row[0].",".$row[2]);
        }
        return $result;
    };
    $param->country = json_encode($country_hint());
    // HINT FORM CATEGORY
    $category_hint = function() use ($use){
        $select = $use->db->prepare("SELECT ca.category_name FROM  users_groups u, groups g, cards c, cards_categories cc, categories ca WHERE u.group_id=g.group_id AND g.group_id=c.group_id and c.card_id=cc.card_id and cc.category_id=ca.category_id and u.user_id=:user_id group by ca.category_name order by ca.category_name");
        $select->bindParam(':user_id', $use->users["user_id"]);
        $select->execute();
        $result = array();
        foreach($select->fetchAll(PDO::FETCH_NUM) as $row){
            array_push($result, $row[0]);
        }
        return $result;
    };
    $param->category = json_encode($category_hint());
});

// list api for heading navigation
$app->get('/list/company/:page', function ($page) use ($use) {
    $page=($page<1? 1 : $page);
    $limit = 9;
    $start = $limit*($page-1);
    $select = $use->db->prepare("select co.company_name from users_groups u, groups g, cards c, cards_company co where u.group_id=g.group_id AND g.group_id=c.group_id and c.company_id=co.company_id and u.user_id=:user_id group by co.company_name limit ".$start.", ".$limit);
    $select->bindParam(':user_id', $use->users["user_id"]);
    if($select->execute()){
        $result = array();
        foreach($select->fetchAll(PDO::FETCH_NUM) as $row){
            array_push($result, $row[0]);
        }
        $list4=array();
        for($i=0; $i<3; $i++){
            $list3=array();
            foreach(array_slice($result, $i*3, 3) as $row){
                $raw["name"]=$row;
                $raw["url"]=$use->app->urlFor('home', array(
                    "page"=>1,
                    "name"=>"$",
                    "occupation"=>"$",
                    "company"=>$row,
                    "city"=>"$",
                    "country"=>"$",
                    "category"=>"$",
                ));
                array_push($list3, $raw);
            }
            array_push($list4, array("list3"=>$list3));
        }
        $list['list4']=$list4;
        echo json_encode($list);
    }
})->name('company-list');

$app->get('/list/occupation/:page', function ($page) use ($use) {
    $page=($page<1? 1 : $page);
    $limit = 9;
    $start = $limit*($page-1);
    $select = $use->db->prepare("select o.occupation_name from users_groups u, groups g, cards c, cards_occupations co, occupations o WHERE u.group_id=g.group_id AND g.group_id=c.group_id and c.card_id=co.card_id and co.occupation_id=o.occupation_id and u.user_id=:user_id group by o.occupation_name limit ".$start.", ".$limit);
    $select->bindParam(':user_id', $use->users["user_id"]);
    if($select->execute()){
        $result = array();
        foreach($select->fetchAll(PDO::FETCH_NUM) as $row){
            array_push($result, $row[0]);
        }
        $list4=array();
        for($i=0; $i<3; $i++){
            $list3=array();
            foreach(array_slice($result, $i*3, 3) as $row){
                $raw["name"]=$row;
                $raw["url"]=$use->app->urlFor('home', array(
                    "page"=>1,
                    "name"=>"$",
                    "occupation"=>$row,
                    "company"=>"$",
                    "city"=>"$",
                    "country"=>"$",
                    "category"=>"$",
                ));
                array_push($list3, $raw);
            }
            array_push($list4, array("list3"=>$list3));
        }
        $list['list4']=$list4;
        echo json_encode($list);
    }
})->name('occupation-list');

$app->get('/list/country/:page', function ($page) use ($use) {
    $page=($page<1? 1 : $page);
    $limit = 9;
    $start = $limit*($page-1);
    $select = $use->db->prepare("SELECT co.country_name FROM  users_groups u, groups g, cards c, cards_city ci, cards_country co WHERE u.group_id=g.group_id AND g.group_id=c.group_id and c.city_id=ci.city_id AND ci.country_id=co.country_id and u.user_id=:user_id group by co.country_name  limit ".$start.", ".$limit);
    $select->bindParam(':user_id', $use->users["user_id"]);
    if($select->execute()){
        $result = array();
        foreach($select->fetchAll(PDO::FETCH_NUM) as $row){
            array_push($result, $row[0]);
        }
        $list4=array();
        for($i=0; $i<3; $i++){
            $list3=array();
            foreach(array_slice($result, $i*3, 3) as $row){
                $raw["name"]=$row;
                $raw["url"]=$use->app->urlFor('home', array(
                    "page"=>1,
                    "name"=>"$",
                    "occupation"=>"$",
                    "company"=>"$",
                    "city"=>"$",
                    "country"=>$row,
                    "category"=>"$",
                ));
                array_push($list3, $raw);
            }
            array_push($list4, array("list3"=>$list3));
        }
        $list['list4']=$list4;
        echo json_encode($list);
    }
})->name('country-list');

$app->get('/list/category/:page', function ($page) use ($use) {
    $page=($page<1? 1 : $page);
    $limit = 9;
    $start = $limit*($page-1);
    $select = $use->db->prepare("SELECT ca.category_name FROM  users_groups u, groups g, cards c, cards_categories cc, categories ca WHERE u.group_id=g.group_id AND g.group_id=c.group_id and c.card_id=cc.card_id and cc.category_id=ca.category_id and u.user_id=:user_id group by ca.category_name  limit ".$start.", ".$limit);
    $select->bindParam(':user_id', $use->users["user_id"]);
    if($select->execute()){
        $result = array();
        foreach($select->fetchAll(PDO::FETCH_NUM) as $row){
            array_push($result, $row[0]);
        }
        $list4=array();
        for($i=0; $i<3; $i++){
            $list3=array();
            foreach(array_slice($result, $i*3, 3) as $row){
                $raw["name"]=$row;
                $raw["url"]=$use->app->urlFor('home', array(
                    "page"=>1,
                    "name"=>"$",
                    "occupation"=>"$",
                    "company"=>"$",
                    "city"=>"$",
                    "country"=>"$",
                    "category"=>$row,
                ));
                array_push($list3, $raw);
            }
            array_push($list4, array("list3"=>$list3));
        }
        $list['list4']=$list4;
        echo json_encode($list);
    }
})->name('category-list');
?>