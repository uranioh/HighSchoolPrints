<?php session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['order_id'])) {
    header("Location: /HighSchoolPrints/");
    exit();
} else {
    $_user_id = $_SESSION['user_id'];
    $_order_id = $_SESSION['order_id'];

    $_dbuser = "root";
    $_dbpass = "root";
    $_dbhost = "localhost";
    $_dbname = "HSPrintsDB";
    $_conn = mysqli_connect($_dbhost, $_dbuser, $_dbpass, $_dbname);
    if (!$_conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
}
?>
<!DOCTYPE html>
<!--suppress HtmlFormInputWithoutLabel -->
<html lang="it">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/b4ad05c0d4.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Ordina</title>
</head>

<body>
<!-- header -->
<header>
    <div>
        <div>
            <a href="../index.html"><img src="../img/logo_white.png" alt="logo"></a>
        </div>
        <nav>
            <a href="/order"><i class="fa-solid fa-bag-shopping"></i> Ordina</a>
            <a href="/about"><i class="fa-solid fa-people-group"></i> Chi siamo</a>

            <a href="/account"><i class="fa-solid fa-user"></i> Il mio account</a>
            <a href="/account/logout.php"><i class="fa-solid fa-sign-out"></i> Logout</a>
        </nav>
    </div>
</header>

<!-- main -->
<main>

</main>

<!-- footer -->
<footer>
    <!--    TO-DO: add links-->
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
