<?php


include 'db.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบการส่งฟอร์ม
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_date = $_POST['booking_date'];
    $service_type = $_POST['service_type'];
    $additional_details = $_POST['additional_details'];
    $booking_time = $_POST['booking_time'];

    // บันทึกข้อมูลการจองลงฐานข้อมูล
    $sql = "INSERT INTO bookings (booking_date, service_type, additional_details, booking_time) VALUES ('$booking_date', '$service_type', '$additional_details', '$booking_time')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('การจองสำเร็จ!'); window.location.href='Home.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAIR</title>
    <link rel="stylesheet" href="Service_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link 
        href="https://fonts.googleapis.com/css2?family=Fahkwang:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" 
        rel="stylesheet">
    <head>
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="date"], input[type="time"], textarea, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .gold-button {
    width: 100%;
    padding: 10px;
    background-color: gold; /* สีทอง */
    color: black; /* สีตัวอักษร */
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}


.gold-button:hover {
    background-color: #ffd700; /* สีทองเข้มเมื่อชี้เมาส์ */
}
body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .logo {
            width: 220px; /* ปรับขนาดตามต้องการ */
            height: auto; /* รักษาสัดส่วน */
        }



        
    </style>
    <?php
require_once("nav.php");
?>
</head>
<body>
    
    <div class="container">
    <center>
    <p style="color: #d19a3b; font-size: 45px;">T-POP BAND</p>
    </center>
        <center>
        <img src="img/Nap logo.png" alt="โลโก้ของเรา" class="logo">
        </center>
        <form action="" method="post">
        <div class="form-group">
                            <label for="booking_date">เลือกวัน:</label>
            <select id="booking_date" name="booking_date" required>
                                <option value="2024-11-30">2024-11-30</option>
                                <option value="2024-12-01">2024-12-01</option>
                                <option value="2024-12-05">2024-12-05</option>
                                <option value="2024-12-07">2024-12-07</option>
                                <option value="2024-12-10">2024-12-10</option>
                                <option value="2024-12-12">2024-12-12</option>
                                </select>
                                </div>

            <div class="form-group">
                            <label for="service_type">เลือกวง:</label>
            <select id="service_type" name="service_type" required>
                                <option value="BUS">BUS</option>
                                <option value="PIXXIE">PIXXIE</option>
                                <option value="PROXIE">PROXIE</option>
                                <option value="4EVE">4EVE</option>
                                <option value="DICE">DICE</option>
                                <option value="BNK48">BNK48</option>
                                
            </select>
                        </div>

           

                        <div class="form-group">
                        <label for="additional_details">รายละเอียดเพิ่มเติม:</label>
            <textarea id="additional_details" name="additional_details" rows="4" placeholder="เช่น นัดสถานที่ที่เจอ"></textarea>
            </div>
            <div class="form-group">
                            <label for="booking_time">กรุณาเลือกเวลาที่จะเข้าใช้บริการ:</label>
                            <select id="booking_time" name="booking_time" required>
                                <option value="5:30 PM">5:30 PM</option>
                                <option value="6:00 PM">6:00 PM</option>
                                <option value="6:30 PM">6:30 PM</option>
                                <option value="7:00 PM">7:00 PM</option>
                                <option value="7:30 PM">7:30 PM</option>
                                <option value="8:00 PM">8:00 PM</option>
                            </select>
                        </div>

                        <button type="submit" style="background-color: #d19a3b;">จอง</button>
        </form>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
</body>
</html>


