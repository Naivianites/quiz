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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin | Add Quiz</title>
  <?php require "../header_links.php"; ?>
  <link rel="stylesheet" href="../user/css/style.css" />
</head>

<body>
  <!-- main contents -->
  <main class="main-content">
    <div class="d-flex justify-content-between mb-4">
      <h1 class="text-primary">Add Quiz</h1>
      <!-- Button trigger modal -->
      <a href="add_quiz_data.php" class="btn btn-outline-success quiz_btn">
        <i class="bx bxs-user-plus fs-1"></i>
      </a>
    </div>

    <?php if (isset($_SESSION['insert-message'])) { ?>
      <div class="alert <?= $_SESSION['alert-class'] ?>">
        <?php
        echo $_SESSION['insert-message'];
        // remove session after refresh
        unset($_SESSION['insert-message']);
        unset($_SESSION['alert-class']);
        ?>
      </div>
    <?php
    }
    ?>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">Question number</th>
          <th scope="col">Questions</th>
          <th scope="col">Date Added</th>
          <th scope="col">Date Edited</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <?php
        $result = get_coc_questions();
        $number_of_questions = $result->num_rows;
    
        while ($row = $result->fetch_assoc()) {
        ?>
          <tr>
            <td><?= $row['question_number'] ?></td>
            <td><?= $row['question_text'] ?></td>
            <td><?= $row['date_created'] ?></td>
            <td><?= $row['date_edited'] ?></td>
            <td>
              <!-- view, edit and delete -->
              <!-- class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal" -->
              <a href="edit_quiz.php?id=<?= $row['question_number'] ?>"><i class="fa-solid fa-pen-to-square text-primary fs-5 ms-2 me-2 "></i></a>
              <a href="delete_quiz.php?delete_id=<?= $row['question_number'] ?>"><i class="fa-solid fa-trash text-danger fs-5"></i></a>
            </td>
          </tr>
        <?php
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script>
  <script>
    // DELETE
    $(document).ready(function() {

      $(".quiz_btn").click(function() {

        $("#add_quiz").modal('show');

      })
    })
  </script>
</body>

</html>