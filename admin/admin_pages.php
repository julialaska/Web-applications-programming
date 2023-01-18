<?php

include '../cfg.php';
include 'admin.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($link, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strony</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">

</head>
<header class="header">

    <div class="flex">

        <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

        <nav class="navbar">
            <a style="color: khaki" href="admin_page.php">Główna</a>
            <a style="color: khaki" href="admin_users.php">Użytkownicy</a>
            <a style="color: khaki" href="admin_pages.php">Strony</a>
            <a style="color: khaki" href="admin_products.php">Produkty</a>
            <a style="color: khaki" href="admin_orders.php">Kategorie</a>
            <a style="color: khaki" href="admin_contacts.php">messages</a>
        </nav>

        <div>
            <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
            <a href="../logout.php" class="delete-btn">logout</a>
            <div>new <a href="login.php">login</a> | <a href="register.php">register</a></div>
        </div>

    </div>

</header>
<body>
<section class="dashboard">

    <h1 class="title">Strony</h1>

    <div class="box-container">
        <div class="box">
            <h2 style="font-size: 20px;color: khaki">Lista podstron</h2>
            <?php
            ListaPodstron();
            ?>
        </div>
        <div class="box">
            <h2 style="font-size: 20px;color: khaki">Edycja podstron</h2>
            <?php
            EdytujPodstrone();
            ?>
        </div>
        <div class="box">
            <h2 style="font-size: 20px;color: khaki">Dodanie podstron</h2>
            <?php
            DodajNowaPodstrone();
            ?>
        </div>
        <div class="box">
            <h2 style="font-size: 20px;color: khaki">Usuwanie podstron</h2>
            <?php
            UsunPodstrone();
            ?>
        </div>
    </div>

<script src="js/admin_script.js"></script>

</body>
</html>