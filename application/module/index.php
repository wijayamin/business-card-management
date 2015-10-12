<?php
$app->config('debug', true);
$app->log->setEnabled(true);
$app->get('/(/:error)', function ($error=false) use ($use) {
    if(isset($_SESSION["user_id"])){
        $use->app->redirect($use->app->urlFor('home'));
    }
    $use->template->prepare('login.html');
    $use->template->param('register?', true);
    $use->template->param('error', $error);
    $use->template->param('forgot_uri', "");
    $use->template->execute();
})->name('login');
?>