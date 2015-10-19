<?php

$app->get('/new', function () use ($use) {
    session("user_id");
    $use->template->prepare('new.html');

    //users detail
    $use->template->param("users", $use->users);
    $use->template->param("default_group", $use->db->query("select group_name from groups where group_id='".$use->users["default_group"]."'")->fetchColumn());

    $hint_param = (object) ['name' => "", 'company' => "", 'occupation' => "", 'city' => "", 'country' => "", 'category' => "", 'category' => ""];
    $use->app->applyHook('hint-new', $hint_param);
    $use->template->param("hint", array(
        "company"=>$hint_param->company,
        "occupation"=>$hint_param->occupation,
        "city"=>$hint_param->city,
        "country"=>$hint_param->country,
        "category"=>$hint_param->category,
        "group"=>$hint_param->group,
    ));

    $use->template->execute();
})->name("new");

$app->post('/new/save', function () use ($use) {
    $company_id = function ($company_name) use ($use){
        $select = $use->db->query("select company_id from cards_company where company_name='".$company_name."'");
        $result;
        if($select->rowCount() >= 1){
            $result=$select->fetchColumn();
        }else{
            $insert = $use->db->query("insert into cards_company(company_name) values('".$company_name."')");
            $result=$use->db->lastInsertId();
        }
        return $result;
    };

    $occupation_id = function ($occupation_name) use ($use){
        $select = $use->db->query("select occupation_id from occupations where occupation_name='".$occupation_name."'");
        $result;
        if($select->rowCount() >= 1){
            $result=$select->fetchColumn();
        }else{
            $insert = $use->db->query("insert into occupations(occupation_name) values('".$occupation_name."')");
            $result=$use->db->lastInsertId();
        }
        return $result;
    };

    $category_id = function ($category_name) use ($use){
        $select = $use->db->query("select category_id from categories where category_name='".$category_name."'");
        $result;
        if($select->rowCount() == 1){
            $result=$select->fetchColumn();
        }else{
            $insert = $use->db->query("insert into categories(category_name) values('".$category_name."')");
            $result=$use->db->lastInsertId();
        }
        return $result;
    };

    $city_id = function ($city_name, $country_id) use ($use){
        $select = $use->db->query("select city_id from cards_city where city_name='".$city_name."' and country_id='".$country_id."'");
        $result;
        if($select->rowCount() == 1){
            $result=$select->fetchColumn();
        }else{
            $insert = $use->db->query("insert into cards_city(country_id, city_name) values('".$country_id."', '".($city_name != null ? $city_name : "-" )."')");
            $result=$use->db->lastInsertId();
        }
        return $result;
    };

    $country_id = function ($country_name) use ($use){
        $select = $use->db->query("select country_id from cards_country where country_name='".($country_name != null ? $country_name : "-" )."'");
        $result = '';
        if($select->rowCount() == 1){
            $result=$select->fetchColumn();
        }
        return $result;
    };

    $group_id = function ($group_name) use ($use){
        $select = $use->db->query("select group_id from groups where group_name='".$group_name."'");
        return $select->fetchColumn();
    };

    $cards_groups = function ($card_id, $group_name) use ($use, $group_id){
        $groups = explode(",", $group_name);
        foreach($groups as $group){
            $insert = $use->db->query("insert into cards_groups(card_id, group_id) values('".$card_id."', '".$group_id($group)."')");
        }
    };

    $cards_categories = function ($card_id, $category_name) use ($use, $category_id){
        $groups = explode(",", $category_name);
        foreach($groups as $group){
            $insert = $use->db->query("insert into cards_categories(card_id, category_id) values('".$card_id."', '".$category_id($group)."')");
        }
    };

    $cards_occupations = function ($card_id, $occupation_name) use ($use, $occupation_id){
        $groups = explode(",", $occupation_name);
        foreach($groups as $group){
            $insert = $use->db->query("insert into cards_occupations(card_id, occupation_id) values('".$card_id."', '".$occupation_id($group)."')");
        }
    };

    if(isset($_FILES["card_image"])){
        if ($_FILES["card_image"]["type"] == "application/pdf" || $_FILES["card_image"]["type"] == "image/x-png" || $_FILES["card_image"]["type"] == "image/jpeg"){
            $name = $use->app->request->post('card_name');
            $group = $use->app->request->post('card_group');
            $company = $company_id($use->app->request->post('card_company'));
            $occupation = $use->app->request->post('card_occupation');
            $phone = $use->app->request->post('card_phone');
            $mobile = $use->app->request->post('card_mobile');
            $fax = $use->app->request->post('card_fax');
            $email = $use->app->request->post('card_email');
            $website = $use->app->request->post('card_website');
            $address = $use->app->request->post('card_address');
            $city = $city_id($use->app->request->post('card_city'), $country_id($use->app->request->post('card_country')));
            $country = $country_id($use->app->request->post('card_country'));
            $category = $use->app->request->post('card_category');
            $note = $use->app->request->post('card_note');

            $ext = end((explode(".", $_FILES['card_image']['name'])));
            $sourcePath = $_FILES['card_image']['tmp_name'];
            $file = 'card-'.$name."-".rand(100, 999)."-".date("-Y-m-d-H-i-s-").'.'.$ext;
            $targetPath = "public/data/".$file; // Target path where file is to be stored
            move_uploaded_file($sourcePath, $targetPath) ; // Moving Uploaded file
            $insert = $use->db->prepare("
                insert into
                cards(city_id, company_id, card_name, card_phone, card_mobile, card_fax, card_email, card_website, card_address, card_image, card_note)
                values(:city_id, :company_id, :card_name, :card_phone, :card_mobile, :card_fax, :card_email, :card_website, :card_address, :card_image, :card_note);
            ");
            $insert->bindParam(':city_id', $city, PDO::PARAM_INT);
            $insert->bindParam(':company_id', $company, PDO::PARAM_INT);
            $insert->bindParam(':card_name', $name, PDO::PARAM_STR);
            $insert->bindParam(':card_phone', $phone, PDO::PARAM_STR);
            $insert->bindParam(':card_mobile', $mobile, PDO::PARAM_STR);
            $insert->bindParam(':card_fax', $fax, PDO::PARAM_STR);
            $insert->bindParam(':card_email', $email, PDO::PARAM_STR);
            $insert->bindParam(':card_website', $website, PDO::PARAM_STR);
            $insert->bindParam(':card_address', $address, PDO::PARAM_STR);
            $insert->bindParam(':card_image', $file, PDO::PARAM_STR);
            $insert->bindParam(':card_note', $note, PDO::PARAM_STR);
            if($insert->execute()){
            $card_id = $use->db->lastInsertId();
            $cards_groups($card_id, $group);
            $cards_categories($card_id, $category);

            $cards_occupations($card_id, $occupation);

            $use->app->redirect($use->app->urlFor('home'));
            }else{
             echo "lala";
            }
        }
    }

})->name("save-new");

$app->hook('hint-new', function ($param) use ($use) {
    // HINT FORM COMPANY_NAME
    $company_hint = function() use ($use){
        $select = $use->db->prepare("select company_name from cards_company");
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
        $select = $use->db->prepare("select occupation_name from occupations");
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
        $select = $use->db->prepare("SELECT country_name, country_name_ind from cards_country");
        $select->bindParam(':user_id', $use->users["user_id"]);
        $select->execute();
        foreach($select->fetchAll(PDO::FETCH_NUM) as $row){
            array_push($result, $row[0]);
            array_push($result, $row[1]);
        }
        return $result;
    };
    $param->country = json_encode($country_hint());
    $city_hint = function() use ($use){
        $result = array();
        $select = $use->db->prepare("SELECT city_name from cards_city");
        $select->bindParam(':user_id', $use->users["user_id"]);
        $select->execute();
        foreach($select->fetchAll(PDO::FETCH_NUM) as $row){
            array_push($result, $row[0]);
        }
        return $result;
    };
    $param->city = json_encode($city_hint());
    // HINT FORM CATEGORY
    $category_hint = function() use ($use){
        $select = $use->db->prepare("SELECT ca.category_name FROM  users_groups u, groups g, cards_groups cg, cards c, cards_categories cc, categories ca WHERE u.group_id=g.group_id AND g.group_id=cg.group_id and cg.card_id=c.card_id and c.card_id=cc.card_id and cc.category_id=ca.category_id and u.user_id=:user_id group by ca.category_name order by ca.category_name");
        $select->bindParam(':user_id', $use->users["user_id"]);
        $select->execute();
        $result = array();
        foreach($select->fetchAll(PDO::FETCH_NUM) as $row){
            array_push($result, $row[0]);
        }
        return $result;
    };
    $param->category = json_encode($category_hint());

    $group_hint = function() use ($use){
        $select = $use->db->prepare("SELECT g.group_name from groups g, users_groups ug where g.group_id=ug.group_id and ug.user_id=:user_id");
        $select->bindParam(':user_id', $use->users["user_id"]);
        $select->execute();
        $result = array();
        foreach($select->fetchAll(PDO::FETCH_NUM) as $row){
            array_push($result, $row[0]);
        }
        return $result;
    };
    $param->group = json_encode($group_hint());
});

?>
