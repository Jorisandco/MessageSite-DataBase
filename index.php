<?php
session_start();
if (isset($_SESSION['username'])) {
    $name = null;
    $name .= $_SESSION['username'];
} else {
    $name = "guest";
}
include 'nonpages/Database.php';
connectToDatabase();

// rest of your code

$sql = "SELECT Message, User, Image FROM messages";
$result = $conn->query($sql);
$messages = null;

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $messages .= "<br>";
        $messages .= "<div class=\"textbox\">";
        $messages .= "<h3 id=\"name\">";
        $messages .= $row["User"];
        $messages .= "</h3>";
        $messages .= "<br>";
        $messages .= "<p id=\"message\">";
        $messages .= $row["Message"];
        $messages .= "</p>";
        if (!empty($row["Image"])) {
            $messages .= "<img src=\"uploads/" . $row["Image"] . "\" alt=\"Image\">";
        }
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
            <a href="nonpages/unset_session.php">logout</a>
            <br>
            <h1>username:
                <?= $name ?>
            </h1>
        </div>
        <div class="message">
            <?= $messages ?>
        </div>
        <div class="message-form">
            <form method="post" action="nonpages/submit.php" enctype="multipart/form-data">
                <textarea type="text" name="message" id="message2" placeholder="Message..."></textarea>
                <input type="file" name="imagetheimage" id="image">
                <input type="submit" id="sendbtn" value="Send">
            </form>
        </div>
    </div>
</body>
<script>makeCookieUser("<?= $name ?>")
</script>

</html>