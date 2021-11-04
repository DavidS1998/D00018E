<?php
// Code that establishes a connection to the SQL database, allowing for sending queries

// mySQL settings
$dbServername = "localhost";
$dbUsername = "admin";
$dbPassword = "admin";
$dbName = "testdb";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
?>