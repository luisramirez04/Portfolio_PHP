<?php

$servername = "localhost";
$username = "luisr900_webuser";
$password = "superSecUrePassWorD!";
$dbName = "luisr900_portfolio";

$conn = new mysqli($servername, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else {
    echo "Successfully connected to database";
}

?>