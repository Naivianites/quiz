<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online CSS Quiz | Home</title>
    <?php include "./header_links.php";?>
    <!-- my css -->
    <link rel="stylesheet" href="./css_user/style.css">
    <link rel="stylesheet" href="./css_user/about.css">
</head>

<body>
    <?php include "headers.php";?>
    <!-- main content -->
    <main class="mt-5">
        <div class="about-hero">
            <div class="title ">
                <div class="text">
                    <h2>Hi, I’m </h2>
                    <ul class="option">
                        <li><span>Marvin</span></li>
                        <li><span>a Student</span></li>
                        <li><span>a Programmer</span></li>
                        <li><span>a Developer</span></li>
                    </ul>
                </div>
                <div class="subtitle mt-4">
                    <p>A 3rd year students taking Bachelor of Science in Information Technology at URS Cainta. I am
                        focusing on the backend side or what we called Server side of the web.
                    </p>
                </div>
                <div class="mt-3" id="container-btn ">
                    <a href="#" class="text-center" id="contact">Contact me</a>
                    <a href="#" download="img/img1.jpg" class="text-center" id="cv">Download CV</a>
                </div>

            </div>
            <div class="picture">
                <img src="img/pic.png" alt="">
            </div>
        </div>
    </main>
    <?php include "footer.php";?>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>