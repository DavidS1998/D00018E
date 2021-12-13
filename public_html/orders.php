<?php include_once 'include/fetch.php';?>
<?php include_once 'include/header.php';?>
<link rel="stylesheet" href="index.css">
<div id="main">
<?php 

// Get a list of all orders, as well as associated product and user names
$sql = "SELECT o.*, u.username, u.id, p.id, p.name
        FROM orders o, users u, products p
        WHERE o.userID = u.id AND o.productID = p.id
        ORDER BY transactionID";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result))
{
        // Print out all orders
        echo "<div style='width: 100%; height: 80px;'>";
        echo "<p style='float: left;'>" . 
                            $row['transactionID'] . ". " .
                            $row['username'] . " BOUGHT " . 
                            $row['name'] . 
            "</p>\n";
        echo "</div>";
}
?>
</div>