<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

include 'cfg.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($link, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart!';
    }else{
        mysqli_query($link, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added to cart!';
    }

}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible"content="IE=edge,chrome=1" />
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="pl" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Book page </title>
    <meta name="Author" content="Julia Łaska" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <script src="js/timedate.js"></script>

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
<body onload="startclock()">

<section class="home">
   <div class="content">
       <video autoplay muted loop id="myVideo">
           <source src="images/book.mp4" type="video/mp4">
       </video>
      <h3>Nigdy nie przestawaj czytać!</h3>
      <p>Czytanie jest umiejętnością niezbędną we współczesnym świecie. Odgrywa znaczącą rolę we wszystkich fazach rozwoju człowieka. Osoby, które opanują tą umiejętność lepiej radzą sobie w życiu. Czytanie pozwala odnieść sukces nie tylko w szkole, ale także w dorosłym życiu.</p>
      <a href="copy/about.php" class="white-btn">Dowiedz się więcej</a>
   </div>

</section>
<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/o_nas.jpg" alt="">
      </div>

      <div class="content">
         <h3>O nas</h3>
          <p>Czytanie jest umiejętnością niezbędną we współczesnym świecie. Odgrywa znaczącą rolę we wszystkich fazach rozwoju człowieka. Osoby, które opanują tą umiejętność lepiej radzą sobie w życiu. Czytanie pozwala odnieść sukces nie tylko w szkole, ale także w dorosłym życiu.</p>
         <a href="copy/about.php" class="btn">Dowiedz się więcej</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>Masz jakieś pytania?</h3>
      <p>W przypadku wątpliwości zapraszamy do kontaktu, postaramy się wyjaśnić wszystkie niejasności</p>
      <a href="contact.php" class="white-btn">skontaktuj się z nami</a>
   </div>

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