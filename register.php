<?php
include 'config.php';
session_start();

if(isset($_POST['register'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if($check->num_rows > 0){
        $_SESSION['email'] = $email;
        header("Location: ViewStudent.php");
exit();
    } else {
        echo "<script>alert('Wrong Email or Password');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Student Management System</h1>
    <nav>
        <a href="index.html">Home</a>
        <a href="AddStudent.php">Add student</a>
        <a href="ViewStudent.php">Student</a>
        <a href="login.php">Login</a>
    </nav>
</header>

<div class="container">
    <h2>Student Login</h2>
    <form method="POST" action="login.php">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login" class="btn btn-add">Login</button>
    </form>
<p> Don't have an account?<a href="registr.php">Rigister</p>
</div>

</body>
</html>
