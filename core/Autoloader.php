<?php
// load all core system framework
require 'core/Slim/Slim.php';
require 'core/Mustache/Autoloader.php';
require 'core/PHPMailer/PHPMailerAutoload.php';


\Slim\Slim::registerAutoloader();
Mustache_Autoloader::register();
$app = new \Slim\Slim();
$m = new Mustache_Engine;

// load cpnfigurations
require 'config.php';

// load all libraries
require 'application/libraries/database.php';
require 'application/libraries/templating.php';
require 'application/libraries/mail.php';


// load all helper
require 'application/helper/session.php';
require 'application/helper/user_privilege.php';
require 'application/helper/detail.php';

require 'application/helper/parameter.php';

// declare all class
$template = new Templating($app);
$use = new parameter(
    $app,
    $template,
    $db,
    $user_detail((isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "")),
    $groups_detail((isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "")),
    $mail
);

// load all modules
foreach (glob("application/module/*.php") as $filename){
    require $filename;
}

$app->run();
?>
