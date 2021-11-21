<?php

if (isset($_POST["submit"])) {
    $name = $_POST["username"];
    $pwd = $_POST["password"];

    require_once 'fetch.php';

    // Error handling
    if (emptyInputLogin($name, $pwd, $pwdrep) !== false) {
        header("location: ../login.php?error=inputempty");
        exit();
    }

    // Check if credentials are correct
    $userExists = loginUser($conn, $name, $pwd);
    if ($userExists === false) {
        header("location: ../login.php?error=invalidlogin");
        exit();
    }
    // User is now logged in, start a session
    session_start();
    $_SESSION["username"] = $userExists["username"];
    $_SESSION["userID"] = $userExists["id"];
    $_SESSION["admin"] = $userExists["admin"];

    header("location: ../login.php?success");
    exit();

} else {
    // If accessed directly through the URL, it will
    // simply send the user back to the home page
    header("location: ../index.php");
    exit();
}


// Log in as user
function loginUser($conn, $name, $pwd) {
    $result = false;
    $sql = "SELECT * 
            FROM users
            WHERE username = ? AND password = ?;";
    
    // Prepared statement to prevent SQL injection attacks
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // The query is invalid
        header("location: ../login.php?error=queryfailed");
        exit();
    }
    // Input the parameter and send it to the SQL server
    mysqli_stmt_bind_param($stmt, "ss", $name, $pwd);
    mysqli_stmt_execute($stmt);

    // Stores returned data
    $resultData = mysqli_stmt_get_result($stmt);

    // Returns row with user data (if it exists)
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    return $result;

    // Close the call
    mysqli_stmt_close($stmt);
}


// Error handling function
function emptyInputLogin($name, $pwd) {
    $result = false;
    if (empty($name) || empty($pwd)) {
        $result = true;
    }
    return $result;
}