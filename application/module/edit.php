<?php
$app->get('/edit/:card_id', function ($card_id) use ($use) {
    session("user_id");
    $use->template->prepare('edit.html');
    //users detail
    $use->template->param("users", $use->users);
    $use->template->param("default_group", $use->db->query("select group_name from groups where group_id='".$use->users["default_group"]."'")->fetchColumn());

    $hint_param = (object) ['name' => "", 'company' => "", 'occupation' => "", 'city' => "", 'country' => "", 'category' => "", 'category' => ""];
    $use->app->applyHook('hint-new', $hint_param);

    $data_edit = (object) ['card_id'=>$card_id, "result"=>[]];
    $use->app->applyHook('data-edit', $data_edit);
    $use->template->param("cards", $data_edit->result[0]);

    $use->template->param("hint", array(
        "company"=>$hint_param->company,
        "occupation"=>$hint_param->occupation,
        "city"=>$hint_param->city,
        "country"=>$hint_param->country,
        "category"=>$hint_param->category,
        "group"=>$hint_param->group,
    ));

    $use->template->execute();
})->name('edit');

$app->post('/edit/save', function () use ($use) {



    $card_id = $use->app->request->post('card_id');

    $deleteFK = function($card_id) use($use){
        $delete = $use->db->query("delete from cards_occupations where card_id='".$card_id."'");
        $delete = $use->db->query("delete from cards_categories where card_id='".$card_id."'");
        $delete = $use->db->query("delete from cards_groups where card_id='".$card_id."'");
    };


    $deleteFK($card_id);
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

    $update = $use->db->prepare("
        update cards
        set
            city_id=:city_id,
            company_id=:company_id,
            card_name= :card_name,
            card_phone=:card_phone,
            card_mobile= :card_mobile,
            card_fax=:card_fax,
            card_email= :card_email,
            card_website=:card_website,
            card_address=:card_address,
            card_note=:card_note
        where
            card_id=:card_id
        ;
    ");
    $update->bindParam(':card_id', $card_id, PDO::PARAM_INT);
    $update->bindParam(':city_id', $city, PDO::PARAM_INT);
    $update->bindParam(':company_id', $company, PDO::PARAM_INT);
    $update->bindParam(':card_name', $name, PDO::PARAM_STR);
    $update->bindParam(':card_phone', $phone, PDO::PARAM_STR);
    $update->bindParam(':card_mobile', $mobile, PDO::PARAM_STR);
    $update->bindParam(':card_fax', $fax, PDO::PARAM_STR);
    $update->bindParam(':card_email', $email, PDO::PARAM_STR);
    $update->bindParam(':card_website', $website, PDO::PARAM_STR);
    $update->bindParam(':card_address', $address, PDO::PARAM_STR);
    $update->bindParam(':card_note', $note, PDO::PARAM_STR);
    if($update->execute()){
        $cards_groups($card_id, $group);
        $cards_categories($card_id, $category);
        $cards_occupations($card_id, $occupation);

        $use->app->redirect($use->app->urlFor('home'));
    }
})->name("save-edit");

$app->hook('data-edit', function ($param) use ($use) {
    $query =   "select
                    DISTINCT c.card_id, GROUP_CONCAT(g.group_name SEPARATOR ', ') group_name,
                    ci.city_name, co.country_name, cm.company_name,
                    GROUP_CONCAT(oc.occupation_name SEPARATOR ', ') as occupation_name,
                    GROUP_CONCAT(ca.category_name SEPARATOR ', ') as category_name,
                    c.card_name, c.card_phone, c.card_mobile, c.card_fax,
                    c.card_email, c.card_website, c.card_address, c.card_image,
                    IF(SUBSTRING_INDEX(c.card_image,'.',-1)='pdf', true, false) as is_pdf,
                    IF(SUBSTRING_INDEX(c.card_image,'.',-1)='pdf', false, true) as is_image,
                    c.card_note
                from
                    cards c, cards_groups cg, groups g, users u, users_groups ug,
                    cards_occupations coc, occupations oc,
                    cards_company cm,
                    cards_city ci, cards_country co,
                    cards_categories cca, categories ca
                where
                    c.card_id=coc.card_id and c.company_id=cm.company_id and c.city_id=ci.city_id and c.card_id=cca.card_id and
                    c.card_id=cg.card_id and cg.group_id=g.group_id and g.group_id=ug.group_id and ug.user_id=u.user_id and
                    coc.occupation_id=oc.occupation_id and ci.country_id=co.country_id and cca.category_id=ca.category_id and
                    u.user_id='".$use->users["user_id"]."' and c.card_id='".$param->card_id."'";
    $select = $use->db->prepare($query);
    $select->execute();
    $result=$select->fetchAll(PDO::FETCH_ASSOC);
    $param->result = $result;
});
?>
