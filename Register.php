<?php
include('db.php'); // เชื่อมต่อฐานข้อมูล
$message = "";
$show_popup = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์มและป้องกัน SQL Injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_phone = mysqli_real_escape_string($conn, $_POST['user_phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password_confirm = mysqli_real_escape_string($conn, $_POST['password_confirm']);
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $surname = mysqli_real_escape_string($conn, $_POST['Surname']);
    
    // ตรวจสอบว่าข้อมูลถูกต้อง
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "รูปแบบอีเมลไม่ถูกต้อง!";
    } elseif ($password != $password_confirm) {
        $message = "รหัสผ่านไม่ตรงกัน!";
    } elseif (!preg_match("/^[0-9]{10}$/", $user_phone)) {
        $message = "เบอร์โทรศัพท์ต้องมี 10 หลัก!";
    } else {
        // เข้ารหัสรหัสผ่าน
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // ตรวจสอบว่าชื่อผู้ใช้และอีเมลมีอยู่ในระบบแล้วหรือไม่
        $check_user_query = "SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $check_user_query);
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $existing_user = mysqli_fetch_assoc($result);
            if ($existing_user['username'] === $username) {
                $message = "ชื่อผู้ใช้นี้มีอยู่แล้ว!";
            } elseif ($existing_user['email'] === $email) {
                $message = "อีเมล์นี้มีอยู่แล้ว!";
            }
        } else {
            // เพิ่มผู้ใช้ลงในฐานข้อมูล
            $insert_user_query = "INSERT INTO users (username, email, user_name, user_surname, user_phone, password) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insert_user_query);
            mysqli_stmt_bind_param($stmt, "ssssss", $username, $email, $name, $surname, $user_phone, $hashed_password);
            
            if (mysqli_stmt_execute($stmt)) {
                $message = "สร้างบัญชีสำเร็จแล้ว!";
                $show_popup = true; // ตั้งค่าให้แสดง Popup
            } else {
                $message = "เกิดข้อผิดพลาดในการสร้างบัญชี: " . mysqli_error($conn);
            }
        }
        mysqli_stmt_close($stmt);
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

  <title>REGISTER</title>
  <link rel="stylesheet" href="styles.css">
</head>
<?php
  require_once("nav.php");
?>
<body>
  <br><br><br><br>
  <div class="container">
    <center>
      <h1>Register</h1>
    </center>
    <p>กรุณากรอกแบบฟอร์มนี้เพื่อสร้างบัญชี</p>
    <hr>
    <form method="POST" action="register.php" onsubmit="return validateForm()">
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="ชื่อบัญชีผู้ใช้งาน" name="username" id="username" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="รหัสผ่าน" name="password" id="password" required>

      <label for="password_confirm"><b>Password Confirm</b></label>
      <input type="password" placeholder="ยืนยันรหัสผ่าน" name="password_confirm" id="password_confirm" required>

      <label for="Name"><b>Name</b></label>
      <input type="text" placeholder="ชื่อ" name="Name" id="Name" required>

      <label for="Surname"><b>Surname</b></label>
      <input type="text" placeholder="นามสกุล" name="Surname" id="Surname" required>

      <label for="email"><b>E-mail</b></label>
      <input type="text" placeholder="อีเมลล์ที่ใช้งานจริง" name="email" id="email" required>

      <label for="phone"><b>Phone</b></label>
      <input type="text" placeholder="เบอร์โทรศัพท์" name="user_phone" id="phone" required>

      <hr>
      
      <input id="terms" type="checkbox" required>
      <label for="terms">ข้าพเจ้ายินยอมข้อกำหนดการให้บริการ และ นโยบายความเป็นส่วนตัว</label>
      
      <hr>
      <button type="submit" class="registerbtn">Register</button>

      <h5><p style="color: red;"><?php echo $message; ?></p></h5>
    </form>

    <?php
    // ตรวจสอบว่าเราต้องแสดง Popup หรือไม่
    if ($show_popup) {
        echo "
        <script>
            alert('สร้างบัญชีสำเร็จแล้ว');
            window.location.href = 'Login.php';
        </script>
        ";
    }
    ?>
    <center>
      <a href="Login.php"><-Back to Login</a>
      <hr>
    </center>
  </div>
  <footer>
    <p>&copy; 2024 ร้านทำผมของเรา. สงวนลิขสิทธิ์.</p>
  </footer>

  <script>
    function validateForm() {
      var checkbox = document.getElementById("terms");
      if (!checkbox.checked) {
        alert("กรุณายืนยันข้อกำหนดการให้บริการและนโยบายความเป็นส่วนตัว");
        return false; // ป้องกันไม่ให้ส่งฟอร์ม
      }
      return true; // อนุญาตให้ส่งฟอร์ม
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</body>
</html>
