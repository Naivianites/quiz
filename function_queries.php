<?php

require __DIR__ . "../login/config.php";

date_default_timezone_set("Asia/Manila");
$date_edited = date("F j, Y, g:i:s A");
$date_created = date("F j, Y, g:i:s A");
$errors = array();
// update id

if (isset($_SESSION["user_id"])) {
    $id = $_SESSION["user_id"];
}
//

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
// Account Queries

// edit
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
// ADD QUIZ
// display all questions
function get_coc_questions()
{
    global $mysqli;

    $sql = "SELECT * FROM `coc1`";
    $result = $mysqli->query($sql);
    return $result;
}

function coc1_insert($question_number, $question_text)
{
    global $mysqli, $date_created;
    $date_edited = "";

    $sql = "INSERT INTO `coc1` (question_number, question_text, date_created, date_edited) VALUES(?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssss", $question_number, $question_text, $date_created, $date_edited);
    return $stmt->execute();
}

function coc1_insert_choices($question_number, $is_correct, $values)
{
    global $mysqli, $date_created;
    $date_edited = "";

    $sql = "INSERT INTO `coc1_choices` (question_number, is_correct, choices, date_created, date_edited) VALUES(?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssss", $question_number, $is_correct, $values, $date_created, $date_edited);
    return $stmt->execute();
}

function edit_questions($question_number)
{
    global $mysqli;
    $sql = "SELECT * FROM `coc1` WHERE `question_number`='$question_number'";
    $result = $mysqli->query($sql);
    return $result;
    // 
}

function edit_choice_questions($question_number)
{
    global $mysqli;
    $sql = "SELECT * FROM `coc1_choices` WHERE `question_number`='$question_number'";
    $result = $mysqli->query($sql);
    return $result;
    // 
}

function get_correct_choice($question_number, $question_text)
{
    global $mysqli, $date_edited;

    $sql = "UPDATE `coc1` SET `question_text`='$question_text', `date_edited`='$date_edited' WHERE `question_number`='$question_number'";
    $result = $mysqli->query($sql);
    return $result;
}


// update quiz
function update_coc_questions($question_number, $question_text){
    global $mysqli, $date_edited;

    $sql = "UPDATE `coc1` SET `question_text`='$question_text',`date_edited`='$date_edited' WHERE `question_number`='$question_number'";

    $result = $mysqli->query($sql);
    return $result;
}

function delete_question($question_number){
    global $mysqli;

    $sql = "DELETE FROM `coc1` WHERE `question_number` = $question_number";
    $result = $mysqli->query($sql);
    return $result;
}

function delete_choices($question_number){
    global $mysqli;

    $sql = "DELETE FROM `coc1_choices` WHERE `question_number` = $question_number";
    $result = $mysqli->query($sql);
    return $result;
}

// return question number
function question_number($number){
    global $mysqli;

    $sql = "SELECT * FROM `coc1` WHERE question_number = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $number);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

// return choices question number

function get_choices($number){
    global $mysqli;

    $sql = "SELECT * FROM `coc1_choices` WHERE question_number = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $number);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function is_correct($choice_id){

    global $mysqli;

    $sql = "SELECT * FROM `coc1_choices` WHERE id = '$choice_id'";

    $result = $mysqli->query($sql);
    
    return $result;
}

// get_results_quiz

function get_results_quiz(){
    global $mysqli;

    $sql = "SELECT * FROM `result`";
    // prepare statement
    $result = $mysqli->query($sql);
    return $result;
}

// get quiz results
function quiz_result($username, $score, $percentage,  $status){
    global $mysqli, $date_created;
    
    $sql = "INSERT INTO `result` (`username`, `date_taken`, `score`, `percentage`, `status`) VALUES(?, ?, ?, ?, ?)";
    // prepare statement
    $stmt = $mysqli->prepare($sql);
    $stmt -> bind_param("sssss", $username, $date_created, $score, $percentage, $status);
    return $stmt->execute();
}
// END OF ADD QUIZ
#####################################################################################


// SUBMIT PROCESSING
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

// add quiz transactions

if (isset($_POST['add_quiz_btn'])) {
    $question_text = $_POST['question_text'];
    $correct_choice = $_POST['correct_choice'];
    $question_number = $_POST['question_number'];
    $choice1 = $_POST['choice1'];
    $choice2 = $_POST['choice2'];
    $choice3 = $_POST['choice3'];

    $choice = array();

    // the reason i do this is because I need to track the correct choices using key
    $choice[1] = $choice1;
    $choice[2] = $choice2;
    $choice[3] = $choice3;

    $fields = [$question_number, $question_text, $correct_choice, $choice1, $choice2, $choice3];

    foreach ($fields as $field) {
        if ($field == NULL) {
            $_SESSION['alert-class'] = "alert-danger";
            $errors['field-error'] = "All fields are required!";
            break;
        }
    }

    if ($correct_choice > 3) {
        $_SESSION['alert-class'] = "alert-danger";
        $errors['field-error'] = "Value must be less than or equal to 3";
    }

    // if no error then process data
    if (count($errors) === 0) {
        /*
            1. we need to store them in separate table 
            2. we need to validate question text and number if succeed the process choices
            3. if everything is good then redirect it to add quiz page
        */
        // process question text and table
        $is_correct = null;
        if (coc1_insert($question_number, $question_text)) {

            // we have to loop in order to insert 1 by 1
            foreach ($choice as $key => $values) {
                if ($key == $correct_choice) {
                    $is_correct = 1;
                } else {
                    $is_correct = 0;
                }

                // insert data after every loop
                $date_edited = "";
                // $sql = "INSERT INTO `coc1_choices` (`question_number`, `is_correct`, `choices`, `date_created`, `date_edited`) VALUES($question_number, $is_correct, $values, $date_created, $date_edited)";

                $sql = "INSERT INTO `coc1_choices`(`question_number`, `is_correct`, `choices`, `date_created`, `date_edited`) VALUES ('$question_number','$is_correct','$values','$date_created','$date_edited')";

                $result = $mysqli->query($sql);
            }

            // process data
            if ($result) {
                $_SESSION["insert-message"] = "Successfully added new quiz!";
                $_SESSION["alert-class"] = "alert-success";
                header("location:add_quiz.php");
                exit();
            } else {
                $_SESSION["insert-message"] = "Transaction Failed!";
                $_SESSION["alert-class"] = "alert-danger";
                header("location:add_quiz.php");
                exit();
            }
        } else {
            $errors['error'] = "Register Failed!";
        }
    }
}


// edit quiz
if (isset($_POST['edit_quiz_btn'])) {
    $question_number = $_POST['question_number'];
    $question_text = $_POST['question_text'];
    $correct_choice = $_POST['correct_choice'];
    $choice = $_POST['choices'];

    $choices = array();

    // disperse so that i can assign a number
    $choices[1]= $choice[0];
    $choices[2] = $choice[1];
    $choices[3] = $choice[2];


    // check for empty fields

    $fields = [$question_number, $question_text, $correct_choice, $choice[0], $choice[1], $choice[2]];

    foreach ($fields as $field) {
        if ($field == NULL) {
            $_SESSION['alert-class'] = "alert-danger";
            $errors['field-error'] = "All fields are required!";
            break;
        }
    }

    // if no error then process data
    if (count($errors) === 0) {
        /*
            1. we need to store them in separate table 
            2. we need to validate question text and number if succeed the process choices
            3. if everything is good then redirect it to add quiz page
        */
        // process question text and table
        $is_correct = null;
        if (update_coc_questions($question_number, $question_text)) {
            // we have to loop in order to insert 1 by 1
            foreach ($choices as $key => $values) {
                if ($key == $correct_choice) {
                    $is_correct = 1;
                } else {
                    $is_correct = 0;
                }

                // insert data after every loop
                // $sql = "INSERT INTO `coc1_choices` (`question_number`, `is_correct`, `choices`, `date_created`, `date_edited`) VALUES($question_number, $is_correct, $values, $date_created, $date_edited)";

                $sql = "UPDATE `coc1_choices` SET `is_correct`='$is_correct',`choices`='$values',`date_edited`='$date_edited' WHERE `question_number`='$question_number'";

                $result = $mysqli->query($sql);
            }

            // process data
            if ($result) {
                $_SESSION["insert-message"] = "Update Successfully";
                $_SESSION["alert-class"] = "alert-success";
                header("location:add_quiz.php");
                exit();
            } else {
                $_SESSION["insert-message"] = "Transaction Failed!";
                $_SESSION["alert-class"] = "alert-danger";
                header("location:add_quiz.php");
                exit();
            }
        } else {
            $errors['error'] = "Register Failed!";
        }
    }
}

