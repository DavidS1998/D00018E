<?php include_once 'fetch.php';

// Gets the product ID
$productname = $_POST['productname'];
$price = $_POST['price'];

$defaultstock = '10';
$defaulticon = "a.jpg";

mysqli_query($conn, "BEGIN");

// Increase stock by one
$sql = "INSERT INTO products (name, quantity, price, icon)
	VALUES ('$productname', '$defaultstock', '$price', '$defaulticon');";
$result = mysqli_query($conn, $sql);

if ($result) {
        mysqli_query($conn, "COMMIT");
        header("Location: ../index.php?addedproduct");

        } else {
        mysqli_query($conn, "ROLLBACK");
        header("Location: ../index.php?failedadding");
}
exit();
