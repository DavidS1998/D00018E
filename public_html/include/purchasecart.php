<?php
require_once 'fetch.php';

// Gets the user
$userID = $_POST['userID'];

mysqli_query($conn, "BEGIN");
// Gets cart and its contents
$sql = "SELECT c.*, p.*
        FROM cart c, products p
        WHERE c.userID = '$userID' AND c.productID = p.id;";
$result = mysqli_query($conn, $sql);

if ($result) {
    mysqli_query($conn, "COMMIT");
  } else {
    mysqli_query($conn, "ROLLBACK");
}

$outofstock = false;
$firstItem = '1';
$totalPrice = 0;

while ($row = mysqli_fetch_assoc($result))
{
    $productID = $row['productID'];
    $productsLeft = $row['quantity'];
    $requestedStock = $row['amount'];
    $price = $row['price'];


    if ($productsLeft - $requestedStock >= 0) {
        // Can be purchased

        // Update stock
        $sql = "UPDATE products 
                SET quantity = quantity - '$requestedStock'
                WHERE id = '$productID';";
        mysqli_query($conn, $sql);

        // Add to order log x times
        for ($i = 0; $i < $requestedStock; $i++) {
            $totalPrice += $price;
            $sql = "INSERT INTO orders (productID, userID, orderstart, price)
            VALUES ($productID, $userID, $firstItem, $price);";
            mysqli_query($conn, $sql);

            $firstItem = '0';
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

// Add final price to end of order
$sql = "UPDATE orders 
SET ordersum = '$totalPrice'
ORDER BY transactionID desc limit 1";
mysqli_query($conn, $sql);



if ($outofstock) {
    header("Location: ../shoppingcart.php?outofstock");
} else {
    header("Location: ../shoppingcart.php");
}

exit();




