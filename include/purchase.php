<?php include_once 'fetch.php';

// Gets data from POST that is formatted by their named variables (see index.php)
$index = $_POST['index'];

// Query for inserting data into database
if(!empty($index))
{
    $sql = "UPDATE products SET quantity = quantity - 1 WHERE id = '$index'";
    mysqli_query($conn, $sql);
}

// The current page is submit.php. 
// The user should return to the previous page after submitting.
header("Location: ../template.php?index=$index");
?>