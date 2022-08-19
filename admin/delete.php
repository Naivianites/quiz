<?php
if(!isset($_SESSION['users_role'])){
    header("location:../login/login.php");
  }
  else{
    if($_SESSION['users_role'] != "admin"){
      session_destroy();
      header("location:../login/login.php");
    }
  }

require_once "../login/config.php";

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $sql = "DELETE FROM `accounts` WHERE id=$id";

    $result = $mysqli->query($sql);

    if($result){
        header("location:index.php");
    }else{
        echo "Delete Error: " . $mysqli->connect_error.__LINE__;
        die();
    }
}

?>