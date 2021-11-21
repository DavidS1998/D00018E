<!-- Initialization -->
<?php include_once 'include/fetch.php';?>
<?php include_once 'include/header.php';?>
<link rel="stylesheet" href="index.css">

<div id="main">
    <section class="login-form">
        <p>Log in</p>
        <form action="./include/login-inc.php" method="post">
            <input type="text" name="username" placeholder="Username...">
            <input type="password" name="password" placeholder="Password...">
            <button type="submit" name="submit">Log in</button>
        </form>
    </section>

    <?php
    // Display errors
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "invalidlogin") {
            echo "<p class='error'>Credentials incorrect</p>";
        }
    } else if (isset($_GET["success"])) {
        echo "<p class='success'>Login succesful!</p>";
    }
    ?>

</div>