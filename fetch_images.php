<?php
$conn = new mysqli("localhost", "username", "password", "database_name");

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT image_url FROM images ORDER BY uploaded_at DESC");
$images = [];

while ($row = $result->fetch_assoc()) {
    $images[] = $row;
}

$conn->close();
echo json_encode($images);
?>
