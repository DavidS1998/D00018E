<?php include_once 'fetch.php';

// Gets the product ID
$transactionID = $_POST['transactionID'];

mysqli_query($conn, "BEGIN");

// Increase stock by one
$sql = "UPDATE orders 
        SET sent = '1' 
        WHERE transactionID = '$transactionID'";
$result = mysqli_query($conn, $sql);

if ($result) {
        mysqli_query($conn, "COMMIT");
        } else {
        mysqli_query($conn, "ROLLBACK");
}

// Return
header("Location: ../orders.php");
exit();