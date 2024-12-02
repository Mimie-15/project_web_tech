<?php 
session_start(); // เริ่มเซสชัน

# Database connection file
include 'db.php';

// เช็คการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

# Fetching images for Hair.Style
$sqlHair = "SELECT id, img_name FROM images WHERE type='hair' ORDER BY id DESC"; 
$stmtHair = $conn->prepare($sqlHair);
$stmtHair->execute();
$resultHair = $stmtHair->get_result();
$imagesHair = $resultHair->fetch_all(MYSQLI_ASSOC);

// Fetching images for Personal.Color
$sqlColor = "SELECT id, img_name FROM images WHERE type='color' ORDER BY id DESC"; 
$stmtColor = $conn->prepare($sqlColor);
$stmtColor->execute();
$resultColor = $stmtColor->get_result();
$imagesColor = $resultColor->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Home</title>
    <style>
        body {
            background-color: #DCDCDC;
            height: 100vh;
        }
        .gallery {
            margin-bottom: 20px;
        }
        .image-container {
            display: flex; /* ใช้ flexbox สำหรับแนวนอน */
            flex-wrap: wrap; /* อนุญาตให้มีการ wrap */
            overflow-x: auto; /* เพิ่มการเลื่อนแนวนอน */
            white-space: nowrap; /* ป้องกันการแสดงผลเป็นหลายบรรทัด */
        }
        .image-item {
            display: flex; /* ทำให้เป็น flexbox */
            align-items: center; /* จัดแนวกลางในแนวตั้ง */
            margin: 5px; /* กำหนดมาร์จินให้กับแต่ละภาพ */
        }
        .image-item img {
            width: 150px; /* กำหนดความกว้างของภาพ */
            height: 200px; /* รักษาสัดส่วนของภาพ */
            object-fit: cover; /* ทำให้ภาพเต็มพื้นที่ที่กำหนดโดยไม่บิดเบือน */
        }
        .image-item a {
            margin-left: 5px; /* เพิ่มระยะห่างระหว่างภาพและปุ่ม Delete */
        }
        .gallery-title {
            display: inline-block; /* ทำให้ข้อความอยู่ในบรรทัดเดียว */
            margin-right: 150px; /* ระยะห่างทางขวา */
            font-size: 24px; /* ขนาดฟอนต์ */
            font-weight: bold; /* ทำให้ฟอนต์หนา */
        }


        .gallery {
    padding: 20px;
    text-align: center; /* จัดข้อความให้ตรงกลาง */
}

.gallery-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center; /* จัดชื่อ T-POP BAND ให้ตรงกลาง */
}

.image-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* แบ่งเป็น 3 คอลัมน์ */
    gap: 20px;
    justify-items: center; /* จัดรูปภาพให้ตรงกลาง */
    margin-top: 20px;
}

.image-item {
    text-align: center;
    background-color: #fff;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.image-item img {
    width: 100%; /* กำหนดความกว้างของรูปให้เต็ม */
    height: auto; /* ปรับความสูงตามอัตราส่วน */
    max-width: 200px; /* จำกัดขนาดของรูปภาพ */
    margin-bottom: 10px;
}

.image-item a {
    display: inline-block;
    margin-top: 10px;
    color: red;
    text-decoration: none;
}

.image-item a:hover {
    text-decoration: underline;
}

    </style>
</head>
<?php require_once("nav.php"); ?>
<body>
    <br><br><br><br>
    <div class="image-container">
        <a class="previous" onclick="moveSlides(-1)" aria-label="Previous Slide">
            <i class="fa fa-chevron-circle-left"></i>
        </a>
        <a class="next" onclick="moveSlides(1)" aria-label="Next Slide">
            <i class="fa fa-chevron-circle-right"></i>
        </a>
    </div>
    <br>

    <script>
        let slideIndex = 0;
        let autoSlideInterval;

        function displaySlide(n) {
            let i;
            let slides = document.getElementsByClassName("slide");
            let dots = document.getElementsByClassName("footerdot");

            if (n >= slides.length) {
                slideIndex = 0;
            } else if (n < 0) {
                slideIndex = slides.length - 1;
            }

            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex].style.display = "block";
            dots[slideIndex].className += " active";
        }

        function moveSlides(n) {
            slideIndex += n;
            displaySlide(slideIndex);
        }

        function activeSlide(n) {
            slideIndex = n - 1;
            displaySlide(slideIndex);
        }

        function startAutoSlide() {
            autoSlideInterval = setInterval(function () {
                slideIndex++;
                displaySlide(slideIndex);
            }, 1500); // Change slide every 1.5 seconds
        }

        function stopAutoSlide() {
            clearInterval(autoSlideInterval);
        }

        // Start the auto-slide when the page loads
        window.onload = function () {
            displaySlide(slideIndex); // Show the first slide
            startAutoSlide();
        };
    </script>

    <!-- ฟอร์มสำหรับ Upload_Hair.Style -->
    <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') { ?>
        <form method="post" action="upload.php?type=hair" enctype="multipart/form-data">
            <?php  
            if (isset($_GET['error'])) {
                echo "<p class='error'>" . htmlspecialchars($_GET['error']) . "</p>";
            }
            ?>
            <input type="file" name="images[]" multiple required>
            <button type="submit" name="upload" class="btn btn-primary">Upload Hair Style</button>
        </form>
    <?php } ?>

    <!-- แสดงภาพ Hair.Style -->
     
    <div class="gallery">
    <div class="gallery-title">T-POP BAND</div>
    <div class="image-container">
        <?php foreach ($imagesHair as $image) { ?>
            <div class="image-item">
                <img src="uploads/Hair.Style/<?=$image['img_name']?>" alt="Hair Style Image">
                <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') { ?>
                    <a href="deleteImage.php?id=<?=$image['id']?>" onclick="return confirm('Are you sure you want to delete this image?');">Delete</a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>



    <!-- ตารางเวลาคอนเสิร์ต -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Concert Schedule</h2>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Band</th>
                <th scope="col">Location</th>
                <th scope="col">Details</th>
                <th scope="col">Interested People</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2024-12-01</td>
                <td>6:00 PM</td>
                <td>BUS</td>
                <td>Bangkok</td>
                <td>Concert of the year</td>
                <td>12,345+</td>
            </tr>
            <tr>
                <td>2024-11-30</td>
                <td>7:00 PM</td>
                <td>PIXXIE</td>
                <td>Seoul</td>
                <td>Worldwide tour</td>
                <td>20,000+</td>
            </tr>
            <tr>
                <td>2024-12-05</td>
                <td>5:30 PM</td>
                <td>PROXIE</td>
                <td>Tokyo</td>
                <td>World Tour: USA</td>
                <td>15,000+</td>
            </tr>
            <tr>
                <td>2024-12-07</td>
                <td>8:00 PM</td>
                <td>4EVE</td>
                <td>New York</td>
                <td>Twice's world concert</td>
                <td>17,000+</td>
            </tr>
            <tr>
                <td>2024-12-10</td>
                <td>6:30 PM</td>
                <td>DICE</td>
                <td>Los Angeles</td>
                <td>EXO live performance</td>
                <td>25,000+</td>
            </tr>
            <tr>
                <td>2024-12-12</td>
                <td>7:30 PM</td>
                <td>BNK48</td>
                <td>Singapore</td>
                <td>Red Velvet in concert</td>
                <td>13,000+</td>
            </tr>
        </tbody>
    </table>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
