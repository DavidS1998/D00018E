<?php
// Code that establishes a connection to the SQL database, allowing for sending queries

// mySQL settings
$dbServername = "localhost";
$dbUsername = "admin";
$dbPassword = "admin123";
$dbName = "commerce";

// Saves the connection in a variable
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}