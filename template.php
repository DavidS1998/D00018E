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
// Tell the user that they are not logged in when commenting
if (isset($_GET["error"])) {
    if ($_GET["error"] == "notloggedin") {
        echo "<p class='error'>You need to log in to comment</p>";
    }
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
<form action="include/comment.php" method="POST">
    <textarea name="comment" placeholder="Comment..."></textarea>
    <?php echo '<input type="hidden" name="index" value="' . $index . '" />'; ?>
    <?php echo '<input type="hidden" name="userID" value="' . $_SESSION["userID"] . '" />'; ?>
    <br>
    <button type="submit" name="submit">Post</button>
</form>

<form action="include/rate.php" method="POST">
    <input type="range" min="1" max="10" value="5">
    <?php echo '<input type="hidden" name="index" value="' . $index . '" />'; ?>
    <br>
    <button type="submit" name="submit">Rate</button>
</form>
  
<?php
    // Commment section
    // Query to load all comments
    $sql = "SELECT * 
        FROM comments 
        WHERE productID = '$index'
        ORDER BY date;";

    // Holds the resulting query results
    $result = mysqli_query($conn, $sql);

    // Will iterate through every row and output HTML elements on the page
    // Should be improved to look better and be easier to modify
    while ($row = mysqli_fetch_assoc($result))
    {
        echo "<div>" . "\n";
        echo $row['date'] . "\n";
        echo "<br>" . "\n";
        echo "From user: " . $row['userID'] . "\n";
        echo "<br>" . "\n";
        echo $row['message'] . "\n";
        echo "<br>" . "\n";
        echo "</div>" . "\n";
    }
?>
</div>
</div>
