<?php
require_once 'fetch.php';

// Gets the product in the cart
$userID = $_POST['userID'];
$productID = $_POST['index'];


// Adds a comment identified by the current time as key
$sql = "DELETE FROM cart
        WHERE productID = '$productID' AND userID = '$userID';";
mysqli_query($conn, $sql);

header("Location: ../shoppingcart.php");
exit();