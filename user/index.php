<?php
require "../login/functions_query.php";
require "../function_queries.php";

if (!isset($_SESSION['users_role'])) {
  header("location:../login/login.php");
} else {
  if ($_SESSION['users_role'] != "user") {
    header("location:../login/login.php");
  }
}
$result = get_results_quiz();

$question_list = get_coc_questions();
$total_question = $question_list->num_rows;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../header_links.php" ?>
  <title>User | Dashboard</title>
  <link rel="stylesheet" href="../user/css/style.css" />

  <style>
    #scroll {
      overflow-y: scroll;
      height: 500px;
    }
  </style>
</head>

<body>
  <!-- main contents -->
  <main class="main-content">
    <h1 class="text-primary">Quiz Records</h1>
    <div id="scroll">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">Date taken</th>
            <th scope="col">Scores</th>
            <th scope="col">Percentage</th>
            <th scope="col">Status</th>
            <!-- <th scope="col">Action</th> -->
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php

          while ($row = $result->fetch_assoc()) {
          ?>
            <tr>
              <td><?= $row['date_taken'] ?> </td>
              <td><?= $row['score'] ?></td>
              <?php
              if ($row['percentage'] >= 75) {
              ?>
                <td class="text-success"><?= $row['percentage'] ?></td>
                <td class="text-success"><?= $row['status'] ?></td>
              <?php
              } else {
              ?>
                <td class="text-danger"><?= $row['percentage'] ?></td>
                <td class="text-danger"><?= $row['status'] ?></td>
              <?php
              }
              ?>
            </tr>
          <?php
          }
          ?>

        </tbody>
      </table>
    </div>
  </main>

  <?php include "sidebars.php" ?>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- font awesome -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>