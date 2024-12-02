<?php
session_start();
include 'db.php'; // เชื่อมต่อฐานข้อมูล

if (isset($_POST['upload'])) {
    $type = $_GET['type']; // รับประเภทที่ส่งมาจากฟอร์ม
    $uploadDir = 'uploads/' . ($type === 'hair' ? 'Hair.Style/' : 'Personal.Color/'); // กำหนดโฟลเดอร์ตามประเภท

    // สร้างโฟลเดอร์หากยังไม่มี
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        // ตรวจสอบข้อผิดพลาดการอัปโหลด
        if ($_FILES['images']['error'][$key] !== UPLOAD_ERR_OK) {
            header("Location: Home.php?error=File upload error: " . $_FILES['images']['error'][$key]);
            exit();
        }

        $fileType = $_FILES['images']['type'][$key];
        $fileExtension = strtolower(pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION));

        // ตรวจสอบประเภทไฟล์
        if (!in_array($fileType, ['image/jpeg', 'image/png']) && !in_array($fileExtension, ['jpg', 'jpeg', 'png'])) {
            header("Location: Home.php?error=Only JPG and PNG files are allowed.");
            exit();
        }

        $img_name = basename($_FILES['images']['name'][$key]);
        $targetFilePath = $uploadDir . $img_name;

        // ฟังก์ชันสำหรับสร้างชื่อไฟล์ใหม่ถ้ามีไฟล์ซ้ำ
        $targetFilePath = getUniqueFileName($targetFilePath);

        // อัปโหลดไฟล์
        if (move_uploaded_file($tmp_name, $targetFilePath)) {
            // บันทึกข้อมูลในฐานข้อมูล
            $sql = "INSERT INTO images (img_name, type) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $img_name, $type);
            $stmt->execute();
        } else {
            // ถ้าไม่สามารถอัปโหลดได้
            header("Location: Home.php?error=Upload failed.");
            exit();
        }
    }

    // กลับไปที่หน้าหลักพร้อมข้อความสำเร็จ
    header("Location: Home.php?message=Images uploaded successfully.");
    exit();
}

// ฟังก์ชันสำหรับสร้างชื่อไฟล์ใหม่
function getUniqueFileName($filePath) {
    $fileInfo = pathinfo($filePath);
    $i = 1;
    
    // ถ้าชื่อไฟล์มีอยู่แล้ว ให้เพิ่มหมายเลขที่ด้านหลัง
    while (file_exists($filePath)) {
        $filePath = $fileInfo['dirname'] . '/' . $fileInfo['filename'] . "_{$i}." . $fileInfo['extension'];
        $i++;
    }
    return $filePath;
}
?>
