<!-- Initialization -->
<?php include_once 'include/fetch.php';?>
<?php include_once 'include/header.php';?>
<link rel="stylesheet" href="index.css">

<div id="main">
    <!--Search box. Whatever is in the search box will be sent to "submit.php", 
    where it will then redirect back here with the search terms appended as 
    ?search in the URL-->
    <form action="include/submit.php" method="GET">
        <input type="text" name="productname" placeholder="Search">
        <br>
        <button type="submit" name="submit">Search</button>
    </form>

    <!-- Test PHP code that gets all names from the database, 
    and creates an HTML table with them -->
    <?php 
        mysqli_query($conn, "BEGIN");
        // Gets search data from the URL, if there is any
        $search = $_GET['search'];
        
        $sql = "";
        // Check if there are any searched words
        if (empty($search)) {
            // If not, then return the entire index
            $sql = "SELECT * 
                    FROM products;";
        } else {
            // Otherwise, return data that contains the search terms in the product name
            $sql = "SELECT * 
                    FROM products 
                    WHERE name 
                    LIKE '%$search%';";
        }
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
            echo "<div>";
            echo "<a href='template.php?index=" . $row['id'] . "'>" . $row['name'] . "</a>\n";
            echo "<img src='icon/" . $row['icon'] . "'>\n";
            echo "<b>" . $row['price'] . "kr</b>\n";
            echo "</div>";
        }
    ?>
</div>
