<?php
require "../function_queries.php";
if(!isset($_SESSION['users_role'])){
    header("location:../login/login.php");
  }
  else{
    if($_SESSION['users_role'] != "admin"){
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
    <title>Admin | Edit</title>
    
    <!-- fonts -->
    <?php require "../header_links.php";?>

    <link rel="stylesheet" href="../login/css/style.css?v=<?= time();?>" />
</head>

<body>
    <!-- <?php include "headers.php"; ?> -->
    <div class="wrapper">
        <div class="text-center">
            <h2>Edit users <span class="text-danger">account</span> here!</h2>
        </div>
        <?php if(count($errors) > 0) :?>
            <?php foreach($errors as $error): ?>
                <p><?=$error;?></p>
            <?php endforeach; ?>
        <?php endif;?>
        <form method="post">
            <?php
            //get users id
            $id = $_GET['id'];
            $account = get_users_id($id);
                
            ?>
            <div class="form-container">
                <div class="input-group flex-nowrap">
                    <!-- icon -->
                    <i class="fa-solid fa-user input-group-text"></i>
                    <!-- input field -->
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" value="<?= $account['username']?>" aria-describedby="addon-wrapping" name="username">
                </div>
                
                <div class="input-group flex-nowrap mt-3">
                    <!-- icon -->
                    <i class='bx bxl-gmail input-group-text'></i>
                    <!-- input field -->
                    <input type="text" class="form-control" placeholder="Email" aria-label="Username" value="<?= $account['email']?>" aria-describedby="addon-wrapping" name="email">
                </div>
                <!-- get id -->
                <input type="hidden" value="<?= $account['id']?>" name="user_id">
                <div class="input-group flex-nowrap mt-3">
                    <!-- icon -->
                    <i class='bx bxs-lock input-group-text'></i>
                    <!-- input field -->
                    <input type="password" class="form-control" placeholder="password" aria-label="Username" aria-describedby="addon-wrapping" name="password" value="<?= $account['password']?>">
                </div>

                <div class="input-group flex-nowrap mt-3">
                    <!-- icon -->
                    <i class='bx bxs-lock input-group-text'></i>
                    <!-- input field -->
                    <input type="password" class="form-control" placeholder="Confirm password" aria-label="Username" aria-describedby="addon-wrapping" name="confrimPassword" value="<?= $account['password']?>">
                </div>

                <select class="form-select form-select-sm mt-3" name="role" aria-label=".form-select-sm example" >
                    <option selected value="<?= $account['role']?>">User</option>
                </select>

            </div>
            <div class="mt-2 login-btn">
                <button type="submit" class="btn btn-primary mt-2" name="edit">Update account</button> <br>
                <a href="accounts.php" class="btn btn-secondary mt-2">Close</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>


