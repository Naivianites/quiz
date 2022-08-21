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


if(isset($_GET['delete_id'])){
    $question_number = $_GET['delete_id'];
    
    if(delete_question($question_number) && delete_choices($question_number)){
        $_SESSION["insert-message"] = "Delete Successfully";
        $_SESSION["alert-class"] = "alert-success";
        header("location:add_quiz.php");
        exit();
    }else{
        $_SESSION["insert-message"] = "Failed to Delete";
        $_SESSION["alert-class"] = "alert-success";
        header("location:add_quiz.php");
        exit();
    }
}
?>