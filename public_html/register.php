<!-- Initialization -->
<?php include_once 'include/fetch.php';?>
<?php include_once 'include/header.php';?>
<link rel="stylesheet" href="index.css">

<div id="main">
    <section class="register-form">
        <p>Register</p>
        <form action="./include/register-inc.php" method="post">
            <input type="text" name="username" placeholder="Username...">
            <input type="password" name="password" placeholder="Password...">
            <input type="password" name="password-repeat" placeholder="Repeat password...">
            <button type="submit" name="submit">Register</button>
        </form>
    </section>

    <?php
    // Display errors
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "inputempty") {
            echo "<p class='error'>Empty input</p>";
        } else if ($_GET["error"] == "repeatwrong") {
            echo "<p class='error'>Password mismatch</p>";
        } else if ($_GET["error"] == "alreadyexists") {
            echo "<p class='error'>User already exists</p>";
        } else if ($_GET["error"] == "queryfailed") {
            echo "<p class='error'>SQL query error</p>";
        }
    } else if (isset($_GET["success"])) {
        echo "<p class='success'>Registration successful!</p>";
    }
    ?>
</div>


