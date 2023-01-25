<?php

include '../cfg.php';
include '../admin.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:../login.php');
}
// sprawdzenie czy została ustawiona zmienna GET i przypisanie jej do pola id
if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
}

$query = "SELECT * FROM category_list WHERE id='$id'";
$result = mysqli_query($link, $query);

while($row = mysqli_fetch_array($result)){
    $matka=$row['matka'];
    $nazwa=$row['nazwa'];

}

//  sprawdzenie czy formularz został wysłany
if(isset($_POST['edit_submit'])) {
// pobranie danych z formularza
    $matka = $_POST['matka'];
    $nazwa = $_POST['nazwa'];

    // zapytanie SQL edytujące stronę o podanym id
    $query = "UPDATE category_list SET nazwa='$nazwa', matka='$matka' WHERE id='$id' LIMIT 1";
    mysqli_query($link, $query) or die(mysqli_error($link));
    $message[] = 'Udana edycja';

// wyświetlenie wiadomości jeśli została ustawiona
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

    <h1 class="title">Edycja kategorii</h1>
    <a href="../admin_categories.php" class="white-btn">Wstecz</a>
    <div class="box-container">

        <div class="box">
            <form action="" method="post">
                <p style="size: 1rem">Nazwa kategorii:</p><br>
                <input type="text" name="nazwa" id="nazwa" value=<?php echo $nazwa ?> required>

                <p style="size: 1rem">Matka podkategorii:</p><br>
                <input type="text" name="matka" id="matka" value=<?php echo $matka ?>><br>

                <input class="white-btn" type="submit" name="edit_submit" value="Zapisz">
            </form>
        </div>
    </div>
</section>

</body>
