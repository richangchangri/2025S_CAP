<?php
require 'db.php';

$stmt = $conn->query("SELECT * FROM facilities");
$facilities = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Facilities</title>
</head>
<body>
    <h2>Available Facilities</h2>
    <?php
    foreach ($facilities as $facility) {
        echo "Name: " . $facility['name'] . " | Type: " . $facility['type'] . " | Capacity: " . $facility['capacity'] . "<br>";
    }
    ?>
</body>
</html>
