<?php

include 'cfg.php';
include 'contact.php';
include 'admin/admin.php';

require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

include('cfg.php');

if (isset($_POST['email'])) {

    //pobieranie danych z formularza
    $email = $_POST['email'];


    // sprawdzenie czy podany mail jest równy mailowi z pliku cfg
    if ($email == $admin_email) {
        $pass = $admin_pass;

        //temat i wiadomosc
        $subject = "Przypomnienie hasła";
        $message = "Twoje hasło to: " . $pass;

        //wysyłamy email

        //instancja klasy PHPMailer
        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";
        //ustawienie mailera na SMTP
        $mail->isSMTP();
        //zdefiniowanie smtp hostu
        $mail->Host = "smtp.gmail.com";
        //autentykacja
        $mail->SMTPAuth = true;
        //zakodowanie (ssl/tls)
        $mail->SMTPSecure = "tls";
        //port do połączenia
        $mail->Port = "587";
        //ustawienie użytkownika
        $mail->Username = "julkalas101@gmail.com";
        //ustawienie hasła z gmaila
        $mail->Password = "************";
        //temat emaila
        $mail->Subject = "Przypomnienie hasło";
        //ustawienie wysyłającego
        $mail->setFrom($email);
        $mail->addAddress($email, 'Joe User');
        $mail->isHTML(true);

        //Email treść
        $subject = "Przypomnienie hasła";
        $message = "Twoje hasło to: " . $pass;
        $mail->Body = "<h1>" . $subject . "</h1></br><p>" . $message . "</p>";
        //dodanie odbiorcy
        $mail->addAddress('con');
        //wysłanie maila
        $mail->send();
        //zamknięcie polączenie smtp
        $mail->smtpClose();
    }
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt</title>
    <meta name="Author" content="Julia Łaska" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>

</head>
<header class="header">
    <div class="header-2">
        <div class="flex">
            <a href="?idp=main" class="logo"><img src="images/logo2.png" alt="logo"</a>

            <nav class="navbar">
                <a style="color: #1a1201" href="index.php?idp=main">Główna</a>
                <a style="color: #1a1201" href="index.php?idp=about">O nas</a>
                <a style="color: #1a1201" href="index.php?idp=bestsellers">Bestsellery</a>
                <a style="color: #1a1201" href="index.php?idp=recommend">Polecenia</a>
                <a style="color: #1a1201" href="index.php?idp=authors">Autorzy</a>
                <a style="color: #1a1201" href="index.php?idp=movies">Filmy</a>
                <a style="color: #1a1201" href="index.php?idp=contact">Kontakt</a>
            </nav>

            <div class="icons">
                <div id="user-btn" class="fas fa-user"></div>
                <?php
                $select_cart_number = mysqli_query($link, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_rows_number = mysqli_num_rows($select_cart_number);
                ?>
                <a href="admin/cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
                <a href="login.php">zaloguj</a> <a href="register.php">zarejestruj</a>
            </div>

            <div class="user-box">
                <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                <a href="logout.php" class="delete-btn">wyloguj</a>
            </div>
        </div>
    </div>

</header>
<body>
<div class="heading">
    <h3>Przypomnij hasło</h3>
</div>

<section class="contact">

    <form method="post" enctype="multipart/form-data">
        <h3>przypomnij haslo</h3>
        <input type="email" name="email" required placeholder="Email" class="box">
        <input type="submit" value="Wyślij wiadomosc" name="send" class="btn">
    </form>

</section>

</body>

<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>Kontakt</h3>
            <p> <i class="fas fa-envelope"></i> 162457@student.uwm.edu.pl </p>
            <p> <i class="fas fa-map-marker-alt"></i> UWM Olsztyn</p>
        </div>

        <div class="box">
            <h3>Śledź nas</h3>
            <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
            <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
        </div>
        <div class="box">
            <h3>  </h3>
            <a href="#"> <i style="margin-top: 20px" class="fab fa-instagram"></i> instagram </a>
            <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
        </div>
        <div class="box">
            <?php
            $nr_indeksu = '162457';
            $nr_grupy = '2';
            $imie_nazwisko = "Julia Łaska";

            //              echo "{$imie_nazwisko}, {$nr_indeksu}, grupa {$nr_grupy} <br/><br/>";
            ?>
            <h3><?php echo "{$imie_nazwisko}"?></h3>
            <p>Indeks: <?php echo "{$nr_indeksu}"?></p>
            <p>Grupa: <?php echo "{$nr_grupy}"?></p>
        </div>
    </div>

    <p class="copyright"> &copy; copyright  @ <?php echo date('Y'); ?> by <span>Julia Łaska</span> </p>

</section>
</html>
