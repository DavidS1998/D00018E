<?php include_once 'fetch.php';

// Gets the product ID
$index = $_POST['index'];
$quantity = 0;

// Find the product in the table
$sql = "SELECT * 
        FROM products 
        WHERE id = '$index';";
$result = mysqli_query($conn, $sql);

// Checks if the query returned any data
// Iterates through the row to extract data from the columns
while($row = mysqli_fetch_assoc($result)) {
    $quantity = $row['quantity'];
}

// Query for changing data in database (reduce by one)
if(!empty($index) && $quantity > 0)
{
    $sql = "UPDATE products 
            SET quantity = quantity - 1 
            WHERE id = '$index'";
    mysqli_query($conn, $sql);

    // The user should return to the previous product page after submitting.
    header("Location: ../template.php?index=$index");
} else {
    // Set GET if no stock is left while trying to purchase
    header("Location: ../template.php?index=$index&outofstock=1");
}


?>