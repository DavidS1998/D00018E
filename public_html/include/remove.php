<?php include_once 'fetch.php';

// Gets the product ID
$index = $_POST['index'];

mysqli_query($conn, "BEGIN");

// Increase stock by one
$sql = "DELETE FROM products 
        WHERE id = '$index'";
$result = mysqli_query($conn, $sql);

if ($result) {
        mysqli_query($conn, "COMMIT");
        } else {
        mysqli_query($conn, "ROLLBACK");
}

// Return
header("Location: ../index.php");
exit();