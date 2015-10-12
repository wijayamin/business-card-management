<?php
    function session($key){
        global $app;
        if(!isset($_SESSION[$key]) || $_SESSION[$key]==null || $_SESSION[$key]==""){
            $app->redirect($app->urlFor('login', array()));
        }
    }
?>