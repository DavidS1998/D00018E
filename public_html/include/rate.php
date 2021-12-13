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

// Adds a comment identified by the current time as key
$sql = "INSERT INTO ratings (productID, userID, rating)
	VALUES ('$index', '$userID', $rating)
	ON DUPLICATE KEY UPDATE
	rating = $rating;";
mysqli_query($conn, $sql);


header("Location: ../template.php?index=$index&rated_product");
exit();
