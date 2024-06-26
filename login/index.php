<?php
$next = $_GET['next'] ?? "account";
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/b4ad05c0d4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>
<!-- main -->
<main>
    <section id="bgimage">
        <img src="../img/formbg.jpg" alt="Background image">
    </section>
    <section id="logo">
        <img src="../img/logo.png" alt="Logo">
    </section>

    <a href="../index.html" id="back">
        <i class="fa-regular fa-circle-left"></i>
        <span>Torna alla home</span>
    </a>

    <section id="login">
        <div>
            <h1>LOGIN</h1>
<!--            <p> Next: --><?php //echo htmlspecialchars($next); ?><!--</p>-->
            <form action="/login/login.php" method="post">

                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <input type="hidden" name="next" value="<?php echo htmlspecialchars($next); ?>">

                <button type="submit">Accedi</button>
            </form>
            <p>Non hai un account? <a href="../signup/">Registrati</a></p>
        </div>
    </section>
</main>
</body>
</html>