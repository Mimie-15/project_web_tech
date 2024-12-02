<?php
include 'db.php'; // รวมไฟล์ฐานข้อมูล

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // รับค่า ID ของรูปภาพที่ต้องการลบ

    // ค้นหารูปภาพที่ต้องการลบ
    $sql = "SELECT img_name FROM images WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imgName = $row['img_name'];

        // ลบไฟล์จากโฟลเดอร์ uploads
        if (file_exists("uploads/$imgName")) {
            unlink("uploads/$imgName"); // ลบไฟล์จริง
        }

        // ลบข้อมูลจากฐานข้อมูล
        $sql = "DELETE FROM images WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // รีไดเร็กต์กลับไปยังหน้าแรกพร้อมกับข้อความสำเร็จ
        header("Location: Home.php?message=Image deleted successfully");
        exit();
    } else {
        echo "Image not found.";
    }
} else {
    echo "No image ID specified.";
}
?>
