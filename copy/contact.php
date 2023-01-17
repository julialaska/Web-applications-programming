<?php

include 'cfg.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($link, $_POST['name']);
   $email = mysqli_real_escape_string($link, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($link, $_POST['message']);

   $select_message = mysqli_query($link, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'message sent already!';
   }else{
      mysqli_query($link, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'message sent successfully!';
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
   <link rel="stylesheet" href="../css/style.css">
   <script src="../js/script.js"></script>

</head>
<header class="header">
    <div class="header-2">
        <div class="flex">
            <a href="../index.php" class="logo"><img src="../images/logo2.png" alt="logo"</a>

            <nav class="navbar">
                <a style="color: #333333" href="../index.php">Główna</a>
                <a style="color: #333333" href="about.php">O nas</a>
                <a style="color: #333333" href="bestsellers.php">Bestsellery</a>
                <a style="color: #333333" href="recommend.php">Polecenia</a>
                <a style="color: #333333" href="authors.php">Autorzy</a>
                <a style="color: #333333" href="movies.php">Filmy</a>
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
                <a href="../login.php">login</a> <a href="../register.php">register</a>
            </div>

            <div class="user-box">
                <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                <a href="../logout.php" class="delete-btn">logout</a>
            </div>
        </div>
    </div>

</header>
<body>

<div class="heading">
   <h3>Skontaktuj się z nami</h3>
</div>

<section class="contact">

   <form action="mailto:162456@student.uwm.edu.pl" method="post" enctype="text/plain">
      <h3>Napisz do nas</h3>
      <input type="text" name="name" required placeholder="Imię" class="box">
      <input type="email" name="email" required placeholder="Email" class="box">
      <input type="number" name="number" required placeholder="Numer" class="box">
      <textarea name="message" class="box" placeholder="Wiadomosc" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="Wyślij wiadomosc" name="send" class="btn">
   </form>

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