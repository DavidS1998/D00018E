<?php include_once 'fetch.php';

// Gets the product ID
$index = $_POST['index'];
$quantity = 0;
$userID = $_POST['userID'];



if (isset($_POST['userID'])) {
    if (empty($_POST['userID'])) {
        // If not logged in, refuse the request
        header("Location: ../template.php?index=$index&error=notloggedintobuy");
        exit();
    }
}

//////////////////////
    // Transaction begin
mysqli_query($conn, "BEGIN");


// Find the product in the table
$sql = "SELECT * 
        FROM products 
        WHERE id = '$index';";
$result = mysqli_query($conn, $sql);

// Use to test transactions: Attempt to purchase 
// something with 1 stock remaining from two tabs
sleep(1);

// Checks if the query returned any data
// Iterates through the row to extract data from the columns
while($row = mysqli_fetch_assoc($result)) {
    $quantity = $row['quantity'];
}

// Query for changing data in database (reduce by one)
if(!empty($index) && $quantity > 0)
{

    // Update quantity
    $sql = "UPDATE products 
            SET quantity = quantity - 1 
            WHERE id = '$index'";
    $result = mysqli_query($conn, $sql);

    // Add to order log
    $sql = "INSERT INTO orders (productID, userID)
    VALUES ($index, $userID);";
    $result = mysqli_query($conn, $sql);

    // Check if the query succeeded
    if ($result) {
        // Commit if it did
        mysqli_query($conn, "COMMIT");

        // The user should return to the previous product page after submitting.
        header("Location: ../template.php?index=$index");
    } else {
        // Rollback if it didn't
        mysqli_query($conn, "ROLLBACK");

        // The user should return to the previous product page after submitting.
        header("Location: ../template.php?index=$index&error=transactionfail");
    }
    
} else {
    // Set GET if no stock is left while trying to purchase
    header("Location: ../template.php?index=$index&outofstock=1");
}


?>