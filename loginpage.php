<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {

    // connect to the database
    include 'nonpages/Database.php';
    connectToDatabase();
    // get data login
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $sql = "SELECT * FROM UserData WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->rowCount() > 0) {
        echo "Login successful";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "Welcome " . $row['username'];
        }
        $_SESSION['username'] = $username;
        header("Location: ../index.php");
    } else {
        echo "Login failed";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form method="post" action="loginpage.php">
        <input type="text" name="username" id="username">
        <input type="password" name="password" id="password">
        <input type="submit" value="Login">
    </form>
</body>

</html>