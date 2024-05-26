<?php
session_start();
$_mail = $_POST['email'];
$_password = $_POST['password'];

$_dbuser = "root";
$_dbpass = "root";
$_dbhost = "localhost";
$_dbname = "HSPrintsDB";
$_conn = mysqli_connect($_dbhost, $_dbuser, $_dbpass, $_dbname);
if (!$_conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";

    //check if there is a user with given credentials
    $_query = <<<EOF
        SELECT * 
        FROM Students 
        WHERE Mail='$_mail' AND Password='$_password' 
    EOF;
    $_result = mysqli_query($_conn, $_query);

    if (mysqli_num_rows($_result) > 0) {
        $_row = mysqli_fetch_row($_result);
        $_SESSION['user_id'] = $_row[0];

        header("Location: ../account/userInfo.php");

    } else {
        echo "Login failed";
    }
    mysqli_close($_conn);
}
