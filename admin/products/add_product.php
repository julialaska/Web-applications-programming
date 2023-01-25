<?php

include '../cfg.php';
include '../admin.php';
require_once '../classes/Product.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:../login.php');
}
global $link;

$product = new Product($link);

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

    <h1 class="title">Dodawanie produktu</h1>
    <a href="../admin_categories.php" class="white-btn">Wstecz</a>
    <div class="box-container">

        <div class="box">
            <form action="" method="post" enctype="multipart/form-data">

                <p style="size: 1rem">Tytuł produktu:</p><br>
                <input type="text" name="tytul" id="tytul">

                <p style="size: 1rem">Opis produktu:</p><br>
                <input type="textarea" name="opis" id="opis">

                <p style="size: 1rem">Data utworzenia produktu:</p><br>
                <input type="datetime-local" name="data_utworzenia" id="data_utworzenia">

                <p style="size: 1rem">Data modyfikacji produktu:</p><br>
                <input type="date" name="data_modyfikacji" id="data_modyfikacji">

                <p style="size: 1rem">Data wygasniecia produktu:</p><br>
                <input type="date" name="data_wygasniecia" id="data_wygasniecia">

                <p style="size: 1rem">Cena netto</p><br>
                <input type="text" name="cena_netto" id="cena_netto"><br>

                <p style="size: 1rem">Podatek VAT</p><br>
                <input type="text" name="podatek_vat" id="podatek_vat"><br>

                <p style="size: 1rem">Ilość</p><br>
                <input type="text" name="ilosc" id="ilosc"><br>

                <p style="size: 1rem">Status dostępnosci</p><br>
                <input type="text" name="status_dostepnosci" id="status_dostepnosci"><br>

<!--                <p style="size: 1rem">Kategoria</p><br>-->
<!--                <input type="text" name="kategoria" id="kategoria"><br>-->

                <p style="size: 1rem" for="kategoria">Kategoria</p>
                <select name="kategoria"  id="kategoria" required>
                    <option>Wybierz kategorie</option>
                    <?php
                    include("../cfg.php");
                    $query = "SELECT * FROM category_list LIMIT 50";
                    $result = mysqli_query($link, $query);

                    while($row = mysqli_fetch_array($result))
                    {
                        echo "<option value='". $row['id'] ."'>" .$row['nazwa'] ."</option>";
                    }
                    ?>
                </select>

                <p style="size: 1rem">Gabaryt</p><br>
                <input type="text" name="gabaryt" id="gabaryt"><br>

                <p style="size: 1rem">Zdjecie</p><br>
                <input type="file" name="zdjecie" id="zdjecie" accept="zdjecie/jpg, zdjecie/jpeg, zdjecie/png"><br>

                <input class="white-btn" type="submit" name="submit" value="Dodaj">
            </form>
            <?php
             echo $product->dodajProdukt();
            ?>
        </div>
    </div>
</section>
</body>
