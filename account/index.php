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
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="/account/style.css">
    <link rel="stylesheet" href="/main.css">
    <script src="https://kit.fontawesome.com/b4ad05c0d4.js" crossorigin="anonymous"></script>
    <script>
        function enableEditing() {
            // Rendo i campi editabili
            document.getElementById("name").readOnly = false;
            document.getElementById("surname").readOnly = false;
            document.getElementById("mail").readOnly = false;
            document.getElementById("password").readOnly = false;
            document.getElementById("class").disabled = false;

            //Nascondo il pulsante Modifica e mostro i pulsanti Aggiorna, Annulla ed Elimina
            document.getElementById("editButton").style.display = 'none';
            document.getElementById("updateButton").style.display = 'inline';
            document.getElementById("cancelButton").style.display = 'inline';
            document.getElementById("deleteButton").style.display = 'inline';
        }

        function confermaEliminazione() {
            var conferma = confirm("Sei sicuro di voler cancellare?");
            if (conferma) {
                document.getElementById("deleteForm").submit();
            }
        }
    </script>
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
            <h1>I tuoi dati</h1>
            <form id="deleteForm" action="/account/update.php" method="post">
                <div>
                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user_name); ?>"
                           readonly>
                </div>
                <div>
                    <label for="surname">Cognome</label>
                    <input type="text" id="surname" name="surname"
                           value="<?php echo htmlspecialchars($user_surname); ?>" readonly>
                </div>
                <div>
                    <label for="class">Classe</label>
                    <select id="class" name="class" disabled>
                        <option value="" disabled>Prime</option>
                        <option value="1A" <?php if ($user_class == '1A') echo 'selected'; ?>>1A</option>
                        <option value="1B" <?php if ($user_class == '1B') echo 'selected'; ?>>1B</option>
                        <option value="1C" <?php if ($user_class == '1C') echo 'selected'; ?>>1C</option>
                        <option value="1D" <?php if ($user_class == '1D') echo 'selected'; ?>>1D</option>
                        <option value="1E" <?php if ($user_class == '1E') echo 'selected'; ?>>1E</option>
                        <option value="1F" <?php if ($user_class == '1F') echo 'selected'; ?>>1F</option>
                        <option value="1G" <?php if ($user_class == '1G') echo 'selected'; ?>>1G</option>

                        <option value="" disabled>Seconde</option>
                        <option value="2A" <?php if ($user_class == '2A') echo 'selected'; ?>>2A</option>
                        <option value="2B" <?php if ($user_class == '2B') echo 'selected'; ?>>2B</option>
                        <option value="2C" <?php if ($user_class == '2C') echo 'selected'; ?>>2C</option>
                        <option value="2D" <?php if ($user_class == '2D') echo 'selected'; ?>>2D</option>
                        <option value="2E" <?php if ($user_class == '2E') echo 'selected'; ?>>2E</option>
                        <option value="2F" <?php if ($user_class == '2F') echo 'selected'; ?>>2F</option>
                        <option value="2G" <?php if ($user_class == '2G') echo 'selected'; ?>>2G</option>

                        <option value="" disabled>Terze</option>
                        <option value="3A" <?php if ($user_class == '3A') echo 'selected'; ?>>3A</option>
                        <option value="3B" <?php if ($user_class == '3B') echo 'selected'; ?>>3B</option>
                        <option value="3C" <?php if ($user_class == '3C') echo 'selected'; ?>>3C</option>
                        <option value="3D" <?php if ($user_class == '3D') echo 'selected'; ?>>3D</option>
                        <option value="3E" <?php if ($user_class == '3E') echo 'selected'; ?>>3E</option>
                        <option value="3F" <?php if ($user_class == '3F') echo 'selected'; ?>>3F</option>
                        <option value="3G" <?php if ($user_class == '3G') echo 'selected'; ?>>3G</option>

                        <option value="" disabled>Quarte</option>
                        <option value="4A" <?php if ($user_class == '4A') echo 'selected'; ?>>4A</option>
                        <option value="4B" <?php if ($user_class == '4B') echo 'selected'; ?>>4B</option>
                        <option value="4C" <?php if ($user_class == '4C') echo 'selected'; ?>>4C</option>
                        <option value="4D" <?php if ($user_class == '4D') echo 'selected'; ?>>4D</option>
                        <option value="4E" <?php if ($user_class == '4E') echo 'selected'; ?>>4E</option>
                        <option value="4F" <?php if ($user_class == '4F') echo 'selected'; ?>>4F</option>
                        <option value="4G" <?php if ($user_class == '4G') echo 'selected'; ?>>4G</option>

                        <option value="" disabled>Quinte</option>
                        <option value="5A" <?php if ($user_class == '5A') echo 'selected'; ?>>5A</option>
                        <option value="5B" <?php if ($user_class == '5B') echo 'selected'; ?>>5B</option>
                        <option value="5C" <?php if ($user_class == '5C') echo 'selected'; ?>>5C</option>
                        <option value="5D" <?php if ($user_class == '5D') echo 'selected'; ?>>5D</option>
                        <option value="5E" <?php if ($user_class == '5E') echo 'selected'; ?>>5E</option>
                        <option value="5F" <?php if ($user_class == '5F') echo 'selected'; ?>>5F</option>
                        <option value="5G" <?php if ($user_class == '5G') echo 'selected'; ?>>5G</option>
                    </select>

                </div>
                <div>
                    <label for="mail">Email</label>
                    <input type="email" id="mail" name="mail" value="<?php echo htmlspecialchars($user_mail); ?>"
                           readonly>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                           value="<?php echo htmlspecialchars($user_password); ?>" readonly>
                </div>
                <div>
                    <input type="hidden" name="button" value="delete">
                    <button type="button" id="editButton" onclick="enableEditing()">Modifica</button>
                    <button type="submit" name="button" id="updateButton" value="update" style="display:none;">
                        Aggiorna
                    </button>
                    <a href="index.php">
                        <button type="button" id="cancelButton" style="display:none;">Annulla</button>
                    </a>
                    <button type="button" name="button" id="deleteButton" style="display:none;"
                            onclick="confermaEliminazione()">Elimina account
                    </button>
                </div>
            </form>
        </div>
    </section>
    <section>
        <!--        my orders -->
        <div>
            <h1>I tuoi ordini</h1>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Data</th>
                    <th>Dettagli</th>
                </tr>
                <?php
                $_conn = mysqli_connect($_dbhost, $_dbuser, $_dbpass, $_dbname);
                if (!$_conn) {
                    die("Connection failed: " . mysqli_connect_error());
                } else {
                    $_query = <<<EOF
                        SELECT * 
                        FROM Orders 
                        WHERE Student='$_user_id'
                    EOF;
                    $_result = mysqli_query($_conn, $_query);
                    if ($_result && mysqli_num_rows($_result) > 0) {
                        while ($_row = mysqli_fetch_row($_result)) {
                            echo "<tr>";
                            echo "<td>$_row[0]</td>";
                            echo "<td>$_row[1]</td>";
                            echo "<td><a href='/HighSchoolPrints/account/orderDetails.php?order_id=$_row[0]'>Dettagli</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Nessun ordine effettuato</td></tr>";
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
