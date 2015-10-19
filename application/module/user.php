<?php
$app->get('/userlist', function () use ($use) {
    $use->template->prepare('memberlist.html');
    $use->template->param("users", $use->users);
    $data_user = (object) ["result"=>[]];
    $use->app->applyHook('userlist', $data_user);
    $use->template->param("userlist", $data_user->result);
    $use->template->param("group_list", $use->db->query("select * from groups")->fetchAll(PDO::FETCH_ASSOC));
    $use->template->param("counter", array(
        "cards"=>$use->db->query("select count(card_id) from cards")->fetchColumn(),
        "users"=>$use->db->query("select count(user_id) from users")->fetchColumn(),
        "groups"=>$use->db->query("select count(group_id) from groups")->fetchColumn(),
    ));
    $use->template->execute();

})->name("userlist");

$app->hook('userlist', function ($param) use ($use){
    $select = $use->db->query("
        select
            u.user_id, u.username, u.real_name, u.email, u.image, u.permission,
            IF(u.activated='0', true, false) as is_active
        from
            users u
    ");
    $result = array();
    foreach($select as $row){
        $re["user_id"]=$row["user_id"];
        $re["username"]=$row["username"];
        $re["real_name"]=$row["real_name"];
        $re["email"]=$row["email"];
        $re["image"]=$row["image"];
        $re["permission"]=$row["permission"];
        $re["is_active"]=$row["is_active"];
        $re["group_name"]=$use->db->query("select GROUP_CONCAT(g.group_name SEPARATOR ', ') from users_groups ug, groups g where ug.user_id='".$row["user_id"]."' and ug.group_id=g.group_id group by ug.user_id")->fetchColumn();
        array_push($result, $re);
    }
    $param->result=$result;
});

$app->post('/invite', function() use ($use){
    $email = $use->app->request->post('email');
    $group = $use->app->request->post('group');
    $name = $use->app->request->post('name');
    $use->mail->addAddress($email);
    $url = $use->req->getUrl().$use->app->urlFor('register-invite', array('email'=>$email, 'group_id'=>$group));
    $use->mail->isHTML(true);
    $use->mail->Subject = 'Undangan Penggunaan Aplikasi Manajemen Kartu Nama PT. PAL Indonesia';
    $use->mail->Body    = $use->template->render("email.html", array(
        "title"=>"Undangan Penggunaan",
        "messages"=>"Anda mendapat undangan penggunaan Aplikasi Manajemen Kartu Nama PT. PAL Indonesia.<br>
                    Undangan dikirim oleh <b>".$name."</b> <br>
                    Silahkan gunakan tombol dibawah ini untuk melanjutkan registrasi",
        "url"=>$url,
        "url_name"=>"Aktivasi Sekarang"
    ));
    if(!$use->mail->send()) {
        $result["status"]='failed';
        $result["message"]=$use->mail->ErrorInfo;
        echo json_encode($result);
    }else{
        $use->app->redirect($use->app->urlFor('userlist'));
    }
});
$app->post('/moderation', function() use ($use){
    $name = $use->app->request->post('name');
    $id = $use->app->request->post('id');
    $permission = $use->app->request->post('permission');
    $use->db->query("update users set permission='".$permission."' where user_id='".$id."'");
    $use->app->redirect($use->app->urlFor('userlist'));
});
$app->get('/removeaccount/:user_id', function($user_id) use ($use){
    $use->db->query("delete from users_groups where user_id='".$user_id."'");
    $use->db->query("delete from users where user_id='".$user_id."'");
    $use->app->redirect($use->app->urlFor('userlist'));
});
?>
