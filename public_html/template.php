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
        echo "<p class='error'>You need to log in to rate or comment</p>";
    // Concurrent purchase
    } else if ($_GET["error"] == "transactionfail") {
        echo "<p class='error'>Someone else bought that first!</p>";
    // Guest attempts to buy a product
    } else if ($_GET["error"] == "notloggedintobuy") {
        echo "<p class='error'>Please log in to buy first!</p>";
    // Guest attempts to add product to cart
    } else if ($_GET["error"] == "notloggedincart") {
        echo "<p class='error'>Please log in to add to cart!!</p>";
    }
}

mysqli_query($conn, "BEGIN");

// Find the product in the table
// Will get ratings from the ratings table as an average with 1 decimal
$sql = "SELECT products.*, round(avg(ratings.rating),1) AS average
        FROM products LEFT JOIN ratings ON products.id = ratings.productID
        WHERE products.id = '$index';";
$result = mysqli_query($conn, $sql);

// Checks if the query returned any data
if (mysqli_num_rows($result) > 0) {
    mysqli_query($conn, "COMMIT");
    // Iterates through the row to extract data from the columns
    while($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $quantity = $row['quantity'];
        $price = $row['price'];
        $rating = $row['average'];
        $icon = $row['icon'];
    } 
} else {
    // Invalid query
    mysqli_query($conn, "ROLLBACK");
    echo '<p><b>Invalid input</b></p>';
}

// Outputs HTML elements containing the data
// Can be prettied up easily
echo '<p><b>' . htmlspecialchars($name) . '</b></p>';
echo '<br>';
echo '<img src="icon/' . $icon  . '">';
echo "<p>Stock remaining: " . $quantity . "</p>";
echo "<p>Price: " . $price . "kr</p>";
echo "<p>Rating: " . $rating . "</p>";

// Reduce quantity by one for indexed product when button pressed
?>
<form action="include/purchase.php" method="POST">
        <?php echo '<input type="hidden" name="index" value="' . $index . '" />'; ?>
        <?php echo '<input type="hidden" name="userID" value="' . $_SESSION["userID"] . '" />'; ?>
        <button type="submit" name="buy">Purchase</button>
</form>
<form action="include/addtocart.php" method="POST">
        <?php echo '<input type="hidden" name="index" value="' . $index . '" />'; ?>
        <?php echo '<input type="hidden" name="userID" value="' . $_SESSION["userID"] . '" />'; ?>
        <button type="submit" name="cart">Add to Cart</button>
</form>
<form action="include/rate.php" method="POST">
    <input name="rating" type="range" min="1" max="10" value="5">
    <?php echo '<input type="hidden" name="index" value="' . $index . '" />'; ?>
    <?php echo '<input type="hidden" name="userID" value="' . $_SESSION["userID"] . '" />'; ?>
    <br>
    <button type="submit" name="submit">Rate</button>
</form>
<?php
if (isset($_SESSION["userID"])) {
    if ($_SESSION["admin"] == "1") {
        echo "Admin commands";
        echo "<form action='include/restock.php' method='POST'>\n";
        echo "<input type='hidden' name='index' value=" . $index . " />\n";
        echo "<button type='submit' name='buy'>Restock +1</button>\n";
        echo "</form>";

        echo "<form action='include/changeprice.php' method='POST'>\n";
        echo "<input type='hidden' name='index' value=" . $index . " />\n";
        echo "<input type='number' name='newprice' min='0'>";
        echo "<button type='submit' name='buy'>Change price</button>\n";
        echo "</form>";

        /*
        echo "<form action='include/remove.php' method='POST' onsubmit='return confirm(\"Are you certain you want to delete this page?\");'>\n";
        echo "<input type='hidden' name='index' value=" . $index . " />\n";
        echo "<button type='submit'name='buy'>[Remove product]</button>\n";
        echo "</form>";
        */
    }
}
?>
<br>
<form action="include/comment.php" method="POST">
    <textarea name="comment" placeholder="Comment..."></textarea>
    <?php echo '<input type="hidden" name="index" value="' . $index . '" />'; ?>
    <?php echo '<input type="hidden" name="userID" value="' . $_SESSION["userID"] . '" />'; ?>
    <br>
    <button type="submit" name="submit">Post</button>
</form>


  
<?php
    // Commment section
    // Query to load all comments
    // Newest comments are up top
    mysqli_query($conn, "BEGIN");
    $sql = "SELECT c.*, u.username, u.id
        FROM comments c, users u 
        WHERE c.productID = '$index' AND userID = id
        ORDER BY c.date DESC;";

    // Holds the resulting query results
    $result = mysqli_query($conn, $sql);

    if ($result) {
        mysqli_query($conn, "COMMIT");
    } else {
        mysqli_query($conn, "ROLLBACK");
    }

    // Will iterate through every row and output HTML elements on the page
    // Should be improved to look better and be easier to modify
    while ($row = mysqli_fetch_assoc($result))
    {
        // Spaces may not be sent over HTTP POST
        $date = $row['date'];
        $date = str_replace(" ","%20",$date);

        echo "<div style='height: 300px;'>" . "\n";

        // Admin delete button
        if (isset($_SESSION["userID"])) {
            if ($_SESSION["admin"] == "1") {
                echo "<form action='include/deletecomment.php' method='POST'>\n";
                echo "<input type='hidden' name='date' value=" . $date . " />\n";
                echo "<input type='hidden' name='index' value=" . $index . " />\n";
                echo "<button type='submit' name='submit'>Delete</button>\n";
                echo "</form>";
            }
        }

        echo $row['date'] . "\n";
        echo "<br>" . "\n";
        echo "From: " . $row['username'] . "\n";
        echo "<br>" . "\n";
        echo "<h3>" . htmlspecialchars($row['message']) . "</h3>\n";
        echo "<br>" . "\n";
        echo "</div>" . "\n";
    }
?>
</div>
</div>
