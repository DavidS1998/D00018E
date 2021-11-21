<?php

// Makes this page only accessible through a SUBMIT form
if (isset($_POST["submit"])) {
    $name = $_POST["username"];
    $pwd = $_POST["password"];
    $pwdrep = $_POST["password-repeat"];

    require_once 'fetch.php';

    // Error handling
    if (emptyInputSignup($name, $pwd, $pwdrep) !== false) {
        header("location: ../register.php?error=inputempty");
        exit();
    }
    if (passwordMatch($pwdrep, $pwd) !== false) {
        header("location: ../register.php?error=repeatwrong");
        exit();
    }
    if (alreadyExists($name, $conn) !== false) {
        header("location: ../register.php?error=alreadyexists");
        exit();
    }
    // Error handling done

    // Create the valid user
    createUser($conn, $name, $pwd);

} else {
    // If accessed directly through the URL, it will
    // simply send the user back to the home page
    header("location: ../index.php");
    exit();
}



// Create a new user with the set values
function createUser($conn, $name, $pwd) {
    $sql = "INSERT INTO users (username, password)
            VALUES (?, ?);";
    
    // Prepared statement to prevent SQL injection attacks
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // The query is invalid
        header("location: ../register.php?error=queryfailed");
        exit();
    }
    // Input the parameter and send it to the SQL server
    mysqli_stmt_bind_param($stmt, "ss", $name, $pwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../register.php?success");
    exit();
}

// Error handling function
function emptyInputSignup($name, $pwd, $pwdrep) {
    $result = false;
    if (empty($name) || empty($pwd) || empty($pwdrep)) {
        $result = true;
    }
    return $result;
}
// Error handling function
function passwordMatch($pwdrep, $pwd) {
    $result = false;
    if ($pwd !== $pwdrep) {
        $result = true;
    }
    return $result;
}
// Error handling function
function alreadyExists($name, $conn) {
    $result = false;
    $sql = "SELECT * 
            FROM users
            WHERE username = ?;";
    
    // Prepared statement to prevent SQL injection attacks
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // The query is invalid
        header("location: ../register.php?error=queryfailed");
        exit();
    }
    // Input the parameter and send it to the SQL server
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);

    // Stores returned data
    $resultData = mysqli_stmt_get_result($stmt);

    // Checks if the data contains anything (a user)
    if (mysqli_fetch_assoc($resultData)) {
        $result = true;
    }
    return $result;

    // Close the call
    mysqli_stmt_close($stmt);
}

