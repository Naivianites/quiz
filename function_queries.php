<?php
session_start();
require_once __DIR__ . "../login/config.php";

date_default_timezone_set("Asia/Manila");
$date_edited = date("F j, Y, g:i:s A");
$date_created = date("F j, Y, g:i:s A");
$errors = array();
// update id

if(isset($_SESSION["user_id"])){
    $id = $_SESSION["user_id"];
}

#####################################################################################
function admin_info_query()
{
    global $mysqli;
    $role = $_SESSION['users_role'];
    $sql = "SELECT * FROM `accounts` WHERE role=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $role);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_assoc();
    return $users;
}

// display queries
function get_accounts()
{
    global $mysqli;
    $sql = "SELECT * FROM `accounts`";
    $result = $mysqli->query($sql);
    return $result;
}

// get total users
function total_users()
{
    $result = get_accounts();
    $row_count = $result->num_rows;
    return $row_count;
}
// get total category
#####################################################################################




#####################################################################################
// Edit Functions
function get_users_id($id)
{
    global $mysqli;
    $sql = "SELECT * FROM `accounts` WHERE id=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_assoc();
    return $users;
}

// check if theres any change in the users data
function check_users_data($id, $username, $email, $password, $role)
{
    global $mysqli;
    $is_change = true;
    $sql = "SELECT * FROM `accounts` WHERE id=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $users_info = $result->fetch_assoc();

    // check for all each data for changes
    if ($username != $users_info['username']) {
        $is_change = false;
        return $is_change;
    }

    if ($email != $users_info['email']) {
        $is_change = false;
        return $is_change;
    }

    if ($role != $users_info['role']) {
        $is_change = false;
        return $is_change;
    }

    if ($password != $users_info['password']) {
        $is_change = false;
        return $is_change;
    }
    return $is_change;
}

// update userse data
function update_users_data($id, $username, $email, $password, $role)
{
    global $mysqli, $date_edited;
    $is_change = true;
    $sql = "SELECT * FROM `accounts` WHERE id=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $users_info = $result->fetch_assoc();

    if ($password == $users_info['password']) {
        $sql = "UPDATE `accounts` SET `id`='$id',`username`='$username',`email`='$email',`role`='$role',`date_edited`='$date_edited' WHERE `id`='$id'";
        $result = $mysqli->query($sql);
        return $result;
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE `accounts` SET `id`='$id',`username`='$username',`email`='$email',`password`='$password',`role`='$role',`date_edited`='$date_edited' WHERE `id`='$id'";
        $result = $mysqli->query($sql);
        return $result;
    }
}

#####################################################################################




#####################################################################################
// category functions
function add_category($category)
{
    global $mysqli, $date_created;

    $date_edited = "";

    $sql = "INSERT INTO `category` (category, date_created, date_edited) VALUES(?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss", $category, $date_created, $date_edited);
    return $stmt->execute();
}

// display all category to the category page
function get_category()
{
    global $mysqli;

    $sql = "SELECT * FROM `category`";
    $result = $mysqli->query($sql);
    return $result;
}

// fetch data via id

function get_category_info($id)
{
    global $mysqli, $date_created;
    $date_edited = "";

    $sql = "SELECT * FROM `category` WHERE id=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}


function update_category($category)
{
    global $mysqli, $date_edited, $id;
    
    $sql = "UPDATE `category` SET `id`='$id', `category`='$category',`date_edited`='$date_edited' WHERE `id`='$id'";

    $result = $mysqli->query($sql);
    return $result;
}


// DELETE CATEGORY

function delete($id){
    global $mysqli;

    $sql = "DELETE FROM `category` WHERE id=$id";

    $result = $mysqli->query($sql);

    return $result;
}

#####################################################################################




// 4. collect data coming signup page
if (isset($_POST['edit'])) {
    // users id
    // decalare all need iformation
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $confrimPassword = mysqli_real_escape_string($mysqli, $_POST['confrimPassword']);
    $id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $role = $_POST['role'];

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

    if (count($errors) === 0) {

        // check the data if theres any changes (return true if none)
        $is_change = check_users_data($id, $username, $email, $password, $role);

        // if false update the data
        if ($is_change) {
            $_SESSION['message'] = "No changes has been made";
            $_SESSION['alert-class'] = "alert-warning";
            header("location:accounts.php");
            exit;
        } else {
            // update data
            if (update_users_data($id, $username, $email, $password, $role)) {
                $_SESSION['alert-class'] = "alert-success";
                $_SESSION['message'] = "Update successfully";
                // redirect
                header("location:accounts.php");
                exit;
            } else {
                $errors['update_error'] = "Update Failed";
            }
        }
    }
}


// category form
if (isset($_POST["submit-category"])) {
    $category =  mysqli_escape_string($mysqli, $_POST["category"]);

    if ($category == NULL) {
        $errors['category-error'] = "Input field is required!";
    }

    if (count($errors) === 0) {
        // process indormation
        if (add_category($category)) {
            $_SESSION['alert-class'] = "alert-success";
            $_SESSION['category-msg'] = "successdully added category";
            header("location:category.php");
            exit();
        } else {
            $_SESSION['alert-class'] = "alert-danger";
            $_SESSION['category-msg'] = "Failed to register Category";
            header("location:category.php");
            exit();
        }
    }
}

// category update
if (isset($_POST['update_categ'])) {
    $update_category =  mysqli_escape_string($mysqli, $_POST["category"]);


    if ($update_category == NULL) {
        $errors['category-error'] = "Input field is required!";
    }

    if (count($errors) === 0) {
        // process indormation
        if (update_category($update_category)) {
            $_SESSION['alert-class'] = "alert-success";
            $_SESSION['category-msg'] = "Update Successdully";
            header("location:category.php");
            exit();
        } else {
            $_SESSION['alert-class'] = "alert-danger";
            $_SESSION['category-msg'] = "Failed to update category";
            header("location:category.php");
            exit();
        }
    }
}
