<?php

include '../cfg.php';
include 'admin.php';
require_once 'classes/Category.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}
global $link;

$product = new Category($link);
$product->usunKategorie();

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategorie</title>
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
<h1 class="title text-dark">Kategorie</h1>
<div class="container-sm">
    <a href="categories/add_category.php"><button type="button" class="white-btn mb-3">Dodaj nową kategorię</button></a>
    <a href="categories/category_list.php"><button type="button" class="white-btn mb-3">Lista kategorii</button></a>
    <table  class="table  table-bordered border-dark align-middle text-center">
        <thead class="bg-light h-100">
        <tr style="font-size: 20px;color: chocolate;" class="table-warning">
            <th>ID</th>
            <th>Nazwa kategorii</th>
            <th>Matka kategorii</th>
            <th>Edycja</th>
            <th>Usuwanie</th>
        </tr>
        </thead>
        <tbody class="text-center">
        <?php
        $query = "SELECT * FROM category_list LIMIT 30";
        $result = mysqli_query($link, $query);

        while($row = mysqli_fetch_array($result)) {
            $id_category = $row['id'] - 1;
            echo '<tr class="table-warning">';
            echo '<td><p style="font-size: 20px;">'. $row['id'] . '</p></td>';
            echo '<td><p style="font-size: 20px;" class="fw-normal mb-1">'. $row['nazwa'] . '</p></td>';
            echo '<td><p style="font-size: 20px;" class="fw-normal mb-1">' . $row['matka'] . '</p></td>';
            echo '<td><a class="option-btn" href="categories/edit_category.php?edit='.$row['id'].'" >EDYTUJ</a></td>';
            echo '<td><a class="delete-btn" href="admin_categories.php?delete='.$row['id'].'" onclick="return confirm(`Usunąć tę kategorię?`);">USUŃ</a></td>';
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