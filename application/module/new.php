<?php

$app->get('/new', function () use ($use) {
    session("user_id");
    $use->template->prepare('new.html');
    
    //users detail
    $use->template->param("users", $use->users);
    
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
        $result = '';
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
        $result = '';
        if($select->rowCount() >= 1){
            $result=$select->fetchColumn();
        }else{
            $insert = $use->db->query("insert into categories(category_id) values('".$occupation_name."')");
            $result=$use->db->lastInsertId();
        }
        return $result;
    };
    
    $country_id = function ($country_name) use ($use){
        $select = $use->db->query("select category_id from categories where category_name='".$category_name."'");
        $result = '';
        if($select->rowCount() >= 1){
            $result=$select->fetchColumn();
        }else{
            $insert = $use->db->query("insert into categories(category_id) values('".$occupation_name."')");
            $result=$use->db->lastInsertId();
        }
        return $result;
    };
    
    if(isset($_FILES["card_image"])){
        if ($_FILES["card_image"]["type"] == "application/pdf" || $_FILES["card_image"]["type"] == "image/x-png" || $_FILES["card_image"]["type"] == "image/jpeg"){
            $name = ($app->request->post('card_name'));
            $group_id;
            $company = GetCompanyid($pdo, urldecode($app->request->post('card_company')));
            $departement = ($app->request->post('card_departement'));
            $phone = phoneToString($app->request->post('card_phone'), $app->request->post('phone_code'));
            $mobile = phoneToString($app->request->post('card_mobile'), $app->request->post('mobile_code'));
            $fax = phoneToString($app->request->post('card_fax'), $app->request->post('fax_code'));
            $email = array_to_string($app->request->post('card_email'));
            $website = ($app->request->post('card_website'));
            $address = ($app->request->post('card_address'));
            $city = GetCityid($pdo, getCountry_id($pdo, $app->request->post('card_country')), $app->request->post('card_city'));
            $country = getCountry_id($pdo, $app->request->post('card_country'));
            $category = ($app->request->post('card_category'));
            
            $ext = end((explode(".", $_FILES['card_image']['name'])));
            $sourcePath = $_FILES['card_image']['tmp_name'];
            $file = 'card-'.$name."-".rand(100, 999)."-".date("-Y-m-d-H-i-s-").'.'.$ext;
            $targetPath = "../data/".$file; // Target path where file is to be stored
            move_uploaded_file($sourcePath, $targetPath) ; // Moving Uploaded file
        }
    }
    
})->name("save-new");

?>