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


if(isset($_POST['delete_student'])){

    $id = $_POST['student_id'];

    

    if(delete($id)){
       $res = [
            'status' => 200,
            'message' => "successfully deleted!",
       ];

       echo json_encode($res);
       return false;
    }else{

        $res = [
            'status' => 500,
            'message' => "Failed to deleted!",
       ];

       echo json_encode($res);
       return false;
    }
}
