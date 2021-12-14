<?php
require_once 'fetch.php';

// Gets the product ID
$date = $_POST['date'];
$index = $_POST['index'];

// Spaces may not be sent over HTTP POST
$date = str_replace("%20"," ",$date);

mysqli_query($conn, "BEGIN");

// Adds a comment identified by the current time as key
$sql = "DELETE FROM comments
        WHERE date = '$date';";
$result = mysqli_query($conn, $sql);

if ($result) {
        mysqli_query($conn, "COMMIT");
        } else {
        mysqli_query($conn, "ROLLBACK");
}

header("Location: ../template.php?index=$index");
exit();