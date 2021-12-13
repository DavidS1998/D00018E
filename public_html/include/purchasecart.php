<?php
require_once 'fetch.php';

// Gets the user
$userID = $_POST['userID'];


// Adds a comment identified by the current time as key
$sql = ";";
mysqli_query($conn, $sql);

header("Location: ../shoppingcart.php");
exit();