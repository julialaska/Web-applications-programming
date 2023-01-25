<?php

include '../cfg.php';
include 'admin.php';
require_once 'classes/Product.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}

global $link;

$product = new Product($link);
$product->usunProdukt();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkty</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css"
            rel="stylesheet"
    />
</head>
<body>
<?php
include "admin_header.php";
?>
<h1 class="title text-dark">Produkty</h1>
<div class="container-sm">
    <a href="products/add_product.php"><button type="button" class="white-btn mb-3">Dodaj nowy produkt</button></a>
    <table  class="table  table-bordered border-dark align-middle text-center">
        <thead class="bg-light h-100">
        <tr style="font-size: 20px;color: chocolate;" class="table-warning">
            <th>Zdjęcie</th>
            <th>ID</th>
            <th>Tytuł</th>
            <th>Opis</th>
            <th>Data utworzenia</th>
            <th>Cena</th>
            <th>Ilość</th>
            <th>Status</th>
            <th>Edycja</th>
            <th>Usuwanie</th>
        </tr>
        </thead>
        <tbody class="text-center">
        <?php
        $query = "SELECT * FROM product_list LIMIT 30";
        $result = mysqli_query($link, $query);

        while($row = mysqli_fetch_array($result)) {
            $id_category = $row['id'] - 1;
            echo '<tr class="table-warning">';
            echo '<td><img width="50%" height="50%" class="image" src="../images/'.$row['zdjecie'].'"'.'/></td>';
            echo '<td><p style="font-size: 20px;">'. $row['id'] . '</p></td>';
            echo '<td><p style="font-size: 20px;" class="fw-normal mb-1">'. $row['tytul'] . '</p></td>';
            echo '<td><p style="font-size: 20px;" class="fw-normal mb-1">'. $row['opis'] . '</p></td>';
            echo '<td><p style="font-size: 20px;" class="fw-normal mb-1">'. $row['data_utworzenia'] . '</p></td>';
            echo '<td><p style="font-size: 20px;" class="fw-normal mb-1">'. $row['cena_netto'] . '</p></td>';
            echo '<td><p style="font-size: 20px;" class="fw-normal mb-1">'. $row['ilosc'] . '</p></td>';
            if($row['status_dostepnosci'] == 1){
                echo '<td><span style="font-size: 20px;color: green" >DOSTĘPNY</span></td>';
            }
            else
            {
                echo '<td><span style="font-size: 20px;color: red">NIEDOSTĘPNY</span></td>';
            }
            echo '<td><a class="option-btn" href="products/edit_product.php?edit='.$row['id'].'" >EDYTUJ</a></td>';
            echo '<td><a class="delete-btn" href="admin_products.php?delete='.$row['id'].'" onclick="return confirm(`Usunąć ten produkt?`);">USUŃ</a></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>

</div>
<script src="js/admin_script.js"></script>
</body>
</html>