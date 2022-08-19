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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin | Accounts</title>
  <?php require "../header_links.php"; ?>
  <link rel="stylesheet" href="../user/css/style.css" />
</head>

<body>
  <!-- main contents -->
  <main class="main-content">
    <div class="d-flex justify-content-between mb-4">
      <h1 class="text-primary">Accounts</h1>
    </div>
    <!-- transaction message -->
    <?php if(isset($_SESSION['message'])):?>

      <div class="alert <?=$_SESSION['alert-class'];?>">
        <?=$_SESSION['message']?>
        <!-- unsetting session after refresh -->
        <?php
          unset($_SESSION['message']);
          unset($_SESSION['alert-class']);
        ?>
      </div>
    <?php endif;?>

    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">SN#</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>
          <th scope="col">Password</th>
          <th scope="col">Role</th>
          <th scope="col">Date Added</th>
          <th scope="col">Date Edited</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <?php
        $accounts = get_accounts();
        $count = 1;
        while ($row = $accounts->fetch_array()) {
        ?>
          <tr>
            <td><?= $count; ?></td>
            <td><?= $row['username']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['password']; ?></td>
            <td><?= $row['role']; ?></td>
            <td><?= $row['date_created']; ?></td>
            <td><?= $row['date_edited']; ?></td>
            <td>
              <!-- view, edit and delete -->
              <a href="view.php?id=<?= $row['id']; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-eye text-success fs-5"></i></a>
              
              <!-- class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal" -->
              <a href="edit.php?id=<?= $row['id']; ?>"><i class="fa-solid fa-pen-to-square text-primary fs-5 ms-2 me-2 " data-bs-toggle="modal" data-bs-target="#edit"></i></a>

              <a href="delete.php?id=<?= $row['id']; ?>"><i class="fa-solid fa-trash text-danger fs-5" id="delete"></i></a>
            </td>
          </tr>
        <?php $count++;
        }
        ?>
      </tbody>
    </table>
  </main>

  <!-- side bars -->
  <?php include "sidebar.php" ?>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- font awesome -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  
</body>

</html>