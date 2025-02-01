<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "cozy_shelf";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "dziala";
} catch (PDOException $e) {
    echo "nie dziala" . $e->getMessage();
}