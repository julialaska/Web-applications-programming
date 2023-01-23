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
<?php
include('../pages_header.html');
?>
<body>

<section class="dashboard">

    <h1 class="title">Edycja podstrony</h1>

    <div class="box-container">

        <div class="box">
            <?php
                EdytujPodstrone();
                ?>
        </div>
    </div>

    <form action="" method="post">
        <label for="id">Wybierz podstronę:</label>
        <select name="id" id="id">
            <?php
            $query = "SELECT id, page_title FROM page_list";
            $result = mysqli_query($link, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value=" . $row['id']. ">" . $row['page_title'] . "</option>";
            }
            ?>
        </select>
    </form>
</section>
</body>
