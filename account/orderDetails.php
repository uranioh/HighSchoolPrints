<?php session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /HighSchoolPrints/login/index.php?next=account");
    exit();
} else if (!isset($_GET['order_id'])) {
    header("Location: /HighSchoolPrints/account/");
    exit();
} else {
    $_dbuser = "root";
    $_dbpass = "root";
    $_dbhost = "localhost";
    $_dbname = "HSPrintsDB";

    $_order_id = $_GET['order_id'];

    $_conn = mysqli_connect($_dbhost, $_dbuser, $_dbpass, $_dbname);

    if (!$_conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $_query = <<<EOF
            SELECT * 
            FROM Orders 
            WHERE ID='$_order_id'
        EOF;
        $_result = mysqli_query($_conn, $_query);

        if ($_result && mysqli_num_rows($_result) > 0) {
            $_row = mysqli_fetch_row($_result);

            $_date = $_row[1];
            $_total = $_row[2];
            $_user_id = $_row[3];

            if ($_user_id != $_SESSION['user_id']) {
//                user not authorized
                header("Location: /HighSchoolPrints/account/");
                exit();
            }
        } else {
//            order not found
            header("Location: /HighSchoolPrints/account/");
            exit();
        }

        mysqli_close($_conn);
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="/account/style.css">
    <link rel="stylesheet" href="/main.css">
    <script src="https://kit.fontawesome.com/b4ad05c0d4.js" crossorigin="anonymous"></script>
    <style>
        main, section {
            min-height: calc(100vh - 14rem);
        }
        section {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        div {
            margin: 0!important;
        }
    </style>
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
        <div>
            <h1>Ordine #<?php echo($_order_id); ?></h1>
            <table>
                <tr>
                    <td>Data</td>
                    <td><?php echo($_date); ?></td>
                </tr>
                <tr>
                    <td>Totale</td>
                    <td><?php echo($_total); ?>€</td>
                </tr>
            </table>

            <h2>Dettagli ordine</h2>
            <table>
                <tr>
                    <th>Prodotto</th>
                    <th>Formato</th>
                    <th>Quantità</th>
                    <th>Prezzo</th>
                </tr>

                <?php
                $_conn = mysqli_connect($_dbhost, $_dbuser, $_dbpass, $_dbname);
                if (!$_conn) {
                    die("Connection failed: " . mysqli_connect_error());
                } else {
                    $_query = <<<EOF
                        SELECT ProductID, Format, Quantity, Price
                        FROM Prints
                        WHERE OrderID='$_order_id'
                    EOF;
                    $_result = mysqli_query($_conn, $_query);

                    if ($_result && mysqli_num_rows($_result) > 0) {
                        while ($_row = mysqli_fetch_row($_result)) {
                            echo("<tr>");
                            if ($_row[0] == 1) {
                                echo("<td>Foto singola</td>");
                            } else {
                                echo("<td>Foto di classe</td>");
                            }

                            echo("<td>" . $_row[1] . "</td>");
                            echo("<td>" . $_row[2] . "</td>");
                            echo("<td>" . $_row[3] . "€</td>");
                            echo("</tr>");
                        }
                    }
                    mysqli_close($_conn);
                }
                ?>
            </table>

        </div>
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
