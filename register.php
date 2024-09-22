<?php
    // getting all values from the HTML form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // database details
    $host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "project";

    // creating a connection
    $con = mysqli_connect($host, $db_username, $db_password, $db_name);

    // to ensure that the connection is made
    if (!$con)
    {
        die("Connection failed!" . mysqli_connect_error());
    }

    // using prepared statement to prevent SQL injection attacks
    $stmt = mysqli_prepare($con, "INSERT INTO user_details (username, password) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);

    // close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);

    // redirect back to login.html with success message
    header("Location: login.html?message=Registration successful");
    exit();
?>
