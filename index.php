<?php include_once 'fetch.php';?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="index.css">
</head>
<body">

<div>
    <!-- Form for adding new names into the database -->
    <!-- All form data is sent to the submit.php file, through POST -->
    <!-- GET will show data in URL, POST will hide them -->
    <form action="submit.php" method="POST">
        <input type="text" name="first" placeholder="First name">
        <br>
        <input type="text" name="last" placeholder="Last name">
        <br>
        <button type="submit" name="submit">Submit name</button>
    </form>

    <!-- Test PHP code that gets all names from the database, 
    and creates an HTML table with them -->
    <table>
    <?php 
        // Get data from query
        $sql = "SELECT * FROM names;";
        $result = mysqli_query($conn, $sql);

        // Will iterate through every row
        while ($row = mysqli_fetch_assoc($result))
        {
            ?>
            <tr>
                <?php echo "<td>" . $row['pid'] . "</td>\n";?>
                <?php echo "<td>" . $row['FirstName'] . "</td>\n";?>
                <?php echo "<td>" . $row['LastName'] . "</td>\n";?>
            </tr>
            <?php
        }
    ?>
    </table>
</div>
</body>