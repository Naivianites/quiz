<?php
require "../function_queries.php";
if (!isset($_SESSION['users_role'])) {
    header("location:../login/login.php");
} else {
    if ($_SESSION['users_role'] != "admin") {
        session_destroy();
        header("location:../login/login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Add Category</title>

    <!-- fonts -->
    <?php require "../header_links.php"; ?>

    <link rel="stylesheet" href="../login/css/style.css?v=<?= time(); ?>" />
</head>

<body>
    <!-- <?php include "headers.php"; ?> -->
    <div class="wrapper">
        <div class="text-center">
            <h2>Add <span class="text-danger">Category</span> here!</h2>
        </div>

        <?php if (count($errors) > 0) : ?>
            <div class="alert alert-danger mt-3">
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error?></li>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form method="post">
            <?php
                $_SESSION["user_id"] = $_GET['id'];
                $new_id = $_GET['id'];
                $categ_info = get_category_info($new_id)->fetch_assoc();
            ?>
            <div class="input-group flex-nowrap mt-4 mb-4">
                <input type="text" class="form-control" placeholder="Add Category" name="category" value="<?=$categ_info['category']?>">
            </div>
            
            <div class="mt-2 login-btn">
                <button type="submit" class="btn btn-primary mt-2" name="update_categ">Save Category</button> <br>
                <a href="category.php" class="btn btn-secondary mt-2">Close</a>
            </div>

        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>