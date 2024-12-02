<?php 
session_start(); // เริ่มเซสชัน
include 'db.php'; // เชื่อมต่อฐานข้อมูล

// Fetching images for Packages
$sqlPackages = "SELECT id, img_name FROM images WHERE type='Packages' ORDER BY id DESC"; 
$stmtPackages = $conn->prepare($sqlPackages);
$stmtPackages->execute();
$resultPackages = $stmtPackages->get_result();
$imagesPackages = $resultPackages->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Packages.css">
</head>
<?php
    require_once("nav.php"); // นำเข้าเมนูนำทาง
?>
<body>
<center>
        <img src="img/268965530_4874799729209385_2137536136467310792_n.jpg" alt="โลโก้ของเรา" class="logo">
        </center>
        <br>
    <br>
    <br>
    <br>
    <br>
    <footer>
        <p>&copy; 2024 ร้านทำผมของเรา. สงวนลิขสิทธิ์.</p>
    </footer>
</body>
</html>
