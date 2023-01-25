<?php

include '../cfg.php';
include '../admin.php';
require_once '../classes/Page.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:../login.php');
}
global $link;

$page = new Page($link);
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
<?php
    include('../pages_header.html');
?>
<body>

<section class="dashboard">

    <h1 class="title">Dodawanie strony</h1>
    <a href="../admin_pages.php" class="white-btn">Wstecz</a>
    <div class="box-container">

        <div class="box">
            <form action="" method="post">

                <p style="size: 1rem">Tytuł podstrony:</p><br>
                <input type="text" name="page_title" id="page_title">

                <p style="size: 1rem">Treść podstrony:</p><br>
                <textarea name="page_content" id="page_content" required></textarea>

                <p style="size: 1rem">Aktywna</p><br>
                <input type="checkbox" name="status" id="status" value="1"><br>

                <input class="white-btn" type="submit" name="submit" value="Dodaj">
            </form>
            <?php
                $page->dodajStrone();
                ?>
        </div>
    </div>
</section>
</body>
