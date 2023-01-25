<?php

include 'cfg.php';

session_start();

$user_id = $_SESSION['user_id'];
// jeżeli zmienna user_id nie jest ustawiona, tzn użytkownik nie jest zalogowany
if(!isset($user_id)){
    // nastąpi przekierowanie do strony z logowaniem
    header('location:login.php');
}
// sprawdzenie czy formularz z update_cart został przesłany
if(isset($_POST['update_cart'])){
    // pobranie danych z formularza
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    // zaktualizowanie ilości produktu w koszyku w bazie danych
    mysqli_query($link, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
    // wysłanie komunikatu o aktualizacji
    $message[] = 'Zaktualizowano ilość produktu!';
}
// sprawdzanie, czy formularz z delete(dla jednego produktu) został przesłany
if(isset($_GET['delete'])){
    // pobranie ID produktu do usunięcia
    $delete_id = $_GET['delete'];
    // usuwanie produktu z koszyka w bazie danych
    mysqli_query($link, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    // przekierowanie do strony koszyka
    header('location:cart.php');
}
// sprawdzanie, czy formularz z delete_all(usuń wszystkie produkty) został przesłany
if(isset($_GET['delete_all'])){
    // usuwanie wszystkich produktów z koszyka dla danego użytkownika w bazie danych
    mysqli_query($link, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    // przekierowanie do strony koszyka
    header('location:cart.php');
}
// sprawdzanie, czy została ustawiona zmienna message, po czym wyświetlenie wiadomości
if(isset($message)){
    foreach($message as $message){
        echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include 'shop_header.php'?>

<div class="heading">
    <h3>Koszyk zakupowy</h3>
</div>

<section class="shopping-cart">

    <h1 class="title">Dodane produkty</h1>

    <div class="box-container">
        <?php
        $total_sum = 0;
        // pobranie danych produktów z koszyka z bazy danych
        $select_cart = mysqli_query($link, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        // sprawdzenie czy w koszyku są jakieś produkty
        if(mysqli_num_rows($select_cart) > 0){
            // pętla wyświetlająca informacje o produktach z koszyka
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                ?>
                <div class="box">
                    <!-- usunięcie produktu z koszyka z danym id z wyświetlanym zapytaniem -->
                    <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Usunąć produkt z koszyka?');"></a>
                    <!-- wyświetlenie zdjęcia produktu -->
                    <img src="../images/<?php echo $fetch_cart['image']; ?>" alt="">
                    <!-- wyświetlanie nazwy produktu -->
                    <div class="name"><?php echo $fetch_cart['name']; ?></div>
                    <!-- wyświetlanie ceny produktu -->
                    <div class="price"><?php echo $fetch_cart['price']; ?>PLN</div>
                    <!-- formularz do aktualizacji ilości produktów w koszyku -->
                    <form action="" method="post">
                        <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                        <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                        <input type="submit" name="update_cart" value="Aktualizuj" class="option-btn">
                    </form>
                    <!-- wyświetlenie sumy ceny produktów w koszyku razy wybrana ilość -->
                    <div class="sub-total"> Suma produktu : <span><?php echo $product_sum = ($fetch_cart['quantity'] * $fetch_cart['price']); ?>PLN</span> </div>
                </div>
                <?php
                // zsumowanie sum cen produktów
                $total_sum += $product_sum;
            }
        }else{
            // wyswietlenie komunikatu o pustym koszyku
            echo '<p class="empty">Twój koszyk jest pusty</p>';
        }
        ?>
    </div>
<!-- przycisk usuwający wszystkie produkty z koszyka, jeżeli koszyk jest pusty przycik nie bedzie widoczny-->
    <div style="margin-top: 2rem; text-align:center;">
        <a href="cart.php?delete_all" class="delete-btn <?php echo ($total_sum > 1)?'':'disabled'; ?>" onclick="return confirm('Czy chcesz usunąć wszystkie produkty z koszyka?');">Usuń wszystko</a>
    </div>

    <div class="cart-total">
        <p>Suma : <span><?php echo $total_sum; ?>PLN</span></p>
        <div class="flex">
            <a href="shop.php" class="option-btn">Kontynuuj zakupy</a>
<!--            opcja przejścia do płatności -->
            <a href="checkout.php" class="btn <?php echo ($total_sum > 1)?'':'disabled'; ?>">Przejdź do płatności</a>
        </div>
    </div>

</section>

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