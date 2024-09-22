<?php
session_start();

// Database connection details
$host = "localhost";
$db_username = "root";  // Your database username
$db_password = "";      // Your database password
$dbname = "admin_table";    // Your database name

// Create a database connection
$con = mysqli_connect($host, $db_username, $db_password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the submitted username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare the SQL query to fetch the user from the 'admin_details' table
$stmt = mysqli_prepare($con, "SELECT * FROM admin_details WHERE username=?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

// Check if the user exists
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    // Compare the password entered by the user with the stored password in the database
    if ($password === $row['password']) {  // You should use password_hash() and password_verify() for security

        // Set session variable to track admin login status
        $_SESSION['isAdmin'] = true;

        // Redirect to the system monitoring dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Redirect back to login with an error message if the password is incorrect
        header("Location: admin.html?error=Invalid username or password");
        exit();
    }
} else {
    // Redirect back to login with an error message if the username is not found
    header("Location: admin.html?error=Invalid username or password");
    exit();
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($con);
?>
