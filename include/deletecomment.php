<?php
require_once 'fetch.php';

// Gets the product ID
$date = $_POST['date'];
$index = $_POST['index'];

// Spaces may not be sent over HTTP POST
$date = str_replace("%20"," ",$date);

// Adds a comment identified by the current time as key
$sql = "DELETE FROM comments
        WHERE date = '$date';";
mysqli_query($conn, $sql);

header("Location: ../template.php?index=$index");
exit();