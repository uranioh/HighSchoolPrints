<?php
session_start();
$_nome = $_POST['name'];
$_cognome = $_POST['surname'];
$_mail = $_POST['email'];
$_password = $_POST['password'];
$_classe = $_POST['class'];

$_dbuser = "root";
$_dbpass = "root";
$_dbhost = "localhost";
$_dbname = "HSPrintsDB";
$_conn = mysqli_connect($_dbhost, $_dbuser, $_dbpass, $_dbname);
if(!$_conn){
    die("Connection failed: " . mysqli_connect_error());
}
$_query = <<<EOF
    SELECT * 
    FROM Students 
    WHERE Mail='$_mail'
EOF;
$_result = mysqli_query($_conn, $_query);

if(mysqli_num_rows($_result) > 0){
    echo "Email già registrata. Per favore, usa un'email diversa.";
}
else {
    $_query = <<<EOF
        INSERT INTO Students(Fname, LName, Mail, Password, Class)
        VALUES ('$_nome', '$_cognome', '$_mail', '$_password', '$_classe');
    EOF;
    if(mysqli_query($_conn, $_query)){
        echo "
        <script type='text/javascript'>
            alert('Registrazione completata con successo.');
        </script>
        ";
        header("Location: /HighSchoolPrints/index.html");
    } else {
        echo "Errore: " . $_query . "<br>" . mysqli_error($_conn);
    }

    mysqli_close($_conn);
}
