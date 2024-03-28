<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../index.php");
    exit();
}
include 'Database.php';
connectToDatabase();
$errors = array();
if (isset($_SESSION['username'])) {
    $name = null;
    $name .= $_SESSION['username'];
} else {
    $name = "guest";
}

$message = htmlspecialchars($_POST['message']);
if ($_FILES['imagetheimage']['error'] == 4) {
    $sql = "
    insert into messages (Message, User)
    values (:message, :name);
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':name', $name);
    $stmt->execute();
} else{
    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES["imagetheimage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imagetheimage"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($targetFile)) {
        // Add 1 to the image name if it already exists
        $counter = 1;
        while (file_exists($targetFile)) {
            $imageName = pathinfo($targetFile, PATHINFO_FILENAME);
            $extension = pathinfo($targetFile, PATHINFO_EXTENSION);
            $imageName = $imageName . "_" . $counter;
            $targetFile = $targetDir . $imageName . "." . $extension;
            $counter++;
        }
    }

    // Check file size
    if ($_FILES["imagetheimage"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($uploadOk == 1 && ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif")) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["imagetheimage"]["tmp_name"], $targetFile)) {
            echo "The file ". basename( $_FILES["imagetheimage"]["name"]). " has been uploaded.";
            $imagename = basename($_FILES['imagetheimage']['name']); // Fix: Extract the file name and extension using basename()
            $sql = "
            insert into messages (Message, User, Image)
            values (:message, :name, :imagename);
            ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':message', $message);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':imagename', $imagename);
            $stmt->execute();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

var_dump($_FILES);
header("Location: ../index.php");