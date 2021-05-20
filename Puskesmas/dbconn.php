<?php

$host         = "localhost";
$username     = "root";
$password     = "";
$dbname       = "puskesmas";

try {
    $dbconn = new PDO('mysql:host=localhost;dbname=puskesmas', $username, $password);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
