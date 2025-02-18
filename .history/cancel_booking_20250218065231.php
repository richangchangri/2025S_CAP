<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Please log in first!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['booking_id'];

    $stmt = $conn->prepare("UPDATE bookings SET status='cancelled' WHERE id=? AND user_id=?");
    if ($stmt->execute([$booking_id, $_SESSION['user_id']])) {
        echo "The booking has been cancelled!";
    } else {
        echo "Failed cancellation!";
    }
}
?>
<form method="POST">
    <input type="number" name="booking_id" placeholder="Cancellation ID" required><br>
    <button type="submit">Cancellation</button>
</form>
