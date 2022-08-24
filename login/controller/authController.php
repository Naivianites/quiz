<?php
// login, logout and signup will will configure here
require "config.php";
require "functions_query.php";

// 2. prepare array that will handle errors
$errors = array();
// 3. prepare username and email to be use later in sign up
$username = null;
$email = null;

function error_checker($username, $email, $password, $confrimPassword,$upload_error, $img_extension, $filename, $tmp_name, $img_size, $role){
    global $errors;
       // check for empty fields
       if (empty($username)) {
        $errors['username'] = "Username is required";
    } else {
        if (strlen($username) < 6) {
            $errors['username'] = "Username must be atleast 6-8 characters";
        }
    }

    //  check email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid Email Address";
    }
    if (empty($email)) {
        $errors['email'] = "Email is required";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    } else {
        if (strlen($password) < 6) {
            $errors['password'] = "Password must be atleast 6-8 characters";
        }
    }

    if ($password !== $confrimPassword) {
        $errors['password'] = "Password does not match";
    }

    if (empty($role)) {
        $errors['role'] = "Role is required";
    }

    if ($upload_error === 4) {
        $errors['img_error'] = "No Image upload!";
    } else {
        if ($img_extension == 'jpg' || $img_extension == 'png' || $img_extension == 'jpeg') {
            if ($img_size <= 2000000) {
                $target_folder = "../uploaded_file/". $filename;

                if(move_uploaded_file($tmp_name, $target_folder)){
                    echo "nice";
                }else{
                    echo "upload error";
                }
            } else {
                $errors['img_error'] = "Image size too large!";
            }
        } else {
            $errors['img_error'] = "".strtoupper($img_extension).'</b> is not Allowed!';
        }
    }
    // also check if email already exist
    if (is_email_exist($email) > 0) {
        $errors['email'] = "Email already exist";
    }

    if (is_username_exist($username) > 0) {
        $errors['username'] = "Username already exist";
    }
}

// 4. collect data coming signup page
if (isset($_POST['sign-up'])) {
    // decalare all need iformation
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $confrimPassword = mysqli_real_escape_string($mysqli, $_POST['confrimPassword']);
    $role = $_POST['role'];
    // image related data
    $filename = $_FILES['img']['name'];
    $tmp_name = $_FILES['img']['tmp_name'];
    $upload_error = $_FILES['img']['error'];
    $img_size = $_FILES['img']['size'];
    $img_extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);

    error_checker($username, $email, $password, $confrimPassword,$upload_error, $img_extension, $filename, $tmp_name, $img_size, $role);

    if (count($errors) === 0) {
        // get all data
        // encrypt password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // insert query

        if (insert_query($username, $email, $password, $role, $filename)) {
            $user_id = $mysqli->insert_id;
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['login_status'] = "Account successfully created";
            $_SESSION['alert-class'] = "alert-success";
            header("location:welcome.php");
        } else {
            $errors['login_status'] = "Refgister failed";
        }
    }
}

// login

if (isset($_POST['login-btn'])) {
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);

    // check for empty fields
    if (empty($username)) {
        $errors['username'] = "Username or Email is required";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    }

    if (count($errors) === 0) {
        // first validation for email or username
        // check if the the username or password exist
        // if it does exist then proceed to password verification otherwise flash error message

        // it will return true if exist otherwise flase if not
        if (email_username_checker($username) > 0) {
            // verify password
            if (validate_password($password, $username)) {

                if($_SESSION['users_role'] == "admin"){
                    // redirect to admin
                    header("location:../admin/index.php");
                    exit();
                }
                elseif($_SESSION['users_role'] == "user"){
                    
                    header("location:../user/index.php");
                    exit;
                }else{
                    header("location:login.php");
                    exit();
                }
            } else {
                $errors['password'] = "Wrong Password";
            }
        } else {
            $errors['login_status'] = "Invalid Username or Email Address";
        }
    }
}

