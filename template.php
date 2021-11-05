<!-- Initialization -->
<?php include_once 'include/header.php';?>
<?php include_once 'include/fetch.php';?>
<link rel="stylesheet" href="index.css">


<div id="main">
<p>This is a dynamic page generated from a template through PHP</p>

<?php 
// GET requests change the URL
$index = $_GET['index'];
$sql = "SELECT * FROM names WHERE pid = '$index';";
$result = mysqli_query($conn, $sql);

// Checks if the query returned any data
if (mysqli_num_rows($result) > 0) {
    // Iterates through all (1) rows to extract data from the columns
    while($row = mysqli_fetch_assoc($result)) {
        echo '<p>Name found from database: <b>';
        echo $row['FirstName'] . ' ';
        echo $row['LastName'];
        echo '</b></p>';
    } 
} else {
    // Invalid query
    echo '<p><b>Invalid input</b></p>';
}
?>
<br>
<a href="index.php">Return</a>

</div>