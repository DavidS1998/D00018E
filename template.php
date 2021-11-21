<!-- Initialization -->
<?php include_once 'include/header.php';?>
<?php include_once 'include/fetch.php';?>
<link rel="stylesheet" href="index.css">


<div id="main">

<?php 
// Variables to hold product data in
$index = $_GET['index'];
$outofstock = $_GET['outofstock'];
$name = "";
$quantity = 0;
$price = 0;
$rating = 0;
$icon = "";

// Alert the user if the item they were trying to buy is unavailable
if ($outofstock == 1) {
    echo "<p class='error'>Product is out of stock!</p>";
}

// Find the product in the table
$sql = "SELECT * 
        FROM products 
        WHERE id = '$index';";
$result = mysqli_query($conn, $sql);

// Checks if the query returned any data
if (mysqli_num_rows($result) > 0) {
    // Iterates through the row to extract data from the columns
    while($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $quantity = $row['quantity'];
        $price = $row['price'];
        $rating = $row['rating'];
        $icon = $row['icon'];
    } 
} else {
    // Invalid query
    echo '<p><b>Invalid input</b></p>';
}

// Outputs HTML elements containing the data
// Can be prettied up easily
echo '<p><b>' . $name . '</b></p>';
echo '<br>';
echo '<img src="icon/' . $icon  . '">';
echo "<p>Stock remaining: " . $quantity . "</p>";
echo "<p>Price: " . $price . "kr</p>";
echo "<p>Rating: " . $rating . "</p>";

// Reduce quantity by one for indexed product when button pressed
?>
<form action="include/purchase.php" method="POST">
        <?php echo '<input type="hidden" name="index" value="' . $index . '" />'; ?>
        <button type="submit" name="buy">Purchase</button>
</form>
<br>
<a href="index.php">Return</a>


</div>
