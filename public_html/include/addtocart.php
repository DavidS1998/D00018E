<?php
require_once 'fetch.php';

// Gets the product ID
$index = $_POST['index'];
$userID = $_POST['userID'];

// Only users may add products to cart
if ($userID == null) {
    header("Location: ../template.php?index=$index&error=notloggedincart");
    exit();
}

mysqli_query($conn, "BEGIN");

// Adds to cart. If product is already in there, add quantity by one
$sql = "INSERT INTO cart (productID, userID)
	    VALUES ('$index', '$userID')
	    ON DUPLICATE KEY 
        UPDATE amount = amount + 1;";
$result = mysqli_query($conn, $sql);

if ($result) {
    mysqli_query($conn, "COMMIT");
  } else {
    mysqli_query($conn, "ROLLBACK");
}

header("Location: ../template.php?index=$index&addedtocart");
exit();
