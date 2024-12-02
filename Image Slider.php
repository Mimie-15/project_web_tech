<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="A simple image slider designed using jQuery and Bootstrap with custom styles for a sleek appearance.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Image Slider</title>
<head>

</head>
<body>
  <br>
  <br>
  <br>
  <br>


<div class="image-container">
        <div class="slide active">
            <div class="slideNumber">1</div>
            <img src="https://www.geeksforgeeks.org/wp-content/uploads/html-768x256.png" alt="HTML">
        </div>
        <div class="slide">
            <div class="slideNumber">2</div>
            <img src="https://www.geeksforgeeks.org/wp-content/uploads/CSS-768x256.png" alt="CSS">
        </div>
        <div class="slide">
            <div class="slideNumber">3</div>
            <img src="https://www.geeksforgeeks.org/wp-content/uploads/jquery-banner.png" alt="jQuery">
        </div>

        <a class="previous" onclick="moveSlides(-1)" aria-label="Previous Slide">
            <i class="fa fa-chevron-circle-left"></i>
        </a>
        <a class="next" onclick="moveSlides(1)" aria-label="Next Slide">
            <i class="fa fa-chevron-circle-right"></i>
        </a>
    </div>
    <br>

    <div style="text-align:center">
        <span class="footerdot" onclick="activeSlide(1)"></span>
        <span class="footerdot" onclick="activeSlide(2)"></span>
        <span class="footerdot" onclick="activeSlide(3)"></span>
    </div>

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
            }, 1500); // Change slide every 3 seconds
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
  <div class ="container">
    <div class="row">
            Hair 
            <?php
            echo "<br>";
            ?>
            Style
      <div class="col-11  ">
        <tr>
          <td>
            <img src="https://www.geeksforgeeks.org/wp-content/uploads/jquery-banner.png" alt="jQuery" class="square"> 
          </td>
          <td>
            <img src="https://www.geeksforgeeks.org/wp-content/uploads/jquery-banner.png" alt="jQuery" class="square"> 
          </td>
          <td>
            <img src="https://www.geeksforgeeks.org/wp-content/uploads/jquery-banner.png" alt="jQuery" class="square"> 
          </td>
          <td>
            <img src="https://www.geeksforgeeks.org/wp-content/uploads/jquery-banner.png" alt="jQuery" class="square"> 
          </td>
          <td>
            <img src="https://www.geeksforgeeks.org/wp-content/uploads/jquery-banner.png" alt="jQuery" class="square"> 
          </td>
          <td>
            <img src="https://www.geeksforgeeks.org/wp-content/uploads/jquery-banner.png" alt="jQuery" class="square"> 
          </td>
        </tr>
      </div>
    </div>
  </div>
</body>
</html>
