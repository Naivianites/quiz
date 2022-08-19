<?php require "controller/authController.php"; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online CSS Quiz | Sign-up</title>

    <!-- fonts -->
    <?php include "header_links.php"; ?>

    <link rel="stylesheet" href="./css/style.css?=<?= time(); ?>" />
</head>

<body>
    <!-- <?php include "headers.php"; ?> -->
    <div class="wrapper">
        <div class="text-center">
            <h2>Setup your <span class="text-danger">account</span> here!</h2>
            <p class="text-secondary">Mabuhay! we are so happy to be part of your journey</p>
        </div>
        <form method="post" enctype="multipart/form-data">
            <!-- errors -->
            <?php if (count($errors) > 0) : ?>
                <div>
                    <?php foreach ($errors as $error) : ?>
                        <li class="text-danger"><?= $error; ?></li>
                    <?php endforeach ?>
                </div>
            <?php endif; ?>

            <div class="form-container">
                <div class="input-group flex-nowrap">
                    <!-- icon -->
                    <i class="fa-solid fa-user input-group-text"></i>
                    <!-- input field -->
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" value="<?= $username; ?>" aria-describedby="addon-wrapping" name="username">
                </div>

                <div class="input-group flex-nowrap mt-3">
                    <!-- icon -->
                    <i class='bx bxl-gmail input-group-text'></i>
                    <!-- input field -->
                    <input type="text" class="form-control" placeholder="Email" aria-label="Username" value="<?= $email; ?>" aria-describedby="addon-wrapping" name="email">
                </div>

                <div class="input-group flex-nowrap mt-3">
                    <!-- icon -->
                    <i class='bx bxs-lock input-group-text'></i>
                    <!-- input field -->
                    <input type="password" class="form-control" placeholder="password" aria-label="Username" aria-describedby="addon-wrapping" name="password">
                </div>

                <div class="input-group flex-nowrap mt-3">
                    <!-- icon -->
                    <i class='bx bxs-lock input-group-text'></i>
                    <!-- input field -->
                    <input type="password" class="form-control" placeholder="Confirm password" aria-label="Username" aria-describedby="addon-wrapping" name="confrimPassword">
                </div>

                <select class="form-select form-select-sm mt-3" name="role" aria-label=".form-select-sm example" >
                    <option selected value ="">Select Role</option>
                    <option value="user">User</option>
                </select>

                <div class="mb-3 mt-3">
                    <input class="form-control" type="file" id="formFile" name="img">
                </div>

            </div>
            <div class="mt-2 login-btn">
                <button type="submit" class="btn btn-primary" name="sign-up">Create account</button> <br>
                <p class="mt-3 mb-2 text-center">
                    Already have account? <a href="login.php">Login now!</a>
                </p>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>