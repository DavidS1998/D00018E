<?php include_once 'fetch.php';

// Gets data from POST that is formatted by their named variables (see index.php)
$first = $_POST['first'];
$last = $_POST['last'];



// Query for inserting data into database
if(!empty($first) AND !empty($last))
{
    $sql = "INSERT INTO names (FirstName, LastName) VALUES ('$first', '$last');";
    mysqli_query($conn, $sql);
} else {
    echo "<script type='text/javascript'>alert('Some fields are empty!');</script>";
}

// The current page is submit.php. 
// The user should return to the previous page after submitting.
//header("Location: ./../index.php?ValidationTextInURLHere");
?>