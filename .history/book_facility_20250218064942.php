<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Please log in first!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $facility_id = $_POST['facility_id'];
    $booking_date = $_POST['booking_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $purpose = $_POST['purpose'];
    $confirmation_code = uniqid();

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, facility_id, booking_date, start_time, end_time, purpose, confirmation_code) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$_SESSION['user_id'], $facility_id, $booking_date, $start_time, $end_time, $purpose, $confirmation_code])) {
        echo "预订成功！确认码: " . $confirmation_code;
    } else {
        echo "预订失败！";
    }
}
?>
<form method="POST">
    <input type="number" name="facility_id" placeholder="设施ID" required><br>
    <input type="date" name="booking_date" required><br>
    <input type="time" name="start_time" required><br>
    <input type="time" name="end_time" required><br>
    <textarea name="purpose" placeholder="用途" required></textarea><br>
    <button type="submit">提交预订</button>
</form>
