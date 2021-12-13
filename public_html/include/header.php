<?php
// If a session has been started by logging,
// session variables will now be accessible
// from every page through the header
    session_start();
?>

<header>
<div id="header">
    <div>
        <p style="width: 200px">Group 07</p>
    </div>
    <div>
        <p><a href="../index.php">Home</a></p>
    </div>
    <div>
        <p><a href="../orders.php">Orders</a></p>
    </div>

    <?php
    // Change how the header looks when logged in
    // Log out button if logged in
    if (isset($_SESSION["userID"])) {
        $adminStatus = "No";
        if ($_SESSION["admin"] == "1") {
            $adminStatus = "Yes";
        }

        echo "<div style='float: right;'>" .
        "<p><a href='./include/logout.php'>Log out</a></p>" .
        "</div>";

        echo "<div style='float: right;'>" .
        "<p><a href='./shoppingcart.php'>Cart</a></p>" .
        "</div>";
        
        // User info
        echo "<div style='width: 500px;'>";
        echo "<p>ID: " . $_SESSION["userID"] . "</p>";
        echo "<p>" . $_SESSION["username"] . "</p>";
        echo "<p>Admin: " . $adminStatus . "</p>";
        echo "</div>";
    } else {
        echo "<div style='float: right;'>" .
        "<p><a href='./login.php'>Login</a></p>" .
        "</div>";

        echo "<div style='float: right;'>" .
        "<p><a href='./register.php'>Register</a></p>" .
        "</div>";
    }
    ?>
</div>
</header>