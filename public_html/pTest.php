<?php include_once 'include/fetch.php';?>
<?php include_once 'include/header.php';?>
<link rel="stylesheet" href="index.css">

<div id="main">
    <table>
        <?php 
            // Get data from query
            $sql = "SELECT * FROM products;";
            $result = mysqli_query($conn, $sql);

            // Will iterate through every row
            while ($row = mysqli_fetch_assoc($result))
            {
                ?>
                <tr>
                    <?php echo "<td><a href='template.php?index=" . $row['pid'] . "'>" . $row['icon'] . "</td>\n";?>
                    <?php echo "<td><a href='template.php?index=" . $row['pid'] . "'>" . $row['name'] . "</a></td>\n";?>
                    <?php echo "<td>" . $row['price'] . "</td>\n";?>
                    <?php echo "<td>" . $row['quantity'] . "</td>\n";?>
                </tr>
                <?php
            }
        ?>
        </table>

</div>