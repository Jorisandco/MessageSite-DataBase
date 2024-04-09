<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {

    // connect to the database
    include 'nonpages/Database.php';
    connectToDatabase();
    // get data login
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $sql = "SELECT * FROM userdata WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->rowCount() > 0) {

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if ($row['password'] == $password && $row['username'] == $_POST['username']) {
                echo "Welcome " . $row['username'];
                echo "Login successful";
            }
            $_SESSION['username'] = $username;
            header("Location: ../index.php");
        }
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
    <div class="logincontainer">
        <form id="loginfrom" method="post" action="loginpage.php">
        <h1 class="stittle">Login</h1>
            <input type="text" name="username" id="username" placeholder="username">
            <input type="password" name="password" id="password" placeholder="password">
            <input type="submit" id="sendbtn" value="Login">
        </form>
    </div>
</body>

</html>