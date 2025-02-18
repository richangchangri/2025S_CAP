<?php
require 'db.php';

$stmt = $conn->query("SELECT * FROM facilities");
$facilities = $stmt->fetchAll();

foreach ($facilities as $facility) {
    echo "Name: " . $facility['name'] . " | Type: " . $facility['type'] . " | Capacity: " . $facility['capacity'] . "<br>";
}
?>
