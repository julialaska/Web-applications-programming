<?php

include '../cfg.php';
include '../admin.php';
require_once '../classes/Category.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:../login.php');
}
global $link;

$category = new Category($link);

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
<body>
<?php
include "../pages_header.html";
?>
<section class="dashboard">

    <h1 class="title">Dodawanie kategorii</h1>
    <a href="../admin_categories.php" class="white-btn">Wstecz</a>
    <div class="box-container">

        <div class="box">
            <form action="" method="post">

                <p style="size: 1rem">Nazwa kategorii/podkategorii:</p><br>
                <input type="text" name="nazwa" id="nazwa">

                <p style="size: 1rem">ID matki podkategorii</p><br>
                <input type="text" name="matka" id="matka" value="1"><br>

                <input class="white-btn" type="submit" name="submit" value="Dodaj">
            </form>

            <?php
            echo $category->dodajKategorie();
            ?>
        </div>
    </div>
</section>
</body>
