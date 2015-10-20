<?php
$app->get('/asu', function () use ($use) {
    $lala = function ($lala){
        return $lala;
    };

    $lele = function () use ($lala){
        return $lala("asu")   ;
    };

    echo $lele();
    echo $lele();

});
?>
