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

// this will handle scores

if(!isset($_SESSION['score'])){
    $_SESSION['score'] = 0;
}

if(isset($_POST['submit_quiz'])){
    $question_number = $_POST['number'];
    $next_question = $question_number + 1;
    $choice_id = $_POST['choice_id'];
    // collect data
    // get score
    $row = is_correct($choice_id);
    $row = $row->fetch_assoc();
    
    $is_correct = $row['is_correct'];

    if($is_correct == 1){
        // if true then 
        $_SESSION['score']++;
    }

    if($question_number == $total_question){
         // process to results page
         header("location:result.php");
         exit;
    }else{
         // send back to question.php with n++
         header("location:question.php?n=" . $next_question);
         exit;
    }
}