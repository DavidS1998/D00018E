<?php
require_once 'fetch.php';

// Gets the user
$userID = $_POST['userID'];


// Gets cart and its contents
$sql = "SELECT c.*, p.*
        FROM cart c, products p
        WHERE c.userID = '$userID' AND c.productID = p.id;";
$result = mysqli_query($conn, $sql);

$outofstock = false;

while ($row = mysqli_fetch_assoc($result))
{
    $productID = $row['productID'];
    $productsLeft = $row['quantity'];
    $requestedStock = $row['amount'];

    if ($productsLeft - $requestedStock >= 0) {
        // Can be purchased

        // Update stock
        $sql = "UPDATE products 
                SET quantity = quantity - '$requestedStock'
                WHERE id = '$productID';";
        mysqli_query($conn, $sql);

        // Add to order log x times
        for ($i = 0; $i < $requestedStock; $i++) {
            $sql = "INSERT INTO orders (productID, userID)
            VALUES ($productID, $userID);";
            mysqli_query($conn, $sql);
          }
          
        // Remove from cart
        $sql = "DELETE FROM cart
        WHERE productID = '$productID' AND userID = '$userID';";
        mysqli_query($conn, $sql);
        
    } else {
        // Not enough
        $outofstock = true;
    }
}

if ($outofstock) {
    header("Location: ../shoppingcart.php?outofstock");
} else {
    header("Location: ../shoppingcart.php");
}

exit();




