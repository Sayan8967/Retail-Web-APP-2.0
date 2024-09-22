<?php

$target_dir = "uploads/"; // Directory
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0755, true); // Create directory if it doesn't exist
}

$target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if file is a real file or a fake file
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Limit file size 
if ($_FILES["fileUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats 
$allowed_extensions = array("jpg", "png", "jpeg", "gif");
if (!in_array($fileType, $allowed_extensions)) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// If everything is okay, try to upload the file
} else {
    if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileUpload"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
