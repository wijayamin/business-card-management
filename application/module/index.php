<?php
$app->config('debug', true);
$app->log->setEnabled(true);
$app->get('/', function () use ($use) {
    $use->app->redirect($use->app->urlFor('login'));
});
?>
