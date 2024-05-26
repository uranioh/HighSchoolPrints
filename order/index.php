<?php session_start();
if (!isset($_SESSION['user_id'])){
    header("Location: /HighSchoolPrints/login/index.php?next=order");
    exit();
} else {
    readfile("content.html");
}
