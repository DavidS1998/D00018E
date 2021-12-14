<?php include_once 'include/fetch.php';?>
<?php include_once 'include/header.php';?>
<link rel="stylesheet" href="index.css">
<div id="main">
<?php 

$user = $_SESSION["userID"];

// Error handling
if (isset($_GET["outofstock"])) {
    echo "<p class='error'>The following products do not have enough stock to finalize the purchase.</p>";
}

// Get a list of all orders, as well as associated product and user names
$sql = "SELECT c.*, u.username, u.id, p.id, p.name, p.quantity
        FROM cart c, users u, products p
        WHERE c.userID = u.id AND c.productID = p.id AND c.userID = $user";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result))
{
        // Print out all orders
        echo "<div style='width: 100%; height: 80px;'>";
        echo "<p style='float: left;'>" . 
                            $row['name'] . ": " .
                            $row['amount'] .  "x; Remaining: " .
                            $row['quantity'] .  "x;" .
            "</p>\n";
?>
            <!-- Button for removing an entry from the cart -->
            <form action="include/removefromcart.php" method="POST">
            <?php echo '<input type="hidden" name="index" value="' . $row['productID'] . '" />'; ?>
            <?php echo '<input type="hidden" name="userID" value="' . $_SESSION["userID"] . '" />'; ?>
            <br>
            <button type="submit" name="submit">Remove</button>
            </form>
<?php
        echo "</div>";
}
?>

<!-- Button for removing an entry from the cart -->
<form action="include/purchasecart.php" method="POST">
            <?php echo '<input type="hidden" name="userID" value="' . $_SESSION["userID"] . '" />'; ?>
            <br>
            <button type="submit" name="submit">Buy all</button>
            </form>

</div>