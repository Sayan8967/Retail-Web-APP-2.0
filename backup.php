<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "project";
$con = mysqli_connect($host, $username, $password, $database);

// Check connection
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

$backupFile = 'backups/' . $database . '_backup_' . date('Y-m-d_H-i-s') . '.sql';
$tables = mysqli_query($con, "SHOW TABLES");
$sqlScript = "";

// Loop through all tables and get data
while ($table = mysqli_fetch_row($tables)) {
    $tableName = $table[0];
    $createTableQuery = mysqli_fetch_row(mysqli_query($con, "SHOW CREATE TABLE $tableName"));
    $sqlScript .= "\n\n" . $createTableQuery[1] . ";\n\n";

    $rows = mysqli_query($con, "SELECT * FROM $tableName");
    while ($row = mysqli_fetch_assoc($rows)) {
        $sqlScript .= "INSERT INTO $tableName VALUES(";
        foreach ($row as $value) {
            $sqlScript .= '"' . addslashes($value) . '", ';
        }
        $sqlScript = substr($sqlScript, 0, -2) . ");\n";
    }
}

if (!empty($sqlScript)) {
    file_put_contents($backupFile, $sqlScript);
    echo "Backup created successfully!";
} else {
    echo "Failed to create the backup!";
}

mysqli_close($con);
?>
