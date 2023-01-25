<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

include('showpage.php');
include('admin/admin.php');
include 'cfg.php';


session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}


if($_GET['idp'] == 'main' or '') $page = 1;
if($_GET['idp'] == 'about') $page = 2;
if($_GET['idp'] == 'bestsellers') $page = 3;
if($_GET['idp'] == 'recommend') $page = 4;
if($_GET['idp'] == 'authors') $page = 5;
if($_GET['idp'] == 'movies') $page = 6;
if($_GET['idp'] == 'contact') $page = 7;
if($_GET['idp'] == 'shop') $page = 8;

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"content="IE=edge,chrome=1" />
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="pl" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Book page </title>
    <meta name="Author" content="Julia Łaska" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <script src="js/timedate.js"></script>
</head>
<header class="header">
    <div class="header-2">
        <div class="flex">
            <a href="?idp=main" class="logo"><img src="images/logo2.png" alt="logo"</a>

            <nav class="navbar">
                <a style="color: #1a1201" href="?idp=main">Główna</a>
                <a style="color: #1a1201" href="?idp=about">O nas</a>
                <a style="color: #1a1201" href="?idp=bestsellers">Bestsellery</a>
                <a style="color: #1a1201" href="?idp=recommend">Polecenia</a>
                <a style="color: #1a1201" href="?idp=authors">Autorzy</a>
                <a style="color: #1a1201" href="?idp=movies">Filmy</a>
                <a style="color: #1a1201" href="admin/shop.php">Sklep</a>
                <a style="color: #1a1201" href="?idp=contact">Kontakt</a>
            </nav>

            <div class="icons">
                <div id="user-btn" class="fas fa-user"></div>
                <?php
                $select_cart_number = mysqli_query($link, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_rows_number = mysqli_num_rows($select_cart_number);
                ?>
                <a href="admin/cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
                <a href="login.php">zaloguj</a> <a href="register.php">zarejestruj</a>
                <a class="fa fa-comment" href="contact_page.php"></a>
            </div>

            <div class="user-box">
                <p>Nazwa użytkownika : <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                <a href="logout.php" class="delete-btn">Wyloguj</a>
            </div>
        </div>
    </div>

</header>
<body onload="startclock()">

<?php

PokazPodstrone($page, $link);

?>
<script src="js/script.js"></script>
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
            <h3 style="padding-bottom: 5px">
                <div id="zegarek"></div>
                <div id="data"></div>
            </h3>
            <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
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