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
    <title>Admin | Add Quiz</title>

    <!-- fonts -->
    <?php require "../header_links.php"; ?>

    <link rel="stylesheet" href="../login/css/style.css?v=<?= time(); ?>" />
</head>

<body>
    <!-- <?php include "headers.php"; ?> -->
    <div class="wrapper" style="width: 500px; top: 60%;">
        <div class="text-center">
            <h2>Add <span class="text-danger">Quiz</span> Here!</h2>
        </div>

        <?php if (count($errors) > 0) : ?>
            <div class="alert <?= $_SESSION['alert-class']?>">
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
                <?php unset($_SESSION['alert-class']);?>
            </div>
        <?php endif; ?>

        <?php
            $sql = "SELECT * FROM `coc1`";
            $result = $mysqli->query($sql);
            $number_of_questions = $result->num_rows;
        ?>

        <!-- add form -->
        <form method="POST">
           
            <!-- question number -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-danger">Question
                    Number<span>*</span></label>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="question_number" value="<?= $number_of_questions + 1?>">
            </div>

            <!-- Question text -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-danger">Question
                    here<span>*</span></label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="question_text">
            </div>
            <!-- title for choices -->
            <p>Type your choices here</p>
            <!-- choice1 -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-danger">Choice#1<span>*</span></label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="choice1">
            </div>
            <!-- choice2 -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-danger">Choice#2<span>*</span></label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="choice2">
            </div>
            <!-- choice3 -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-danger">Choice#3<span>*</span></label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="choice3">
            </div>

            <!-- correct choice -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label ">Correct Choice: <strong><input type="number" name="correct_choice" min="1" max="3" class="form-control"></strong></label>
            </div>

            <!-- submit btn -->
            <div class="modal-footer">
                <a href="index.php" class="btn btn-secondary">
                    Close
                </a>
                <button type="submit" class="btn btn-primary  mt-3" name="add_quiz_btn">
                    Submit
                </button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>