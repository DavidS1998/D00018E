<?php include_once 'fetch.php';

// Gets the product ID
$index = $_POST['index'];
$newprice = $_POST['newprice'];

mysqli_query($conn, "BEGIN");

// Increase stock by one
$sql = "UPDATE products 
        SET price = '$newprice' 
        WHERE id = '$index'";
$result = mysqli_query($conn, $sql);

if ($result) {
        mysqli_query($conn, "COMMIT");
        } else {
        mysqli_query($conn, "ROLLBACK");
}

// Return
header("Location: ../template.php?index=$index");
exit();