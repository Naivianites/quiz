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

if(isset($_GET['n'])){
    $number = $_GET['n'];
}

// questions
$question_number = question_number($number);
$question_result = $question_number->fetch_assoc();

// choices
$choice = get_choices($number);

// total questions
$question_list = get_coc_questions();
$total_question = $question_list->num_rows;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../header_links.php" ?>
    <title>User | Introduction </title>
    <style>
        body{
            background-color: #E2EEFF;
        }
        * {
            margin: 0;
            padding: 0;
            line-height: 1.5em;
            box-sizing: border-box;
        }

        .wrapper {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 10px 10px 40px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="wrapper pb-4">
        <div class="bg-success text-center text-light p-2 mb-4">
            <h2><?= ucfirst($question_result['question_text']) ?></h2>
            <p>Question #: <?= $number ?></p>
        </div>
        <div class="px-5">
            <form action="process.php" method="post">
                <?php
                while ($row = $choice->fetch_assoc()) {
                ?>  
                    <input type="hidden" name="number" value="<?= $number ?>">
                    <div class="form-check">
                        <input class="form-check-input fs-4" type="radio" name="choice_id" value="<?= $row['id'] ?>">
                        <label class="form-check-label fs-4">
                            <?= $row['choices'] ?>
                        </label>
                    </div>
                <?php
                }
                ?>
                <div class="mt-5 text-center" >
                    <button type="submit" name="submit_quiz" class="btn btn-outline-success">Next Question</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>