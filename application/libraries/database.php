<?php
try {
    $db = new PDO('mysql:host='. $database["host"].';port='.$database["port"].';dbname='. $database["name"], $database["username"], $database["password"]);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
