<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /HighSchoolPrints/login/index.php?next=account");
    exit();
}

$_user_id = $_SESSION['user_id'];
$_button_id = $_POST['button'];
//prendi i dati inseriti dall'utente
$_name = $_POST['name'];
$_surname = $_POST['surname'];
$_mail = $_POST['mail'];
$_password = $_POST['password'];
$_class = $_POST['class'];

$_dbuser = "root";
$_dbpass = "root";
$_dbhost = "localhost";
$_dbname = "HSPrintsDB";
$_conn = mysqli_connect($_dbhost, $_dbuser, $_dbpass, $_dbname);
if (!$_conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    if ($_button_id == "delete") {
        $_query = "SET foreign_key_checks = 0;";
        mysqli_query($_conn, $_query);
        $_query = <<<EOF
            DELETE FROM Students
            WHERE id='$_user_id';
        EOF;
        $_result = mysqli_query($_conn, $_query);
        $_query = "SET foreign_key_checks = 1;";
        mysqli_query($_conn, $_query);
        session_destroy();
        header("Location: /HighSchoolPrints/");
    } else if ($_button_id == "update") {
        $_query = <<<EOF
        UPDATE Students
        SET FName='$_name', LName='$_surname', Mail='$_mail', Password='$_password', Class='$_class'
        WHERE ID='$_user_id';
        EOF;
        $_result = mysqli_query($_conn, $_query);
    }
    header("Location: /HighSchoolPrints/account/");
    mysqli_close($_conn);
}