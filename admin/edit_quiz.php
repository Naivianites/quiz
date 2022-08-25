<?php
require "../login/functions_query.php";
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
            <div class="alert <?= $_SESSION['alert-class'] ?>">
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
                <?php unset($_SESSION['alert-class']); ?>
            </div>
        <?php endif; ?>

        <?php
        if (isset($_GET['id'])) {
            // question table
            $question_info = edit_questions($_GET['id'])->fetch_assoc();
            $question_number = $question_info['question_number'];
            $question_text = $question_info['question_text'];

            // choices table
            $choice_info = edit_choice_questions($_GET['id']);

            // get correct choices
            // $correct_choice = get_correct_choice($_GET['id']);
            
        }
        ?>

        <!-- add form -->
        <form method="POST">

            <!-- question number -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-danger">Question
                    Number<span>*</span></label>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="question_number" value="<?= $question_number ?>">
            </div>

            <!-- Question text -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-danger">Question
                    here<span>*</span></label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="question_text" value="<?= $question_text ?>">
            </div>

            <!-- title for choices -->
            <p>Type your choices here</p>
            <!-- choice1 -->
            <?php
            $choice_number = 1;
            while ($row = $choice_info->fetch_assoc()) {
            ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label text-danger">Choice #<?= $choice_number?><span>*</span></label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="choices[]" value="<?= $row['choices'] ?>">
                </div>
            <?php $choice_number++;
            }
            ?>

            <!-- correct choice -->
            
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label ">Correct Choice: <strong><input type="text"name="correct_choice" min="1" max="3" class="form-control"><strong></label>
            </div>
          
            <!-- submit btn -->
            <div class="modal-footer">
                <a href="add_quiz.php" class="btn btn-secondary">
                    Close
                </a>
                <button type="submit" class="btn btn-primary  mt-3" name="edit_quiz_btn">
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