<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$name, $email, $password])) {
        echo "Successful registration!";
    } else {
        echo "注册失败！";
    }
}
?>
<form method="POST">
    <input type="text" name="name" placeholder="姓名" required><br>
    <input type="email" name="email" placeholder="邮箱" required><br>
    <input type="password" name="password" placeholder="密码" required><br>
    <button type="submit">注册</button>
</form>
