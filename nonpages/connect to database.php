<?php
function connectToDatabase(){
    // connect to the database
$servername = "localhost";
$password = "";
$username = "root";
$dbname = "newdatabase";

global $conn;
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn -> connect_error){
    die("Connection failed: " . $conn -> connect_error);
}

echo "Connected successfully to message database";}
