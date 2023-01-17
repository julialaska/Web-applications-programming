<?php

include 'cfg.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"content="IE=edge,chrome=1" />
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="pl" />
    <title>Bestsellery</title>
    <meta name="Author" content="Julia Łaska" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>

</head>
<header class="header">
    <div class="header-2">
        <div class="flex">
            <a href="index.php" class="logo"><img src="images/logo2.png" alt="logo"</a>

            <nav class="navbar">
                <a style="color: #333333" href="index.php">Główna</a>
                <a style="color: #333333" href="copy/about.php">O nas</a>
                <a style="color: #333333" href="copy/bestsellers.php">Bestsellery</a>
                <a style="color: #333333" href="copy/recommend.php">Polecenia</a>
                <a style="color: #333333" href="copy/authors.php">Autorzy</a>
                <a style="color: #333333" href="copy/movies.php">Filmy</a>
                <a style="color: #333333" href="shop.php">Sklep</a>
                <a style="color: #333333" href="contact.php">Kontakt</a>
            </nav>

            <div class="icons">
                <div id="user-btn" class="fas fa-user"></div>
                <?php
                $select_cart_number = mysqli_query($link, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_rows_number = mysqli_num_rows($select_cart_number);
                ?>
                <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
                <a href="login.php">login</a> <a href="register.php">register</a>
            </div>

            <div class="user-box">
                <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                <a href="logout.php" class="delete-btn">logout</a>
            </div>
        </div>
    </div>

</header>
<body>

<div class="heading">
    <h3>Autorzy</h3>
</div>

<section class="about">

    <div class="flex">

        <div style="text-align: center" class="content">
            <h3>Najlepsi z najlepszych bez wątpienia</h3>
            <p>
                Czytanie może zwiększyć wydolność mózgu
                Częsta lektura wpływa nie tylko na poziom wiedzy, ale także na efektywność pracy mózgu.
                Działanie to można porównać do wpływu biegania na układ sercowo-naczyniowy: regularne czytanie
                poprawia kondycję komórek mózgowych, pozwala lepiej zapamiętywać. Z wiekiem mózg starzeje się,
                a sięganie po książkę może ten proces w naturalny sposób opóźnić, wskazują badania opublikowane
                w Neurology Huffington Post podaje,
                że czytanie może opóźnić zaburzenia umysłu nawet o 32 procent.
            </p>
        </div>

    </div>

</section>

<section class="authors">

    <h1 class="title">Słynni autorzy</h1>

    <div class="box-container">

        <div class="box">
            <img src="../images/brian.jfif" alt="">
            <h3>Brian Tracy</h3>
        </div>

        <div class="box">
            <img src="../images/thiel.jpg" alt="">
            <h3>Peter Thiel</h3>
        </div>

        <div class="box">
            <img src="../images/robert.png" alt="">
            <h3>Robert Kiyosaki</h3>
        </div>

        <div class="box">
            <img src="../images/dale.jpg" alt="">
            <h3>Dale Carnegie</h3>
        </div>

        <div class="box">
            <img src="../images/jordan.jpg" alt="">
            <h3>Jordan Peterson</h3>
        </div>

        <div class="box">
            <img src="../images/Chris.jpg" alt="">
            <h3>Chris Voss</h3>
        </div>

    </div>

</section>

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

</body>
</html>
