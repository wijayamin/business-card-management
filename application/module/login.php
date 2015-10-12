<?php
    $app->post('/dologin', function () use ($use) {
        $username = $use->app->request->post('username');
        $password = $use->app->request->post('password');
        $select = $use->db->prepare("select * from users where password=:password and (username=:username or email=:email)");
        $select->bindParam(':username', $username, PDO::PARAM_STR);
        $select->bindParam(':email', $username, PDO::PARAM_STR);
        $select->bindParam(':password', md5($password), PDO::PARAM_STR);
        $select->execute();
        $count = $select->rowCount();
        $data = $select->fetch(PDO::FETCH_ASSOC);
        if($count == 1){
            $_SESSION['user_id'] = $data["user_id"];
            $use->app->redirect($use->app->urlFor('home'));
        }else{
            $use->app->redirect($use->app->urlFor('login', array('error'=>true)));   
        }
    })->name('dologin');
    $app->get('/logout', function () use ($use) {
        session_destroy();
        $use->app->redirect($use->app->urlFor('login')); 
    })->name('logout');
?>