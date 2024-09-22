<?php
    
    session_start();

    include 'system_info.php';

    
    $con = mysqli_connect("localhost", "root", "", "project");

    // Check if the connection was successful
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get database statistics
    $db_stats = getDatabaseStats($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Monitoring Dashboard</title>
    <link rel="stylesheet" href="style2.css">

    <style>
        .signout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #ff4b5c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .signout-btn:hover {
            background-color: #ff6b7d;
        }

        .backup-btn {
            margin: 20px 0;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .backup-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <!-- Sign Out Button -->
    <a href="logout.php" class="signout-btn">Sign Out</a>

    <div class="container">
        <h1>System Monitoring Dashboard</h1>

        <!-- Server Uptime -->
        <div class="monitor-section">
            <h2>Server Uptime</h2>
            <p><?php echo getServerUptime(); ?></p>
        </div>

        <!-- CPU Load -->
        <div class="monitor-section">
            <h2>CPU Load</h2>
            <p><?php echo getCpuLoad(); ?></p>
        </div>

        <!-- Memory Usage -->
        <div class="monitor-section">
            <h2>Memory Usage</h2>
            <p><?php echo getMemoryUsage(); ?></p>
        </div>

        <!-- Automated Backups Section -->
        <div class="monitor-section">
            <h2>Automated Backups</h2>
            <form action="backup.php" method="post">
                <button class="backup-btn" type="submit">Backup Now</button>
            </form>
        </div>

        <!-- Database Statistics -->
        <div class="monitor-section">
            <h2>Database Statistics</h2>
            <table border="1">
                <tr>
                    <th>Table Name</th>
                    <th>Size (MB)</th>
                    <th>Records</th>
                </tr>
                <?php foreach ($db_stats as $stat): ?>
                <tr>
                    <td><?php echo htmlspecialchars($stat['Table'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($stat['Size (MB)'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($stat['Records'], ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <!-- File Storage Management -->
        <div class="monitor-section">
            <h2>File Storage Management</h2>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label for="fileUpload">Choose a file to upload:</label>
                <input type="file" name="fileUpload" id="fileUpload">
                <button type="submit">Upload</button>
            </form>
        </div>

        <!-- Display Uploaded Files -->
        <div class="monitor-section">
            <h2>Uploaded Files</h2>
            <ul>
                <?php
                // Check if 'uploads/' directory exists
                if (is_dir('uploads/')) {
                    $files = scandir('uploads/');
                    foreach ($files as $file) {
                        if ($file !== "." && $file !== "..") {
                            echo "<li><a href='uploads/$file' target='_blank'>" . htmlspecialchars($file, ENT_QUOTES, 'UTF-8') . "</a></li>";
                        }
                    }
                } else {
                    echo "No files uploaded yet.";
                }
                ?>
            </ul>
        </div>

    </div>

    <?php
    // Close the database connection
    mysqli_close($con);
    ?>
</body>
</html>
