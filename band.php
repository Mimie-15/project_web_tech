<?php
// ตัวอย่างข้อมูลวง T-pop (ในจริงคุณจะดึงข้อมูลนี้จากฐานข้อมูล)
$bands = [
    ["name" => "BUS", "img" => "img/bus.jpg", "date" => "2024-12-01", "time" => "6:00 PM", "location" => "Bangkok", "details" => "Concert of the year", "views" => 12345],
    ["name" => "PIXXIE", "img" => "img/pixxie.jpg", "date" => "2024-11-30", "time" => "7:00 PM", "location" => "Seoul", "details" => "Worldwide tour", "views" => 20000],
    ["name" => "PROXIE", "img" => "img/proxie.jpg", "date" => "2024-12-05", "time" => "5:30 PM", "location" => "Tokyo", "details" => "Stray Kids live", "views" => 15000],
    ["name" => "4EVE", "img" => "img/4eve.jpg", "date" => "2024-12-07", "time" => "8:00 PM", "location" => "New York", "details" => "Twice's world concert", "views" => 17000],
    ["name" => "DICE", "img" => "img/dice.jpg", "date" => "2024-12-10", "time" => "6:30 PM", "location" => "Los Angeles", "details" => "EXO live performance", "views" => 25000],
    ["name" => "BNK48", "img" => "img/bnk48.jpg", "date" => "2024-12-12", "time" => "7:30 PM", "location" => "Singapore", "details" => "Red Velvet in concert", "views" => 13000]
];
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-Pop Band Concerts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        /* Navbar styling */
        .navbar {
            margin-bottom: 30px;
        }
        .navbar-brand {
            font-size: 24px;
        }

        .band-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            text-align: center;
        }
        .band-item {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            cursor: pointer;
        }
        .band-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .band-item h3 {
            margin: 10px 0;
        }
        .band-details {
            display: none;
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .band-details.active {
            display: block;
        }
    </style>
</head>
<body>

<!-- รวมไฟล์ Navbar -->
<?php require_once("nav.php"); ?>

<!-- Main Content -->
<div class="container">
    <h1 class="text-center mb-4">T-Pop Band Concerts</h1>
    <div class="band-container">
        <?php foreach ($bands as $index => $band): ?>
            <div class="band-item" onclick="showDetails(<?php echo $index; ?>)">
                <img src="<?php echo $band['img']; ?>" alt="<?php echo $band['name']; ?>">
                <h3><?php echo $band['name']; ?></h3>
            </div>
        <?php endforeach; ?>
    </div>

    <?php foreach ($bands as $index => $band): ?>
        <div class="band-details" id="band-details-<?php echo $index; ?>">
            <h3><?php echo $band['name']; ?> - Concert Details</h3>
            <p><strong>Date:</strong> <?php echo $band['date']; ?></p>
            <p><strong>Time:</strong> <?php echo $band['time']; ?></p>
            <p><strong>Location:</strong> <?php echo $band['location']; ?></p>
            <p><strong>Details:</strong> <?php echo $band['details']; ?></p>
            <p><strong>Views:</strong> <?php echo $band['views']; ?></p>
        </div>
    <?php endforeach; ?>
</div>

<script>
    function showDetails(index) {
        var allDetails = document.querySelectorAll('.band-details');
        allDetails.forEach(function(detail) {
            detail.classList.remove('active');
        });
        var bandDetails = document.getElementById('band-details-' + index);
        bandDetails.classList.add('active');
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
