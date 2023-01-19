<?php

include '../cfg.php';
include '../admin.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:../login.php');
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/admin_style.css">

</head>
<header class="header">

    <div class="flex">

        <a href="../admin_page.php" class="logo">Admin<span>Panel</span></a>

        <nav class="navbar">
            <a style="color: khaki" href="../admin_page.php">Główna</a>
            <a style="color: khaki" href="../admin_users.php">Użytkownicy</a>
            <a style="color: khaki" href="../admin_pages.php">Strony</a>
            <a style="color: khaki" href="../admin_products.php">Produkty</a>
            <a style="color: khaki" href="../admin_categories.php">Kategorie</a>
        </nav>

        <br>
        <div>
            <p>username : <?php echo $_SESSION['admin_name']; ?></p>
            <p>email : <?php echo $_SESSION['admin_email']; ?></p>
            <a href="../../logout.php" class="delete-btn">Wyloguj</a>
            <div>new <a href="../../login.php">login</a> | <a href="../../register.php">register</a></div>
        </div>

    </div>

    </div>

</header>
<body>
<section class="show-products">

    <div class="box-container">
        <?php
            PokazProdukty();
        ?>

    </div>

</section>

</body>
