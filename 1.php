<?php
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];



    if ($username == 'admin' && $password == 'password') {
        $_SESSION['username'] = $username;
        header('Location: index.php');
    } else {
        $error = 'Invalid username or password';
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
</head>

<body>
    <?php if (isset($_SESSION['username'])) { ?>
    <h1>Logged in as <?php echo $_SESSION['username']; ?></h1>
    <a href="login.php?logout=true">Logout</a>
    <?php } else { ?>
    <?php if (isset($error)) {
            echo $error;
        } ?>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" name="login" value="Login">
    </form>
    <?php } ?>
</body>

</html>