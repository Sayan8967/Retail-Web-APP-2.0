<!-- system_info.php -->

<?php
// Function to get server uptime
function getServerUptime() {
    $uptime = shell_exec('systeminfo | find "System Boot Time"');
    
    if ($uptime) {
        return trim($uptime);
    } else {
        return "Unable to retrieve uptime.";
    }
}

// Function to get CPU load
function getCpuLoad() {
    // 'wmic' command to get CPU load percentage
    $load = shell_exec('wmic cpu get loadpercentage');
    
    if ($load) {
        // Parse CPU load percentage
        $lines = explode("\n", $load);
        $cpuLoad = trim($lines[1]); 
        
        return $cpuLoad ? "CPU Load: " . $cpuLoad . "%" : "Unable to retrieve CPU load.";
    } else {
        return "Unable to retrieve CPU load.";
    }
}



// Function to get memory usage
function getMemoryUsage() {
    $memory = shell_exec('wmic OS get FreePhysicalMemory,TotalVisibleMemorySize /Value');
    if ($memory) {
        $memory_values = preg_split('/\s+/', trim($memory));
        $total_memory_kb = str_replace("TotalVisibleMemorySize=", "", $memory_values[1]);
        $free_memory_kb = str_replace("FreePhysicalMemory=", "", $memory_values[0]);

        $total_memory_mb = $total_memory_kb / 1024;
        $free_memory_mb = $free_memory_kb / 1024;
        $used_memory_mb = $total_memory_mb - $free_memory_mb;

        return "Total: " . round($total_memory_mb, 2) . " MB, Used: " . round($used_memory_mb, 2) . " MB, Free: " . round($free_memory_mb, 2) . " MB";
    } else {
        return "Unable to retrieve memory usage.";
    }
}

// Function to get database statistics
function getDatabaseStats($con) {
    $query = "SELECT table_name AS `Table`, 
                     round(((data_length + index_length) / 1024 / 1024), 2) AS `Size (MB)`,
                     table_rows AS `Records`
              FROM information_schema.tables
              WHERE table_schema = 'project'"; // Change 'project' to your database name

    $result = mysqli_query($con, $query);
    $stats = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $stats[] = $row;
        }
    }
    return $stats;
}
?>
