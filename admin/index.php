<?php
require "../login/functions_query.php";
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

$total_users = total_users();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin | Dashboard</title>

  <?php require "../header_links.php"; ?>
  
  <link rel="stylesheet" href="../user/css/style.css" />

 
  </style>
</head>

<body>
  <!-- main contents -->
  <main class="main-content">
    <p class="mb-5 fs-3">Welcome <?= ucfirst($_SESSION['users_role'])?></p>
    <div class="dashboard">
    
      <div class="total bg-dark">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <h4 class="text-light mx-3">Total Users</h4>
          <i class="bx bxs-user fs-1 text-light"></i>
        </div>
        <p class="text-light fs-1"><?=$total_users;?></p>
      </div>
    </div>
  </main>
  <?php include "sidebar.php" ?>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- font awesome -->
  <!-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
  

  
</script>
</body>

</html>