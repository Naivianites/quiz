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

// require "../function_queries.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin | Add Quiz</title>
  <?php require "../header_links.php";?>
  <link rel="stylesheet" href="../user/css/style.css" />
</head>

<body>
  <!-- main contents -->
  <main class="main-content">
    <div class="d-flex justify-content-between mb-4">
      <h1 class="text-primary">Add Quiz</h1>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="bx bxs-user-plus fs-1"></i>
      </button>
    </div>

    <select class="form-select form-select-lg mb-3 category" aria-label=".form-select-lg example">
      <option selected>Select Category</option>
      <option value="coc1">COC1</option>
      <option value="coc2">COC2</option>
      <option value="coc3">COC3</option>
      <option value="coc4">COC4</option>
    </select>

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
        <tr>
          <td>1</td>
          <td>What is LAN Cable?</td>
          <td>08/10/22</td>
          <td>10/10/22</td>
          <td>
            <!-- view, edit and delete -->
            <!-- class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal" -->
            <a href="#"><i class="fa-solid fa-pen-to-square text-primary fs-5 ms-2 me-2 " data-bs-toggle="modal"
                data-bs-target="#edit"></i></a>
            <a href="#"><i class="fa-solid fa-trash text-danger fs-5" data-bs-toggle="modal"
                data-bs-target="#delete"></i></a>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- add modal -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add new question</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- add form -->
            <form method="POST" enctype="multipart/form-data">

              <!-- category -->
              <select class="form-select form-select-lg mb-4 mt-3" aria-label=".form-select-lg example" name="category">
                <option selected>Select Category</option>
                <option value="coc1">COC1</option>
                <option value="coc2">COC2</option>
                <option value="coc3">COC3</option>
                <option value="coc4">COC4</option>
              </select>

              <!-- question number -->
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label category">Question number: <strong><input
                      type="number" name="question_number" min="1" class="category"></strong></label>
              </div>

              <!-- Question text -->
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-danger">Question
                  here<span>*</span></label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                  name="question_text">
              </div>
              <!-- title for choices -->
              <p>Type your choices here</p>
              <!-- choice1 -->
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-danger">Choice#1<span>*</span></label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                  name="choice1">
              </div>
              <!-- choice2 -->
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-danger">Choice#2<span>*</span></label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                  name="choice2">
              </div>
              <!-- choice3 -->
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-danger">Choice#3<span>*</span></label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                  name="choice3">
              </div>

              <!-- correct choice -->
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label ">Correct Choice: <strong><input type="number"
                      name="correct_choice" min="1" max="3" class="category"></strong></label>
              </div>

              <!-- submit btn -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                  Close
                </button>
                <button type="submit" class="btn btn-primary" name="submit">
                  Submit
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- edit Modal-->
    <!-- Modal -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Questions</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- add form -->
            <form method="POST" enctype="multipart/form-data">

               <!-- category belong -->
               <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label ">Category: <strong>COC1</strong></label>
              </div>

              <!-- question number -->
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label category">Question number: <strong>3</strong></label>
              </div>

              <!-- Question text -->
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-danger">Type your question
                  here<span>*</span></label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                  name="question_text">
              </div>
              <!-- choice1 -->
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-danger">Choice#1<span>*</span></label>
                <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                  name="choice1">
              </div>
              <!-- choice2 -->
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-danger">Choice#2<span>*</span></label>
                <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                  name="choice2">
              </div>
              <!-- choice3 -->
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-danger">Choice#3<span>*</span></label>
                <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                  name="choice3">
              </div>

              <!-- correct choice -->
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label ">Correct Choice: <strong><input type="number"
                      name="correct_choice" min="1" max="3" class="category" value="1"></strong></label>
              </div>

              <!-- submit btn -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                  Close
                </button>
                <button type="submit" class="btn btn-primary" name="submit">
                  Submit
                </button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>

    <!-- delete modal -->
    <!-- Modal -->
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Question</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="mb-3">
              <p class="text-center fs-5 mb-5 mt-4">Are you sure you want to delete it?</p>
            </div>
            <div class="modal-footer">
              <a class="btn btn-secondary" data-bs-dismiss="modal">
                NO
              </a>
              <a href="#" class="btn btn-danger" name="submit">
                YES
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- side bars -->
  <?php include "sidebar.php"?>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- font awesome -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>