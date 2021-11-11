<!-- Initialization -->
<?php include_once 'include/fetch.php';?>
<?php include_once 'include/header.php';?>
<link rel="stylesheet" href="index.css">


<div id="main">
    <!-- Form for adding new names into the database -->
    <!-- All form data is sent to the submit.php file, through POST -->
    <!-- GET will show data in URL, POST will hide them
    <form action="include/submit.php" method="POST">
        <input required type="text" name="first" placeholder="First name">
        <br>
        <input required type="text" name="last" placeholder="Last name">
        <br>
        <button type="submit" name="submit">Submit name</button>
    </form> -->

    <!-- Test PHP code that gets all names from the database, 
    and creates an HTML table with them -->
    <?php 
        // Get data from query
        $sql = "SELECT * FROM products;";
        $result = mysqli_query($conn, $sql);

        // Will iterate through every row
        while ($row = mysqli_fetch_assoc($result))
        {
            ?>
                <?php echo "<a href='template.php?index=" . $row['id'] . "'>" . $row['name'] . "</a>\n";?>
                <?php echo "<b>" . $row['price'] . "kr</b>\n";?>
                <?php echo "<img src='icon/" . $row['icon'] . "'>\n";?>
            <?php
        }
    ?>


    <!-- Sends data to a template script, which will generate a page
    based on the input sent here. 
    Uses GET, which will result in a different URL
    <form action="template.php" method="GET">
        <input type="text" name="index" placeholder="Input #ID from list">
        <br>
        <button type="submit" name="test">Dynamically generated page test</button>
    </form>-->

</div>
