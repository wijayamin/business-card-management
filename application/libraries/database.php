<?php
    $db = new PDO('mysql:host='. $database["host"].';port='.$database["port"].';dbname='. $database["name"], $database["username"], $database["password"]);
?>