<?php

$app->get('/register-invite/:email/:group_id(/:us(/:ps(:/reps)))', function ($email, $group_id, $us = false,$ps = false,$reps = false) use ($use) {
    $use->template->prepare('register.html');
    $use->template->param(
        "username",
        ($us ? array(
            "type"=>"danger",
            "message"=>"username telah digunakan, coba username lain"
        ) : '')
    );
    $use->template->param(
        "password",
        ($ps ? array(
            "type"=>"danger",
            "message"=>"password kurang dari 6 karakter"
        ) : '')
    );
    $use->template->param(
        "repassword",
        ($reps ? array(
            "type"=>"danger",
            "message"=>"kedua password tidak sama"
        ) : '')
    );
    $use->template->param("ready_email", $email);
    $use->template->param("ready_group", $group_id);
    $use->template->execute();
})->name('register-invite');

$app->get('/register(/:us(/:em(/:ps(:/reps))))', function ($us = false,$em = false,$ps = false,$reps = false) use ($use) {
    $use->template->prepare('register.html');
    $use->template->param(
        "username",
        ($us ? array(
            "type"=>"danger",
            "message"=>"username telah digunakan, coba username lain"
        ) : '')
    );
    $use->template->param(
        "email",
        ($em ? array(
            "type"=>"danger",
            "message"=>"email telah digunakan, coba email lain"
        ) : '')
    );
    $use->template->param(
        "password",
        ($ps ? array(
            "type"=>"danger",
            "message"=>"password kurang dari 6 karakter"
        ) : '')
    );
    $use->template->param(
        "repassword",
        ($reps ? array(
            "type"=>"danger",
            "message"=>"kedua password tidak sama"
        ) : '')
    );
    $use->template->execute();
})->name('register');


$app->get('/check/username/:user', function ($user) use ($use) {
    $count = $use->db->query("select count(user_id) from users where username='".$user."'")->fetchColumn();
    if($count > 0){
        echo json_encode(array(
            "type"=>"danger",
            "message"=>"username telah digunakan, coba username lain",
            "status"=>false
        ));
    }else{
        echo json_encode(array(
            "type"=>"success",
            "message"=>"username tersedia untuk digunakan",
            "status"=>true
        ));
    }
});
//
//
$app->get('/check/email/:email', function ($email) use ($use) {
        $count = $use->db->query("select count(user_id) from users where email='".$email."'")->fetchColumn();
        if($count > 0){
            echo json_encode(array(
                "type"=>"danger",
                "message"=>"email telah digunakan, coba email lain",
                "status"=>false
            ));
        }else{
            echo json_encode(array(
                "type"=>"success",
                "message"=>"email tersedia untuk digunakan",
                "status"=>true
            ));
        }
    });
//
//
$app->post('/doregister', function () use ($use, $m) {
    $username = $use->app->request->post('username');
    $password = $use->app->request->post('password');
    $repassword = $use->app->request->post('repassword');
    $email = $use->app->request->post('email');
    $name = $use->app->request->post('name');
    $group_id = $use->app->request->post('group_id');
    $cek_username = $use->db->query("select count(user_id) from users where username='".$username."'")->fetchColumn();
    $cek_email = $use->db->query("select count(user_id) from users where email='".$email."'")->fetchColumn();
    if($cek_username == 0 && $cek_email == 0 && strlen($password) >= 6 && $repassword == $password){
        $insert = $use->db->prepare(
            "insert into
            users(username, password, email, real_name, image, activated, last_login, permission, default_group)
            values(:username, :password, :email, :real_name, 'no-photo.png', '0', :last_login, 'read', :default_group)"
        );
        $insert->bindParam(':username', $username, PDO::PARAM_STR);
        $insert->bindParam(':password', md5($password), PDO::PARAM_STR);
        $insert->bindParam(':email', $email, PDO::PARAM_STR);
        $insert->bindParam(':real_name', $name, PDO::PARAM_STR);
        $insert->bindParam(':last_login', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $insert->bindParam(':default_group', ($group_id != null ? $group_id : null), PDO::PARAM_STR);
        if($insert->execute()){
            $user_id = $use->db->lastInsertId();
            $url = $use->req->getUrl().$use->app->urlFor('activation', array('user_id'=>$user_id));
            $use->mail->addAddress($email);
            $use->mail->isHTML(true);
            $use->mail->Subject = 'Aktivasi Email Pendaftaran Aplikasi Manajemen Kartu Nama PT. PAL Indonesia';
            $use->mail->Body    = $use->template->render("email.html", array(
                "title"=>"Aktivasi Email Pendaftaran",
                "messages"=>"Anda perlu mengkonfirmasi email anda pada alamat ".$email.
                            " untuk mengaktifkan akun anda pada <b>Aplikasi Manajemen Kartu Nama PT. PAL Indonesia</b>. <br>Aktivasi akun diperlukan agar anda dapat mengunakan aplikasi ini.".
                            "<br>Silahkan melakukan aktivasi dengan menggunakan tombol dibawah ini atau copy link(tautan) yang tertera di bawah",
                "url"=>$url,
                "url_name"=>"Aktivasi Sekarang"
            ));
            if(!$use->mail->send()) {
                $result["status"]='failed';
                $result["message"]=$use->mail->ErrorInfo;
                echo json_encode($result);
            }else{
                if($group_id != null){
                    $insert = $use->db->prepare("insert into users_groups(user_id, group_id) values(:user_id, :group_id);");
                    $insert->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $insert->bindParam(':group_id', $group_id, PDO::PARAM_INT);
                    $insert->execute();
                }
                $use->app->redirect($use->app->urlFor('after-register', array('user_id'=>$user_id, 'email'=>$email)));
            }
        }
    }else{
        $use->app->redirect(
            $use->app->urlFor('register', array(
                'us'=>($cek_username > 0 ? "true" : "false"),
                'em'=>($cek_email > 0 ? "true" : "false"),
                'ps'=>(strlen($password) < 6 ? "true" : "false"),
                'reps'=>($repassword != $password ? "true" : "false")
            ))
        );
    }
})->name('doregsiter');

$app->get('/after-register/:user_id/:email', function ($user_id, $email) use ($use) {
    $use->template->prepare('registerafter.html');
    $use->template->param("resend", $use->req->getUrl().$use->app->urlFor('resend-email', array('resend'=>'true', 'user_id'=>$user_id, 'email'=>$email)));
    $use->template->execute();
})->name('after-register');

$app->get('/resend-email/:user_id/:email', function ($user_id, $email) use ($use) {
    $url = $use->req->getUrl().$use->app->urlFor('activation', array('user_id'=>$user_id));
    $use->mail->addAddress($email);
    $use->mail->isHTML(true);
    $use->mail->Subject = 'Aktivasi Email Pendaftaran Aplikasi Manajemen Kartu Nama PT. PAL Indonesia';
    $use->mail->Body    = $use->template->render("email.html", array(
        "title"=>"Aktivasi Email Pendaftaran",
        "messages"=>"Anda perlu mengkonfirmasi email anda pada alamat ".$email.
                    " untuk mengaktifkan akun anda pada <b>Aplikasi Manajemen Kartu Nama PT. PAL Indonesia</b>. <br>Aktivasi akun diperlukan agar anda dapat mengunakan aplikasi ini.".
                    "<br>Silahkan melakukan aktivasi dengan menggunakan tombol dibawah ini atau copy link(tautan) yang tertera di bawah",
        "url"=>$url,
        "url_name"=>"Aktivasi Sekarang"
    ));
    if(!$use->mail->send()) {
        $result["status"]='failed';
        $result["message"]=$use->mail->ErrorInfo;
        echo json_encode($result);
    }else{
        $use->app->redirect($use->app->urlFor('after-register', array('user_id'=>$user_id, 'email'=>$email)));
    }
})->name('resend-email');

$app->get('/page/email/activation/:user_id', function ($user_id) use ($use) {
        $update = $use->db->prepare("update users set activated='1' where user_id=:user_id");
        $update->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $update->execute();
        $use->template->prepare("registerdone.html");
        $use->template->execute();
})->name('activation');
?>
