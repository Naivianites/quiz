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

$question_list = get_coc_questions();
$total_question = $question_list->num_rows;

$question_number = $question_list->fetch_assoc();
$estimated_time = $total_question * .5;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../header_links.php" ?>
    <title>User | Introduction </title>
    <style>
        *{
            margin: 0;
            padding: 0;
            line-height: 1.5em;
            box-sizing: border-box;
        }
        .wrapper{
            position: absolute;
            top: 50%;
            left: 50%;
            width: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 10px 10px 40px rgba(0,0,0,0.1);
        }
        .title{
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="wrapper text-center pb-4">
        <div class="bg-success p-3 text-light title mb-3">
            <h2>Online Computer System Servicing Quiz</h2>
        </div>
        <div class="information">
            <p>This is a multiple choice quiz to test your knowledge of Computer System Servicing </p>
            <div>
                <p>Number of questions :<strong><?= $total_question ?></strong></p>
                <p>Type of question : <strong>Multiple</strong></p>
                <p>Estimated Time : <strong><?= $estimated_time ?> minute</strong></p>
            </div>
            <a href="question.php?n=1" class="btn btn-warning">Start Quiz</a>
        </div>
    </div>
</body>

</html>