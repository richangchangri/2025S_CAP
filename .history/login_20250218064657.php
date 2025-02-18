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
        echo "登录成功！";
    } else {
        echo "邮箱或密码错误！";
    }
}
?>
<form method="POST">
    <input type="email" name="email" placeholder="邮箱" required><br>
    <input type="password" name="password" placeholder="密码" required><br>
    <button type="submit">登录</button>
</form>
