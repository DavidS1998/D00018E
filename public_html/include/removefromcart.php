<?php
require_once 'fetch.php';

// Gets the product in the cart
$userID = $_POST['userID'];
$productID = $_POST['index'];

mysqli_query($conn, "BEGIN");

// Adds a comment identified by the current time as key
$sql = "DELETE FROM cart
        WHERE productID = '$productID' AND userID = '$userID';";
$result = mysqli_query($conn, $sql);

if ($result) {
        mysqli_query($conn, "COMMIT");
      } else {
        mysqli_query($conn, "ROLLBACK");
}

header("Location: ../shoppingcart.php");
exit();