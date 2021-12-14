<?php
require_once 'fetch.php';

// Gets the product ID
$index = $_POST['index'];
$comment = $_POST['comment'];
$userID = $_POST['userID'];

// Only users may upload comments
if ($userID == null) {
    header("Location: ../template.php?index=$index&error=notloggedin");
}

mysqli_query($conn, "BEGIN");

// Adds a comment identified by the current time as key
$sql = "INSERT INTO comments (date, message, productID, userID)
        VALUES (now(), '$comment', $index, $userID);";
$result = mysqli_query($conn, $sql);

if ($result) {
    mysqli_query($conn, "COMMIT");
  } else {
    mysqli_query($conn, "ROLLBACK");
}

header("Location: ../template.php?index=$index&comment_posted");
exit();
