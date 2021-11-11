<!-- Initialization -->
<?php include_once 'include/header.php';?>
<?php include_once 'include/fetch.php';?>
<link rel="stylesheet" href="index.css">
<script type="text/javascript" src="include/purchase.js"></script>


<div id="main">

<?php 
// GET requests change the URL
$index = $_GET['index'];
$name = "";
$quantity = 0;
$price = 0;
$rating = 0;
$icon = "";

$sql = "SELECT * FROM products WHERE id = '$index';";
$result = mysqli_query($conn, $sql);

// Checks if the query returned any data
if (mysqli_num_rows($result) > 0) {
    // Iterates through all (1) rows to extract data from the columns
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

echo '<p><b>' . $name . '</b></p>';
echo '<br>';
echo '<img src="icon/' . $icon  . '">';
echo "<p>Stock remaining: " . $quantity . "</p>";
echo "<p>Price: " . $price . "kr</p>";
echo $index;


//echo "<p>Rating: " . $rating . "</p>";

// Reduce quantity by one for indexed product
// (Should not work if quantity is zero)

?>
<form action="include/purchase.php" method="POST">
        <?php echo '<input type="hidden" name="index" value="' . $index . '" />'; ?>
        <button type="submit" name="buy">Purchase</button>
</form>
<br>
<a href="index.php">Return</a>


</div>
