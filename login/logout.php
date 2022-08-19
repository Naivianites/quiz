<?php

// logout
if(isset($_GET['out'])){
    session_start();

    // $_SESSION['role'];
    session_destroy();
    header("location:../index.php");
    exit;
}
