<?php
    $app->get('/setting/registration', function () use ($use) {
        $use->template->prepare('registersetting.html');
        $use->template->param("users", $use->users);
        $use->template->param("privilege", Privilege($use->users["permission"]));
        $use->template->execute();
    })->name("registration-setting");
?>
