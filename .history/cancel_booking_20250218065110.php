<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("请先登录！");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['booking_id'];

    $stmt = $conn->prepare("UPDATE bookings SET status='cancelled' WHERE id=? AND user_id=?");
    if ($stmt->execute([$booking_id, $_SESSION['user_id']])) {
        echo "预订已取消！";
    } else {
        echo "取消失败！";
    }
}
?>
<form method="POST">
    <input type="number" name="booking_id" placeholder="预订ID" required><br>
    <button type="submit">取消预订</button>
</form>
