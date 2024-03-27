<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    // connect to the database
    include 'nonpages/Database.php';
    session_start();
    connectToDatabase();
    // get data login
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);

    if ($password != $password2) {
        echo "Passwords do not match";
        return;
    } else {
        $sql = "INSERT INTO UserData (username, password, admin) VALUES ('$username', '$password', 0)";
        $_SESSION['username'] = $username;
        $row = $conn->exec($sql);
        header("Location: ../index.php");

        echo "signup failed";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="signup.php">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <label for="password2">Confirm Password</label>
        <input type="password" name="password2" id="password" required>
        <input type="submit" value="Login">
    </form>
</body>
<script src="js/script.js"></script>
</html>