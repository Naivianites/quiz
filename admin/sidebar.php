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

$user = admin_info_query();

?>
<aside class="sidebar-top">
  <div class="sidebar-top-img">
    <img src="../uploaded_file/coding.png" alt="user_image" />
    <h4 class="text-light"><?= ucfirst($user['username']); ?></h4>
  </div>
  <div class="sidebar-bottom">
    <a href="index.php">
      <i class="bx bxs-dashboard"></i>
      Dashboard</a>
    <a href="accounts.php">
      <i class="bx bxs-user-plus"></i>
      Accounts</a>
    <a href="add_quiz.php">
      <i class="bx bxs-brain"></i>
      Add Quiz</a>
    <a href="category.php">
      <i class="bx bxs-category-alt"></i>
      Category</a>
    <a href="../login/logout.php?out=1">
      <i class="bx bxs-category-alt"></i>
      Logout</a>
  </div>
</aside>