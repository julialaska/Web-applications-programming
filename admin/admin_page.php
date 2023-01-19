<?php

include '../cfg.php';
include 'admin.php';

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
            <a style="color: khaki" href="admin_categories.php">Kategorie</a>
        </nav>

        <div>
            <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
            <a href="../logout.php" class="delete-btn">logout</a>
            <div>new <a href="../login.php">login</a> | <a href="../register.php">register</a></div>
        </div>

    </div>

</header>
<body>

<section class="dashboard">

    <h1 class="title">Panel główny</h1>

    <div class="box-container">

        <div class="box">
            <?php
            $select_products = mysqli_query($link, "SELECT * FROM `product_list`") or die('query failed');
            $number_of_products = mysqli_num_rows($select_products);
            ?>
            <h3><?php echo $number_of_products; ?></h3>
            <p>Produkty</p>
        </div>

        <div class="box">
            <?php
            $select_users = mysqli_query($link, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
            ?>
            <h3><?php echo $number_of_users; ?></h3>
            <p>Użytkownicy</p>
        </div>

        <div class="box">
            <?php
            $select_admins = mysqli_query($link, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
            $number_of_admins = mysqli_num_rows($select_admins);
            ?>
            <h3><?php echo $number_of_admins; ?></h3>
            <p>Admini</p>
        </div>

        <div class="box">
            <?php
            $select_account = mysqli_query($link, "SELECT * FROM `users`") or die('query failed');
            $number_of_account = mysqli_num_rows($select_account);
            ?>
            <h3><?php echo $number_of_account; ?></h3>
            <p>Konta</p>
        </div>

        <div class="box">
            <?php
            $select_messages = mysqli_query($link, "SELECT * FROM `message`") or die('query failed');
            $number_of_messages = mysqli_num_rows($select_messages);
            ?>
            <h3><?php echo $number_of_messages; ?></h3>
            <p>Wiadomości</p>
        </div>
        <div class="box">
            <?php
            $select_pages = mysqli_query($link, "SELECT * FROM `page_list`") or die('query failed');
            $number_of_pages = mysqli_num_rows($select_pages);
            ?>
            <h3><?php echo $number_of_pages; ?></h3>
            <p><a href="admin_pages.php">Strony</a></p>
        </div>



    </div>

</section>
<script src="js/admin_script.js"></script>
<script src="js/script.js"></script>
</body>
</html>
