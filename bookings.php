<?php
// เชื่อมต่อกับฐานข้อมูล
$host = 'localhost';
$dbname = 'project11';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // ตั้งค่าการดักจับข้อผิดพลาด
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// สร้างคำสั่ง SQL
$sql = "SELECT id, booking_date, service_type,additional_details,booking_time,created_at FROM bookings";
$stmt = $conn->prepare($sql);
$stmt->execute();

// ดึงข้อมูลและแสดงผล
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จองคิว</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        
        
    </script>
</head>
<body>
    <?php require_once("nav.php");?>
    
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <main>
                    <div id="calendar"></div>
                </main>
            </div>
            <div class="col-md-8"><br><br>
                <center>
                <h3>รายการจอง</h3><br>
                </center>
                <table class="table table-striped">

        <tr>
            <th>ID</th>
            <th>วันที่จอง</th>
            <th>ประเภทบริการ</th>
            <th>NOTE</th>
            <th>เวลาในการจอง</th>
            <th>เวลา ณ ตอนจอง</th>
        </tr>
        <?php
        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if ($stmt->rowCount() > 0) {
            // ดึงข้อมูลแต่ละแถวออกมา
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["booking_date"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["service_type"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["additional_details"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["booking_time"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["created_at"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>ไม่มีข้อมูล</td></tr>";
        }
        ?>
    
                    <tbody id="bookingTableBody">
                        <!-- Data will be loaded here via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

        
</body>
</html>
