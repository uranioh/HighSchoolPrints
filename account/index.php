<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /HighSchoolPrints/login/index.php?next=account");
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
    <link rel="stylesheet" href="/account/style.css">
    <link rel="stylesheet" href="/main.css">
    <script src="https://kit.fontawesome.com/b4ad05c0d4.js" crossorigin="anonymous"></script>
</head>
<body>

<!-- header -->
<header>
    <div>
        <div>
            <a href="/HighSchoolPrints/index.html"><img src="/img/logo_white.png" alt="logo"></a>
        </div>
        <nav>
            <a href="/order"><i class="fa-solid fa-bag-shopping"></i> Ordina</a>
            <a href="/about"><i class="fa-solid fa-people-group"></i> Chi siamo</a>

            <a href="/account"><i class="fa-solid fa-user"></i> Il mio account</a>
            <a href="/account/logout.php"><i class="fa-solid fa-sign-out"></i> Logout</a>
        </nav>
    </div>
</header>

<main>
    <section>
        <h1>Salve, <?php echo htmlspecialchars($user_name); ?></h1>
        <p>I tuoi dati:</p>
        <p>Name: <?php echo htmlspecialchars($user_name); ?></p>
        <p>Surname: <?php echo htmlspecialchars($user_surname); ?></p>
        <p>Mail: <?php echo htmlspecialchars($user_mail); ?></p>
        <p>Password: <?php echo htmlspecialchars($user_password); ?></p>
        <p>Class: <?php echo htmlspecialchars($user_class); ?></p>
        <!-- Add more user details here -->
    </section>
</main>

<footer>
    <div id="footer_menu">
        <a href="/order"><i class="fa-solid fa-bag-shopping"></i> Ordina</a>
        <a href="/about"><i class="fa-solid fa-people-group"></i> Chi siamo</a>
        <a href="/account"><i class="fa-solid fa-user"></i> Il mio account</a>
    </div>
    <div id="footer_social">
        <a href="#"><i class="fa-brands fa-linkedin-in"></i> Linkedin</a>
        <a href="#"><i class="fa-brands fa-instagram"></i> Instagram</a>
        <a href="#"><i class="fa-brands fa-facebook-f"></i> Facebook</a>
    </div>
    <div id="footer_copy">
        <span>&copy; 2024 HSPrints Srl</span>
        <span> P.IVA </span>
        <span> CF 1234567890 </span>
    </div>
</footer>
</body>
</html>
