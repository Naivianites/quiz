<?php
// setting up database connections
$host = "localhost";
$username = "root";
$password = "";
$db_name = "css";

$mysqli = new mysqli($host, $username, $password, $db_name);

if(!$mysqli){
    echo "Connection Failed!" . $mysqli->connect_error.__LINE__;
}
?>