<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$_user_id = $_SESSION['user_id'];

$_dbuser = "root";
$_dbpass = "root";
$_dbhost = "localhost";
$_dbname = "HSPrintsDB";
$_conn = mysqli_connect($_dbhost, $_dbuser, $_dbpass, $_dbname);
if (!$_conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $_query = <<<EOF
        SELECT * 
        FROM Students 
        WHERE id='$_user_id'
    EOF;
    $_result = mysqli_query($_conn, $_query);
    
    if ($_result && mysqli_num_rows($_result) > 0) {
        $_row = mysqli_fetch_row($_result);
        $user_name = $_row[1];
        $user_surname = $_row[2];
        $user_mail = $_row[3];
        $user_password = $_row[4];
        $user_class = $_row[5];
    } else {
        echo "User not found";
        exit();
    }
    mysqli_close($_conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        /* styles.css */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #444;
        }

        p {
            font-size: 1.1em;
        }

        strong {
            color: #555;
        }

    </style>
</head>
<body>
<div class="container">
    <h1>Salve, <?php echo htmlspecialchars($user_name); ?></h1>
    <p>I tuoi dati:</p>
    <p>Name: <?php echo htmlspecialchars($user_name); ?></p>
    <p>Surname: <?php echo htmlspecialchars($user_surname); ?></p>
    <p>Mail: <?php echo htmlspecialchars($user_mail); ?></p>
    <p>Password: <?php echo htmlspecialchars($user_password); ?></p>
    <p>Class: <?php echo htmlspecialchars($user_class); ?></p>
    <!-- Add more user details here -->
</div>
</body>
</html>
