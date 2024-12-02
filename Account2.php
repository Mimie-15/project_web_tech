<?php
session_start();
include('db.php'); // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่าผู้ใช้ล็อกอินอยู่หรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // ถ้าไม่ล็อกอิน ให้ redirect ไปยังหน้า login
    exit();
}

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$username = $_SESSION['username']; // เปลี่ยนจาก user_id เป็น username
$query = "SELECT user_id,username, email, user_phone FROM users WHERE username='$username'";
$result = mysqli_query($conn, $query);

// ตรวจสอบว่าพบข้อมูลหรือไม่
if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "ไม่พบข้อมูลผู้ใช้";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ACCOUNT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            min-height: 500px;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #d3d3d3;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }
        .small-img {
            width: 180px;
            display: block;
            margin: 0 auto 20px;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
            color: #495057;
            border-spacing: 0;
        }
        td {
            padding: 15px;
            vertical-align: middle;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            background-color: #ffffff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
            color: #212529;
            display: block;
            margin-bottom: 5px;
        }
        .logout-btn {
            display: block;
            width: 100%;
            margin-top: 20px;
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            background-color: #b8a995;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none; /* ไม่ให้มีขีดเส้นใต้ */
        }
        .logout-btn:hover {
            background-color: #c4b8a7;
        }
    </style>
</head>

<body>
<?php require_once("nav.php"); ?>
<br><br><br><br><br>
    <div class="container">
        <h2>My Account</h2>
        <center><img src="img/Account.png" alt="Account Image" class="small-img"></center>
        <table>
        <tr>
                <td>
                    <label>My Booking :<?php echo htmlspecialchars($user['user_id']); ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Username: <?php echo htmlspecialchars($user['username']); ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>E-mail: <?php echo htmlspecialchars($user['email']); ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Tel: <?php echo htmlspecialchars($user['user_phone']); ?></label>
                </td>
            </tr>
        </table>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>

</html>
