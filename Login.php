<?php
include('db.php'); // เชื่อมต่อฐานข้อมูล
session_start(); // เริ่มการทำงาน session

// กำหนดตัวแปรสำหรับแสดงข้อความ
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ดึงข้อมูลจากฟอร์ม
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // ตรวจสอบผู้ใช้ในฐานข้อมูล
    $query = "SELECT * FROM users WHERE username='$username' LIMIT 1"; // ค้นหาผู้ใช้จาก username
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $user['password'])) {
            // รหัสผ่านถูกต้อง
            $_SESSION['user_id'] = $user['id']; // เก็บ ID ผู้ใช้ใน session
            $_SESSION['username'] = $user['username']; // เก็บชื่อผู้ใช้ใน session
            header("Location: Home.php"); // เปลี่ยนเส้นทางไปยังหน้า home.php
            exit();
        } else {
            $message = "รหัสผ่านไม่ถูกต้อง!";
        }
    } else {
        $message = "ไม่พบผู้ใช้ที่มีชื่อบัญชีนี้!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="A simple login form designed using Bootstrap and custom styles for a sleek appearance.">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <title>LOGIN</title>
  <link rel="stylesheet" href="styles.css">
</head>
<?php
      require_once("nav.php");
    ?>
<body>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <center>
            <h1>Login</h1>
        </center>
        <p>กรุณากรอกแบบฟอร์มนี้เพื่อใช้งาน</p>
        <hr>

        <!-- เปลี่ยน action เป็น POST -->
        <form method="POST" action="login.php">
            <label for="Username"><b>Username</b></label>
            <input type="text" placeholder="ชื่อบัญชีผู้ใช้งาน" name="username" id="Username" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="รหัสผ่าน" name="password" id="password" required>

            <button type="submit" class="registerbtn">เข้าสู่ระบบ</button>
        </form>

        <!-- แสดงข้อความการแจ้งเตือน -->
        <p style="color: red;"><?php echo $message; ?></p>

        <center>
            <hr>
            <p>(คุณมีบัญชีแล้วหรือยัง ?) <a href="Register.php"> ( สร้างบัญชี )</a></p>
        </center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</body>

</html>
