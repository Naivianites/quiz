<?php require "controller/authController.php";
// session_destroy();

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
    <div class="wrapper">
        <div class="text-center mt-2 mb-4">
            <h2 class="mt-1 mb-2">Online <span class="text-danger">CSS</span> Quiz</h2>
        </div>
        <form method="POST">
            <?php if (count($errors) > 0) : ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error; ?></li>
                    <?php endforeach ?>
                </div>
            <?php endif; ?>
                        
            <?php if (isset($_SESSION['login_status'])) : ?>
                <p class="alert <?= $_SESSION['alert-class'] ?>"><?= $_SESSION['login_status'] ?></p>
                <?php unset($_SESSION['login_status']); ?>
                <?php unset($_SESSION['alert-class']); ?>
            <?php endif; ?>

            <div class="form-container mb-4">
                <div class="input-group flex-nowrap">
                    <!-- icon -->
                    <i class="fa-solid fa-user input-group-text"></i>
                    <!-- input field -->
                    <input type="text" class="form-control" placeholder="Email" aria-label="Username" aria-describedby="addon-wrapping" name="username">
                </div>

                <div class="input-group flex-nowrap mt-3">
                    <!-- icon -->
                    <i class='bx bxs-lock input-group-text'></i>
                    <!-- input field -->
                    <input type="password" class="form-control" placeholder="password" aria-label="Username" aria-describedby="addon-wrapping" name="password">
                </div>
            </div>
            <div class="mt-2 login-btn">
                <button type="submit" class="btn btn-primary" name="login-btn">Login</button> <br>
                <p class="mt-3 mb-2 text-center">
                    no account yet? <a href="signUp.php">Sign-up now!</a>
                </p>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>