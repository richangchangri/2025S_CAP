<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        echo "Login Successful！";
    } else {
        echo "Incorrect email or password！";
    }
}
?>
<form method="POST">
    <input type="email" name="email" placeholder="E-mail" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit"></button>
</form>
