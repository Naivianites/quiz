<?php
session_start();
// login, logout and signup will be configure here
require "config.php";
// require "controller/authController.php";

// variable declarations
date_default_timezone_set("Asia/Manila");
$date_created = date("F j, Y, g:i:s A");

// check for email
function is_email_exist($email)
{
    // use prepare statement
    global $mysqli;
    $sql = "SELECT * FROM `accounts` WHERE email=? LIMIT 1";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    // get results
    $results = $stmt->get_result();
    // get number of rows if > 0 means email is exist
    $row_count = $results->fetch_assoc();
    // $stmt->close();
    return $row_count;
}

// check for username
function is_username_exist($username)
{
    // use prepare statement
    global $mysqli;
    $sql = "SELECT * FROM `accounts` WHERE username=? LIMIT 1";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    // get results
    $results = $stmt->get_result();
    // get number of rows if > 0 means email is exist
    $row_count = $results->fetch_assoc();
    // $stmt->close();
    return $row_count;
}



function  insert_query($username, $email, $password, $role, $image)
{
    global $mysqli, $date_created;
    $date_edited = "";

    $sql = "INSERT INTO `accounts` (username, email, password, role, image, date_created, date_edited) VALUES (?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssssss", $username, $email, $password, $role, $image, $date_created, $date_edited);
    return $stmt->execute();
}

// login check
function email_username_checker($username)
{
    global $mysqli;
    $sql = "SELECT * FROM  `accounts` WHERE email=? OR username=? LIMIT 1";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $results_qeury = $stmt->get_result();
    $results = $results_qeury->fetch_assoc();
    $row_count = $results_qeury->num_rows;
    return $row_count;
}

// password verification
function validate_password($password, $username)
{
    global $mysqli;
    $sql = "SELECT * FROM  `accounts` WHERE email=? OR username=? LIMIT 1";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $results = $stmt->get_result();
    $user_pass = $results->fetch_assoc();
    $verification_status = password_verify($password, $user_pass['password']);

    $_SESSION['users_role'] = $user_pass['role'];
    
    return $verification_status;
}

function display_query(){
    // use prepare statement
    global $mysqli;
    $sql = "SELECT * FROM `accounts`";
    $results = $mysqli->query($sql);
    $user = $results->fetch_assoc();
    return $user;
}