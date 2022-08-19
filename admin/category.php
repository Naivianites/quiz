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
  <title>Admin | Category</title>

  <?php require "../header_links.php"; ?>

  <link rel="stylesheet" href="../user/css/style.css" />
</head>

<body>
  <!-- main contents -->
  <main class="main-content">
    <div class="d-flex justify-content-between mb-4">
      <h1 class="text-primary">Category</h1>
    </div>

    <!-- error message -->
    <?php if (count($errors) > 0) : ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $error) : ?>
          <li><?= $error; ?></li>
        <?php endforeach ?>
      </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['category-msg'])) { ?>
      <div class="alert <?= $_SESSION['alert-class'] ?>">
        <?php
        echo $_SESSION['category-msg'];
        unset($_SESSION['category-msg']);
        ?>
      </div>
    <?php
    }
    ?>
    <!-- category form -->
    <form method="post" class="mt-4 mb-4">
      <a href="add_cat.php" class="btn btn-outline-success">
        add Category
      </a>
    </form>


    <table class="table table-striped table-hover" id="user_table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Category name</th>
          <th scope="col">Date Added</th>
          <th scope="col">Date Edited</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <!-- display all cetegories from database -->
        <?php
        $category = get_category();
        $SN = 1;
        while ($row = $category->fetch_array()) {
        ?>
          <tr>
            <td><?= $SN;?></td>
            <td><?= $row['category']?></td>
            <td><?= $row['date_created']?></td>
            <td><?= $row['date_edited']?></td>
            <td>
              <a href="edit_cat.php?id=<?=$row['id']?>" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
              <button type="button" class="btn btn-danger deleteBtn" value="<?=$row['id']?>"><i class="fa-solid fa-trash"></i></button>
              <!-- <button class=""></button> -->
            </td>
          </tr>

        <?php $SN++;
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
     $(document).on("click", ".deleteBtn", function(e) {     
            e.preventDefault();
            // get id to be deleted!
            var student_id = $(this).val();

            if (confirm("Are you sure you want to delete this data?")) {
                $.ajax({
                    type: "POST",
                    url: "delete_cat.php",
                    data: {
                        'delete_student': true,
                        'student_id': student_id
                    },
                    success: function(response) {
                        var res = $.parseJSON(response);

                        if (res.status == 500) {
                            alert(res.message);
                        } else{
                          alert(res.message);
                          $("#user_table").load(location.href + " #user_table");
                        }
                    }
                })
            }
          })
  </script>
</body>

</html>