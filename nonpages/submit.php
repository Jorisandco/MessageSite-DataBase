<?php
session_start();
include 'connect to database.php';
connectToDatabase();
$errors = array();
if(isset($_SESSION['username'])){
    $name = null;
    $name .= $_SESSION['username'];
}
$name = "guest";
$message = htmlspecialchars($_POST['message']);
$sql = "
insert into messages (Message, User)
values ('$message', '$name');
";

if($conn -> query($sql) === TRUE){
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn -> $error;
}

header("Location: ../index.php");