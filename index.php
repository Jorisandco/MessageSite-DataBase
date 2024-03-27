<?php
session_start();
if (isset($_SESSION['username'])) {
    $name = null;
    $name .= $_SESSION['username'];
}
include 'nonpages/connect to database.php';
connectToDatabase();

// rest of your code

$sql = "SELECT Message, User FROM messages";
$result = $conn->query($sql);
$messages = null;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
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
    <script src="script\General.js"></script>
</head>

<body>
    <div class="container">
        <div class="header">
            <a href="loginpage.php">Login</a>
            <a href="signup.php">Sign up</a>
        </div>
        <div class="message">
            <?= $messages ?>
        </div>
        <div class="message-form">
            <form method="post" action="nonpages/submit.php">
                <input type="text" name="message" id="message">
                <input type="submit" value="Send">
            </form>
        </div>
    </div>
</body>
<script>makeCookieUser("<?= $name ?>")</script>

</html>