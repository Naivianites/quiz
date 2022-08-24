<!-- side bars -->
<?php
    require "../login/config.php";
    $role = $_SESSION['users_role'];
    $username = $_SESSION['logon-username'];

    $sql = "SELECT * FROM `accounts` WHERE username = '$username' AND role = '$role'";
    $results = $mysqli->query($sql);
    $img = $results->fetch_assoc();
?>
<aside class="sidebar-top">
    <div class="sidebar-top-img">
        <img src="../uploaded_file/<?=$img['image']?>" alt="" />
        <h4 class="text-light"><?= ucfirst($_SESSION['logon-username'])?></h4>
    </div>
    <div class="sidebar-bottom">
        <a href="index.php">
            <i class="fa-solid fa-crown"></i>
            Quiz Record
        </a>

        <a href="intro_quiz.php">
            <i class="fa-solid fa-lightbulb"></i>
            Take Quiz
        </a>

        <a href="../login/logout.php?out=1">
            <i class='bx bx-log-out'></i>
            Logout
        </a>

    </div>
</aside>