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

// Adds to cart. If product is already in there, add quantity by one
$sql = "INSERT INTO cart (productID, userID)
	    VALUES ('$index', '$userID')
	    ON DUPLICATE KEY 
        UPDATE amount = amount + 1;";
mysqli_query($conn, $sql);


header("Location: ../template.php?index=$index&addedtocart");
exit();
