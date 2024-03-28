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
        // Check if the username is already taken
        $checkUsernameQuery = "SELECT * FROM UserData WHERE username = '$username'";
        $checkUsernameResult = $conn->query($checkUsernameQuery);
        if ($checkUsernameResult->rowCount() > 0) {
            echo "Username already taken";
            return;
        }

        // Insert the new user into the database
        $insertQuery = "INSERT INTO UserData (username, password, admin) VALUES ('$username', '$password', 0)";
        $insertResult = $conn->exec($insertQuery);
        if ($insertResult) {
            $_SESSION['username'] = $username;
            header("Location: ../index.php");
        } else {
            echo "Signup failed";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="logincontainer">
        <form id="loginfrom" method="post" action="signup.php">
            <h1 class="stittle">signup</h1>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <label for="password2">Confirm Password</label>
            <input type="password" name="password2" id="password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
<script src="js/script.js"></script>

</html>