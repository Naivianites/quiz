<?php
require "../login/functions_query.php";
require "../function_queries.php";

if(!isset($_SESSION['users_role'])){
  header("location:../login/login.php");
}else{
  if($_SESSION['users_role'] != "user"){
    header("location:../login/login.php");
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../header_links.php"?>
  <title>User | Dashboard</title>
  <link rel="stylesheet" href="../user/css/style.css" />
</head>

<body>
  <!-- main contents -->
  <main class="main-content">
    <h1 class="text-primary">Accounts</h1>
    
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">Date taken</th>
          <th scope="col">Scores</th>
          <th scope="col">Percentage</th>
          <th scope="col">Time finished</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <tr>
          <td>07/06/2022</td>
          <td>22/25</td>
          <td class="text-success">88%</td>
          <td class="text-success">Pass</td>
          <td> 4 minute</td>
          <td>
            <a href="#" class="btn btn-success">View Answers</i></a>
          </td>
        </tr>
      </tbody>
    </table>
  </main>

  <?php include "sidebars.php" ?>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- font awesome -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>