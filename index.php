<?php
session_start();
$name = null;
$name .= "<br> welcome ";
$name .= $_SESSION['username'];

include 'nonpages/connect to database.php';
connectToDatabase();

// rest of your code

$sql = "SELECT Message, User FROM messages";
$result = $conn->query($sql);
$messages = null;

if($result-> num_rows > 0){
    while($row = $result->fetch_assoc()){
        $messages .= "<br>";
        $messages .= "<div class=\"textbox\">";
        $messages .= "<h3 id=\"name\">";
        $messages .= $row["User"];
        $messages .= "</h3>";
        $messages .= "<br>";
        $messages .= "<p id=\"message\">";
        $messages .= $row["Message"];
        $messages .= "</p>";
        $messages .= "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>message page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <a href="loginpage.php">Login</a>
    <a href="signup.php">Sign up</a>
    <?= $name ?>
    <?= $messages?>
    <form method="post" action="nonpages/submit.php">
        <input type="text" name="message" id="message">
        <input type="submit" value="Send">
    </form>
</body>
</html>