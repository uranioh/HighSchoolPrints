<?php session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /HighSchoolPrints/login/index.php?next=order");
    exit();
} else {
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
            $user_class = $_row[5];
        } else {
            echo "User not found";
            exit();
        }

        $_query = <<<EOF
            SELECT PaperFormat.Name, PaperFormat.PricePerUnit
            FROM PaperFormat;
        EOF;

        $_result = mysqli_query($_conn, $_query);

        $_prices = array();
        while ($_row = mysqli_fetch_row($_result)) {
            $_prices[$_row[0]] = $_row[1];
        }

        mysqli_close($_conn);
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
    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/b4ad05c0d4.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Ordina</title>

<!--    php vars to js -->
    <script type="text/javascript">
        let prices = {
            "3R": <?php print($_prices['3R']); ?>,
            "4R": <?php print($_prices['4R']); ?>,
            "5R": <?php print($_prices['5R']); ?>,
            "6R": <?php print($_prices['6R']); ?>
        }
    </script>

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
    <div>
        <img id="cutting_board" src="img/board.png" alt="Cutting board">
    </div>

    <div id="images">
        <div id="verticals">
            <!-- -->
        </div>

        <div id="horizontals">
            <!-- -->
        </div>
    </div>

    <form action="order_submit.php" method="post" onsubmit="return validateForm()">
        <h1>Benvenuto, <?php echo htmlspecialchars($user_name); ?> <?php echo htmlspecialchars($user_surname); ?></h1>

        <p>Ordina le tue...</p>
        <h1>Foto singole</h1>
        <div>
            <!--suppress HtmlFormInputWithoutLabel -->
            <select id="size_single" name="size_single" required>
                <option value="3R">3R 9x13cm 3.5x5" €<?php echo $_prices['3R']; ?></option>
                <option value="4R">4R 10x15cm 4x6" €<?php echo $_prices['4R']; ?></option>
                <option value="5R">5R 13x18cm 5x7" €<?php echo $_prices['5R']; ?></option>
                <option value="6R">6R 15x20cm 6x8" €<?php echo $_prices['6R']; ?></option>
            </select>


            <input type="number" id="qty_single" name="qty_single" required min="0" max="5" value="0" readonly>
            <!--            button +/- -->
            <button type="button" onclick="plus('qty_single')">+</button>
            <button type="button" onclick="minus('qty_single')">-</button>
        </div>

        <span>
            €<input type="text" id="price_single" name="price_single" value="0.00" disabled>
        </span>


        <h1>Foto di classe (<?php echo htmlspecialchars($user_class); ?>)</h1>
        <div>

            <select id="size_group" name="size_group" required>
                <option value="3R">3R 13x9cm 5x3.5" €<?php echo $_prices['3R']; ?></option>
                <option value="4R">4R 15x10cm 6x4" €<?php echo $_prices['4R']; ?></option>
                <option value="5R">5R 18x13cm 7x5" €<?php echo $_prices['5R']; ?></option>
                <option value="6R">6R 20x15cm 8x6" €<?php echo $_prices['6R']; ?></option>
            </select>

            <input type="number" id="qty_group" name="qty_group" required min="0" max="5" value="0" readonly>

            <button type="button" onclick="plus('qty_group')">+</button>
            <button type="button" onclick="minus('qty_group')">-</button>
        </div>

        <span>
            €<input type="text" id="price_group" name="price_group" value="0.00" disabled>
        </span>

        <button type="submit" id="submit_button">Paga €0.00</button>

        <p id="disclaimer">
            Le foto individuali verranno scattate presso il laboratorio indicato nella circolare. <br>
            Le foto di classe verranno scattate presso l'aula della <?php echo htmlspecialchars($user_class); ?>. <br>
            Per qualsiasi informazione e per il pagamento contatta il docente referente della tua classe.
        </p>

    </form>
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