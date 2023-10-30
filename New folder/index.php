<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: user.php");
    }
}

// Registration form
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the form data here

    // Save the new user's details to a file or a database
    // Implement file writing here
}

// Login form
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Authenticate the user's credentials here
    // Implement file reading here

    // For the sake of example, assuming the user is authenticated and has the role 'admin'
    $_SESSION['role'] = 'admin';
    header("Location: admin.php");
}

?>

<!-- Registration Form -->
<form action="index.php" method="post">
    Username: <input type="text" name="username"><br>
    Email: <input type="email" name="email"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" name="register" value="Register">
</form>

<!-- Login Form -->
<form action="index.php" method="post">
    Email: <input type="email" name="email"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" name="login" value="Login">
</form>

