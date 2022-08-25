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

// total questions
$question_list = get_coc_questions();
$total_question = $question_list->num_rows;

// overall scores
// percentage of the score
$percentage = ($_SESSION['score'] / $total_question) * 100;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../header_links.php" ?>
    <title>QUIZ | Results </title>
    <style>
        body {
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
        <div class="bg-success text-center text-light p-2">
            <h2>Quiz Results</h2>
        </div>
        <div class="p-5 text-left">
            <h3>Total Score : <strong><?= $_SESSION['score'] ?> / <?= $total_question ?></strong></h3>
            <h3>Score Percentage : <strong><?= round($percentage, 2) ?>%</strong></h3>
            <?php
            $status = "PASS";
            $message = "Congratulations, you must be proud to yourself!";

            if ($percentage < 75) {
                $status = "FAILED";
                $message = "It's OK, but you need to study more";
            ?>
                <h3>Status: <span class="text-danger"><?= $status ?></span></h3>
                <h3 class="text-center mt-3"><span class="text-danger"><?= $message ?></span></h3>
            <?php

            } else {
            ?>
                <h3>Status: <span class="text-success"><?= $status ?></span></h3>
                <h3 class="text-center mt-3"><span class="text-success"><?= $message ?></span></h3>
            <?php
            }

            // get results information and store it to the database
            $score = (string)$_SESSION['score']." / $total_question";
            if (quiz_result($_SESSION['logon-username'], $score, $percentage, $status)) {
            ?>
                <div class="mt-5">
                    <!-- view answers -->
                    <!-- <a href="#" class="btn btn-success">View answers</a> -->
                    <!-- try again -->
                    <a href="intro_quiz.php" class="btn btn-warning">Try again</a>
                    <!-- go back home -->
                    <a href="index.php" class="btn btn-primary">Home</a>
                    <!-- unset sessions -->
                </div>
            <?php
            unset($_SESSION['score']);
            }else{
                echo "error";
            }

            ?>
        </div>
    </div>
</body>

</html>