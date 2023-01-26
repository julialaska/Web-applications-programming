<?php

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
        $message[] = 'Produkt znajduje się już w koszyku!';
    }else{
        mysqli_query($link, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'Dodano produkt!';
    }

}

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
    <title>Sklep</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
<?php include 'shop_header.php'?>

<div class="heading">
    <h3>Sklep</h3>
    <p><a href="?idp=main"></a></p>
</div>

<section class="products">

    <h1 class="title">Produkty</h1>

    <div class="box-container">

        <?php
        $select_products = mysqli_query($link, "SELECT * FROM `product_list`") or die('query failed');
        if(mysqli_num_rows($select_products) > 0){
            while($row = mysqli_fetch_assoc($select_products)){
                ?>
                <form action="" method="post" class="box">
                    <img class="image" src="../images/<?php echo $row['zdjecie']; ?>" alt="">
                    <div class="name"><?php echo $row['tytul']; ?></div>
                    <div class="price"><?php echo $row['cena_netto']; ?></div>
                    <input type="number" min="1" name="product_quantity" value="1" class="qty">
                    <input type="hidden" name="product_name" value="<?php echo $row['tytul']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['cena_netto']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $row['zdjecie']; ?>">
                    <input type="submit" value="Dodaj do koszyka" name="add_to_cart" class="btn">
                </form>
                <?php
            }
        }else{
            echo '<p class="empty">Nie dodano jeszcze żadnych produktów!</p>';
        }
        ?>
    </div>

</section>

<script src="js/script.js"></script>

<?php include "shop_footer.php";?>
</body>
</html>