<?php
$app->get('/account', function () use ($use) {
    session("user_id");
    $use->template->prepare('account.html');
    //users detail
    $use->template->param("users", $use->users);
    $use->template->param("privilege", Privilege($use->users["permission"]));

    $use->template->execute();
})->name('account');

$app->get('/check/oldpassword/:password/:user_id', function ($password, $user_id) use ($use) {
    $realpassword = $use->db->query("select password from users where user_id='".$user_id."'")->fetchColumn();
    if($realpassword != md5($password)){
        echo json_encode(array(
            "type"=>"danger",
            "message"=>"Password Salah",
            "status"=>false
        ));
    }else{
        echo json_encode(array(
            "type"=>"success",
            "message"=>"Password Benar",
            "status"=>true
        ));
    }
});
?>
