<?php include_once 'include/fetch.php';?>
<?php include_once 'include/header.php';?>
<link rel="stylesheet" href="index.css">
<div id="main">
<?php 

mysqli_query($conn, "BEGIN");

// Get a list of all orders, as well as associated product and user names
$sql = "SELECT o.*, u.username, u.id, p.id, p.name
        FROM orders o, users u, products p
        WHERE o.userID = u.id AND o.productID = p.id
        ORDER BY transactionID";
$result = mysqli_query($conn, $sql);

if ($result) {
        mysqli_query($conn, "COMMIT");
      } else {
        mysqli_query($conn, "ROLLBACK");
}

while ($row = mysqli_fetch_assoc($result))
{
        // New order sequences are separated by a space
        if ($row['orderstart'] == 1) {
                echo "<div class='ordertable' style='width: 100%; height: 80px; margin-top: 20px;'>";
        } else {
                echo "<div class='ordertable' style='width: 100%; height: 80px;'>";
        }

        // Print out all orders
        echo "<p style='float: left;'>" . 
                $row['transactionID'] . ". <b>" .
                $row['username'] . "</b>: " . 
                htmlspecialchars($row['name']) . " FOR " .
                $row['price'] . "kr: ";
                if ($row['ordersum'] != 0) {
                        echo $row['ordersum'] . "KR total. ";
                if ($row['sent'] == 0) {
                        echo " <span style=\"color:red;\">PENDING</span>";
                        $transactionID = $row['transactionID'];

                        if (isset($_SESSION["userID"])) {
                                if ($_SESSION["admin"] == "1") {
                                        echo "<form action='include/send.php' style='margin-top: 20px' method='POST'>\n";
                                        echo "<input type='hidden' name='transactionID' value=" . $transactionID . " />\n";
                                        echo "<button type='submit' name='buy'>SEND</button>\n";
                                        echo "</form>";
                                }
                        }
                } else {
                        echo " <span style=\"color:greenyellow;\">SENT</span>";
                }
                
                }
                            
            echo "</p>\n";
        echo "</div>";
}
?>
</div>