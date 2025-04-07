<?php
$host = 'localhost';
$dbname = 'facility_booking';
$username = 'root';// Use environment variables in production
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", 
    $username,
    $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("connect fall: " . $e->getMessage());
}
?>
