
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Online CSS Quiz | Home</title>

  <?php 
  include "header_links.php"; 
  ?>

  <!-- my css -->
  <link rel="stylesheet" href="./css_user/style.css">
  <style>
    /* /for some reason it doesn't work on external css */
    #frontpage {
      background-color: rgba(0, 0, 0, .8);
      background-image: url("./img/bg.jpg");
      background-blend-mode: multiply;
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
      height: 100vh;
    }

    .activity-container {
      background-color: rgba(0, 0, 0, .8);
      background-image: url("./img/bg-2.jpg");
      background-blend-mode: multiply;
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
      height: 100vh;
      color: var(--clr-white);
      position: relative;
      padding: 30px 0 70px 0;
    }

    .activity-container .activity-carousel {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
  </style>
</head>

<body>
  <?php include "headers.php" ?>
  <!-- main content -->
  <main>
    <div id="frontpage" id="home">
      <div class="font-container">
        <h2>Online <span id="css">CSS</span> Quiz</h2>
        <p class="mb-5">"How far your knowledge can go? why not test it?"</p>
        <a href="#">Start Quiz</a>
      </div>
    </div>

    <!-- lessons -->
    <div class="front-botton">
      <div class="lesson-container">
        <div class="lessons">
          <div class="lesson-content">
            <h2>What is CSS?</h2>
            <p class="text-justify">Computer servicing is the combination of personal computers and technology to create
              a
              system that is capable of solving computer issues. In other words, installing and maintaining hardware and
              software components in a computer network infrastructure. What is computer system servicing in senior high
              school?
              This program trains the students to install, troubleshoot, repair and maintain personal-computer systems
              and
              peripherals. A student is also expected to upgrade hardware and software, mass-assemble or customize
              personal-computer units and may recondition old PC units.</p>
          </div>
          <div class="lesson-img">
            <img src="img/img1.jpg" alt="css">
          </div>
        </div>

        <!-- lesson 2 -->
        <div class="lessons">
          <div class="lesson-img">
            <img src="./img/img2.jpg" alt="css">
          </div>
          <div class="lesson-content">
            <h2>Why Learn CSS?</h2>
            <p class="text-justify">
              computer hardware necessary for troubleshooting a variety of hardware, software, and network system
              problems.
              Computer maintenance is very important for keeping your computer running smoothly. A computer which is
              left
              untreated, can accumulate dust and debris, which may result on slow performance. Additionally, your
              computer
              may get infected with virus or malware if your antivirus is not updated.
            </p>
          </div>
        </div>

        <!-- lesson 3 -->
        <div class="lessons">
          <div class="lesson-content">
            <h2>What are the benefits of learning CSS?</h2>
            <p class="text-justify">The Computer System Servicing course will prepare you on how to deal with problems
              you
              may encounter when servicing Personal Computers.It develops students' skills in diagnosis and
              troubleshooting of computer systems, as well as in the performance of computer operations. The program
              enhances a student's ability in basic computer application programs, MS-DOS/ Windows and Linux
              installation
              and PC software and hardware support.

            </p>
          </div>
          <div class="lesson-img">
            <img src="./img/img3.jpg" alt="css">
          </div>
        </div>
      </div>
    </div>
    <!-- activities -->
    <div class="activity-container">
      <h2 class="text-center">Computer System Servicing Activities</h2>
      <div class="activity-carousel">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="./img/slide1.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5 class="text-warning">COC2: Cable Management</h5>
                <p class="text-primary">Configuring: Patch Panel, Router and Switch Hub</p>
              </div>
            </div>

            <div class="carousel-item">
              <img src="./img/slide2.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5 class="text-warning">COC1: Computer Hardware</h5>
                <p class="text-primary">Cleaning Mother board, Assemble and Disassemble</p>
              </div>
            </div>

            <div class="carousel-item">
              <img src="./img/slide3.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5 class="text-warning">COC1: Computer Hardware</h5>
                <p class="text-primary">Installing Applications</p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </main>
  <?php include "footer.php" ?>?>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- font awesome -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>