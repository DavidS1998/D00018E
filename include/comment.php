<?php

// Gets the product ID
$index = $_POST['index'];
$comment = $_POST['comment'];
$userID = $_POST['userID'];

// Only users may upload comments
if ($userID == null) {
    header("Location: ../template.php?index=$index&error=notloggedin");
}

// 
$sql = "INSERT INTO comments (date, message, productID, userID)
        VALUES ('current_timestamp()', '$comment', '$index', '$userID');";

mysqli_query($conn, $sql);

/* // Prepared statement to prevent SQL injection attacks
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    // The query is invalid
    header("location: ../template.php?index=$index?error=queryfailed");
    exit();
}
// Input the parameter and send it to the SQL server
mysqli_stmt_bind_param($stmt, "ss", $name, $pwd);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
 */

header("Location: ../template.php?index=$index&comment_posted");
exit();