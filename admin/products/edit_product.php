<?php

include '../cfg.php';
include '../admin.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:../login.php');
}
if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
}

$query = "SELECT * FROM product_list WHERE id='$id'";
$result = mysqli_query($link, $query);

while($row = mysqli_fetch_array($result)){
    $tytul=$row['tytul'];
    $opis=$row['opis'];
    $data_utworzenia=$row['data_utworzenia'];
    $data_modyfikacji=$row['data_modyfikacji'];
    $data_wygasniecia=$row['data_wygasniecia'];
    $cena_netto=$row['cena_netto'];
    $podatek_vat=$row['podatek_vat'];
    $ilosc=$row['ilosc'];
    $status_dostepnosci=$row['status_dostepnosci'];
    $kategoria=$row['kategoria'];
    $gabaryt=$row['gabaryt'];
    $zdjecie=$row['zdjecie'];
}

if(isset($_POST['edit_submit'])) {

    $tytul = mysqli_real_escape_string($link, $_POST['tytul']);
    $opis = $_POST['opis'];
    $data_utworzenia = $_POST['data_utworzenia'];
    $data_modyfikacji = $_POST['data_modyfikacji'];
    $data_wygasniecia = $_POST['data_wygasniecia'];
    $cena_netto = $_POST['cena_netto'];
    $podatek_vat = $_POST['podatek_vat'];
    $ilosc = $_POST['ilosc'];
    $status_dostepnosci = $_POST['status_dostepnosci'];
    $kategoria = $_POST['kategoria'];
    $gabaryt = $_POST['gabaryt'];
    $zdjecie = $_FILES['zdjecie']['name'];

// zapytanie SQL aktualizujące produkt
    mysqli_query($link, "UPDATE product_list SET tytul='$tytul', opis='$opis', data_utworzenia='$data_utworzenia', data_modyfikacji='$data_modyfikacji',
		data_wygasniecia='$data_wygasniecia', cena_netto='$cena_netto', podatek_vat='$podatek_vat', ilosc='$ilosc',
		status_dostepnosci='$status_dostepnosci', kategoria='$kategoria', gabaryt='$gabaryt' WHERE id='$id'");
        $message[] = 'Udana edycja';
        PokazKomunikat($message);
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
<body>
<?php
include "../pages_header.html";
?>
<section class="dashboard">

    <h1 class="title">Edycja produktu</h1>
    <a href="../admin_products.php" class="white-btn">Wstecz</a>
    <div class="box-container">

        <div class="box">
            <form action="" method="post" enctype="multipart/form-data">

                <p style="size: 1rem">Tytuł produktu:</p><br>
                <input type="text" name="tytul" id="tytul" value="<?php echo $tytul ?>">

                <p style="size: 1rem">Opis produktu:</p><br>
                <input type="textarea" name="opis" id="opis" value="<?php echo $opis ?>" required>>

                <p style="size: 1rem">Data utworzenia produktu:</p><br>
                <input type="date" name="data_utworzenia" id="data_utworzenia" value=<?php echo $data_utworzenia ?>>

                <p style="size: 1rem">Data modyfikacji produktu:</p><br>
                <input type="date" name="data_modyfikacji" id="data_modyfikacji" value=<?php echo $data_modyfikacji ?>>

                <p style="size: 1rem">Data wygasniecia produktu:</p><br>
                <input type="date" name="data_wygasniecia" id="data_wygasniecia" value=<?php echo $data_wygasniecia ?> >

                <p style="size: 1rem">Cena netto</p><br>
                <input type="text" name="cena_netto" id="cena_netto" value=<?php echo $cena_netto ?>><br>

                <p style="size: 1rem">Podatek VAT</p><br>
                <input type="text" name="podatek_vat" id="podatek_vat" value=<?php echo $podatek_vat ?>><br>

                <p style="size: 1rem">Ilość</p><br>
                <input type="text" name="ilosc" id="ilosc" value=<?php echo $ilosc ?>><br>

                <p style="size: 1rem">Status dostępnosci</p><br>
                <input type="text" name="status_dostepnosci" id="status_dostepnosci" value="<?php echo $status_dostepnosci ?>"><br>

<!--                <p style="size: 1rem">Kategoria</p><br>-->
<!--                <input type="text" name="kategoria" id="kategoria"><br>-->

                <p style="size: 1rem">Kategoria</p>
                <select name="kategoria">
                    <?php
                    include("../cfg.php");
                    $query = "SELECT * FROM category_list LIMIT 50";
                    $result = mysqli_query($link, $query);

                    while($row = mysqli_fetch_array($result))
                    {
                        if ($row['id'] == $kategoria){
                            echo "<option selected value='". $row[$kategoria] ."'>" .$row['nazwa'] ."</option>";
                        }
                        echo "<option value='". $row['id'] ."'>" .$row['nazwa'] ."</option>";
                    }
                    ?>
                </select>

                <p style="size: 1rem">Gabaryt</p><br>
                <input type="text" name="gabaryt" id="gabaryt"  value=<?php echo $gabaryt ?> ><br>

                <p style="size: 1rem">Zdjecie</p><br>
                <input type="file" name="zdjecie" id="zdjecie" value="<?php echo $zdjecie ?>"><br>

                <input class="white-btn" type="submit" name="edit_submit" value="Dodaj">
            </form>
        </div>
    </div>
</section>
</body>
