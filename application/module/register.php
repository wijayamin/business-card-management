<?php
    /*$app->get('/page/register(/:us(/:em(/:ps(:/reps))))', function ($us = false,$em = false,$ps = false,$reps = false) use ($app, $db, $m, $root) {
            echo $m->render(gt("index-header.html"), array("root"=>$root));
            echo $m->render(gt("register/register.html"), array(
                "root"=>$root,
                "username"=>($us ? array(
                    "type"=>"danger",
                    "message"=>"username telah digunakan, coba username lain"
                ) : ''),
                "email"=>($em ? array(
                    "type"=>"danger",
                    "message"=>"email telah digunakan, coba email lain"
                ) : ''),
                "password"=>($ps ? array(
                    "type"=>"danger",
                    "message"=>"password kurang dari 6 karakter"
                ) : ''),
                "repassword"=>($reps ? array(
                    "type"=>"danger",
                    "message"=>"kedua password tidak sama"
                ) : '')
            ));
            echo $m->render(gt("index-footer.html"), array("root"=>$root));
        })->name('register-page');


    $app->get('/page/check/username/:user', function ($user) use ($app, $db, $m, $root) {
        $count = $db->query("select count(user_id) from users where username='".$user."'")->fetchColumn();
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


    $app->get('/page/check/email/:email', function ($email) use ($app, $db, $m, $root) {
        $count = $db->query("select count(user_id) from users where email='".$email."'")->fetchColumn();
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


    $app->map('/page/doregister(/:resend/:user_id/:email)', function ($resend = false, $user_id = 0, $email= '') use ($app, $db, $m, $root, $mail, $req) {
        if($resend == false){
            $username = $app->request->post('username');
            $password = $app->request->post('password');
            $repassword = $app->request->post('repassword');
            $email = $app->request->post('email');
            $name = $app->request->post('name');
            $cek_username = $db->query("select count(user_id) from users where username='".$username."'")->fetchColumn();
            $cek_email = $db->query("select count(user_id) from users where email='".$email."'")->fetchColumn();
            if($cek_username == 0 && $cek_email == 0 && strlen($password) >= 6 && $repassword == $password){
                $insert = $db->prepare(
                    "insert into 
                    users(username, password, email, real_name, image, activated, last_login, permission) 
                    values(:username, :password, :email, :real_name, 'a', '0', :last_login, 'read')"
                );
                $insert->bindParam(':username', $username, PDO::PARAM_STR);
                $insert->bindParam(':password', md5($password), PDO::PARAM_STR);
                $insert->bindParam(':email', $email, PDO::PARAM_STR);
                $insert->bindParam(':real_name', $name, PDO::PARAM_STR);
                $insert->bindParam(':last_login', date("Y-m-d H:i:s"), PDO::PARAM_STR);
                if($insert->execute()){
                    $user_id = $db->lastInsertId();
                    $url = $req->getUrl().$app->urlFor('activation', array('user_id'=>$user_id));
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = 'Aktivasi Email Pendaftaran Aplikasi Manajemen Kartu Nama PT. PAL Indonesia';
                    $mail->Body    = $m->render(gt("email/email.html"), array(
                        "title"=>"Aktivasi Email Pendaftaran",
                        "messages"=>"Anda perlu mengkonfirmasi email anda pada alamat ".$email.
                                    " untuk mengaktifkan akun anda pada <b>Aplikasi Manajemen Kartu Nama PT. PAL Indonesia</b>. <br>Aktivasi akun diperlukan agar anda dapat mengunakan aplikasi ini.".
                                    "<br>Silahkan melakukan aktivasi dengan menggunakan tombol dibawah ini atau copy link(tautan) yang tertera di bawah",
                        "url"=>$url,
                        "url_name"=>"Aktivasi Sekarang"
                    ));
                    if(!$mail->send()) {
                        $result["status"]='failed';
                        $result["message"]=$mail->ErrorInfo;
                        echo json_encode($result);
                    }else{
                        echo $m->render(gt("index-header.html"), array("root"=>$root));
                        echo $m->render(gt("register/registerafter.html"), array(
                            "root"=>$root,
                            "resend"=>$req->getUrl().$app->urlFor('doregsiter', array(
                                'resend'=>'true', 
                                'user_id'=>$user_id,
                                'email'=>$email
                            )),
                            "change_email"=>"google.com"
                        ));
                        echo $m->render(gt("index-footer.html"), array("root"=>$root));
                    }
                }
            }else{
                $app->redirect(
                    $app->urlFor('register-page', array(
                        'us'=>($cek_username > 0 ? "true" : "false"), 
                        'em'=>($cek_email > 0 ? "true" : "false"),
                        'ps'=>(strlen($password) < 6 ? "true" : "false"),
                        'reps'=>($repassword != $password ? "true" : "false")
                    ))
                );
            }
        }else{
            $url = $req->getUrl().$app->urlFor('activation', array('user_id'=>$user_id));
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Aktivasi Email Pendaftaran Aplikasi Manajemen Kartu Nama PT. PAL Indonesia';
            $mail->Body    = $m->render(gt("email/email.html"), array(
                "title"=>"Aktivasi Email Pendaftaran",
                "messages"=>"Anda perlu mengkonfirmasi email anda pada alamat ".$email.
                            " untuk mengaktifkan akun anda pada <b>Aplikasi Manajemen Kartu Nama PT. PAL Indonesia</b>.<br> Aktivasi akun diperlukan agar anda dapat mengunakan aplikasi ini.".
                            "<br>Silahkan melakukan aktivasi dengan menggunakan tombol dibawah ini atau copy link(tautan) yang tertera di bawah",
                "url"=>$url,
                "url_name"=>"Aktivasi Sekarang"
            ));
            if(!$mail->send()) {
                $result["status"]='failed';
                $result["message"]=$mail->ErrorInfo;
                echo json_encode($result);
            }else{
                echo $m->render(gt("index-header.html"), array("root"=>$root));
                echo $m->render(gt("register/registerafter.html"), array(
                    "root"=>$root,
                    "resend"=>$req->getUrl().$app->urlFor('doregsiter', array(
                        'resend'=>'true', 
                        'user_id'=>$user_id,
                        'email'=>$email
                    )),
                    "change_email"=>"google.com"
                ));
                echo $m->render(gt("index-footer.html"), array("root"=>$root));
            }
        }
    })->via('GET', 'POST')->name('doregsiter');


    $app->get('/page/email/activation/:user_id', function ($user_id) use ($app, $db, $m, $root, $req) {
        $update = $db->prepare("update users set activated='1' where user_id=:user_id");
        $update->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $update->execute();
        echo $m->render(gt("index-header.html"), array("root"=>$root));
        echo $m->render(gt("register/registerdone.html"), array(
            "root"=>$root
        ));
        echo $m->render(gt("index-footer.html"), array("root"=>$root));
    })->name('activation');*/
?>