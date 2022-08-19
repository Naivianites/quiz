<?php require "controller/authController.php";

if (!isset($_SESSION['id'])) {
    header("location:login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online CSS Quiz | Login</title>

    <?php include "header_links.php"; ?>


    <link rel="stylesheet" href="./css/style.css?v=<?= time(); ?>" />
</head>

<body>
    <?php include "headers.php"; ?>
    <div class="wrapper d-flex align-center flex-column">
        <?php if (isset($_SESSION['login_status'])) : ?>
            <div class="alert <?= $_SESSION['alert-class'] ?>">
                <?php
                echo $_SESSION['login_status'];
                unset($_SESSION['login_status']);
                unset($_SESSION['alert-class']);
                ?>
            </div>
        <?php endif; ?>
        <div class="text-center mt-2 mb-4">
            <h2 class="mt-1 mb-2">Welcome<strong> <?= $_SESSION['username'] ?></strong></h2>
        </div>

        <a href="login.php" class="btn btn-success">Login Here!</a>
        <!-- destroy all sessions -->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>