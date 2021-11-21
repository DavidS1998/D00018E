<?php include_once 'fetch.php';

// Gets data from POST that is formatted by their named variables (see index.php)
$productname = $_GET['productname'];

// The current page is submit.php. 
// The user should return to the previous page after submitting.
header("Location: ./../index.php?search=$productname");
?>