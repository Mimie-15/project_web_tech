<?php
// เริ่มต้นเซสชันหากยังไม่มี
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sidebar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link 
        href="https://fonts.googleapis.com/css2?family=Fahkwang:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" 
        rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
    />
    <link rel="stylesheet" href="nav-styles.css" />
</head>
<body>
    <nav>
        <a class="navbar-brand" href="Home.php">
            <img src="img/Nap logo.png" alt="Logo" style="height: 80px;">
        </a>
        <ul class="menu">
            <li><a class="navbar-brand" href="Home.php">HOME</a></li>
            <li>
                <a>SERVICE</a>
                <ul class="submenu">
                <li><a class="navbar-brand" href="band.php">BAND</a></li>
                <li><a class="navbar-brand" href="Hair.Service.php">BOOKING</a></li>
                <li><a class="navbar-brand" href="bookings.php">CHECK</a></li>
                    
                    
                </ul>
            </li>
           
            <li><a class="navbar-brand" href="Account2.php">ACCOUNT</a></li>
        </ul>
        <ul class="menu">
            <?php if (!isset($_SESSION['username'])): // ตรวจสอบว่าผู้ใช้ยังไม่ล็อกอิน ?>
                <li><a class="navbar-brand" href="Login.php">LOGIN</a></li>
                <li><a class="nav-link" href="Register.php">REGISTER</a></li>
            <?php else: // ถ้าผู้ใช้ล็อกอินแล้ว ?>
                <li><a class="nav-link" href="logout.php">LOGOUT</a></li> <!-- เพิ่มปุ่ม LOGOUT -->
            <?php endif; ?>
        </ul>
    </nav>
</body>
</html>
