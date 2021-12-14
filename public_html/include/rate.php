<?php
require_once 'fetch.php';

// Gets the product ID
$index = $_POST['index'];
$rating = $_POST['rating'];
$userID = $_POST['userID'];

// Only users may rate products
if ($userID == null) {
    header("Location: ../template.php?index=$index&error=notloggedin");
	return;
}

mysqli_query($conn, "BEGIN");

// Adds a comment identified by the current time as key
$sql = "INSERT INTO ratings (productID, userID, rating)
	VALUES ('$index', '$userID', $rating)
	ON DUPLICATE KEY UPDATE
	rating = $rating;";
$result = mysqli_query($conn, $sql);

if ($result) {
	mysqli_query($conn, "COMMIT");
  } else {
	mysqli_query($conn, "ROLLBACK");
}


header("Location: ../template.php?index=$index&rated_product");
exit();
