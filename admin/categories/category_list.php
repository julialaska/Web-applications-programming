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
    <link rel="stylesheet" href="jquery.jstree.css">

</head>
<body>
<?php
include "../pages_header.html";
?>
<section class="dashboard">

    <h1 class="title">Wyświetlanie kategorii</h1>
    <a href="../admin_products.php" class="white-btn">Wstecz</a>
    <div class="box-container">
        <script src="jquery.js"></script>
        <script src="jquery.jstree.js"></script>
        <div class="box">
                <?php
                echo GenerujDrzewoKategorii();
                ?>
        </div>
        </div>
</section>


</body>
