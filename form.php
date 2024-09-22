<?php
    // getting all values from the HTML form
    $Uname = $_POST['Uname'];
    $Pass = $_POST['Pass'];

    // database details
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname);

    // to ensure that the connection is made
    if (!$con)
    {
        die("Connection failed!" . mysqli_connect_error());
    }

    // using prepared statement to prevent SQL injection attacks
    $stmt = mysqli_prepare($con, "SELECT * FROM user_details WHERE username=? AND password=?");
    mysqli_stmt_bind_param($stmt, "ss", $Uname, $Pass);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // check if query was successful and get row data
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // check if username and password match
        if ($row['username'] === $Uname && $row['password'] === $Pass) {
            // start session and set logged in user
            session_start();
            $_SESSION['user_id'] = $row['id'];

            // redirect to index.html
            header("Location: index.html");
            exit();
        } else {
            // redirect back to login.html with error message
            header("Location: login.html?error=Incorrect username or password");
			
            exit();
        }
    } else {
        // redirect back to login.html with error message
        header("Location: login.html?error=Incorrect username or password");
		
        exit();
    }

    // close connection
    mysqli_close($con);
?>

