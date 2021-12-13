<?php include_once 'fetch.php';

// Gets the product ID
$index = $_POST['index'];

// Increase stock by one
$sql = "UPDATE products 
        SET quantity = quantity + 1 
        WHERE id = '$index'";
mysqli_query($conn, $sql);

// Return
header("Location: ../template.php?index=$index");
exit();