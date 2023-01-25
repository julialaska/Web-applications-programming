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
// stworzenie zapytania w celu przypisania zmiennym danych z bazy
$query = "SELECT * FROM page_list WHERE id='$id'";
$result = mysqli_query($link, $query);

while($row = mysqli_fetch_array($result)){
    $page_title=($row['page_title']);
    $page_content=($row['page_content']);
    $status=($row['status']);
}

//  sprawdzenie czy formularz został wysłany
if(isset($_POST['edit_submit'])) {
// pobranie danych z formularza
    $page_title = $_POST['page_title'];
    $page_content = $_POST['page_content'];
    $status = $_POST['status'];

    // zapytanie SQL edytujące stronę o podanym id
    $query = "UPDATE page_list SET page_title='$page_title', page_content='$page_content', status='$status' WHERE id='$id' LIMIT 1";
    mysqli_query($link, $query) or die(mysqli_error($link));
    $message[] = 'Udana edycja';

//    wyświetlenie komunikatu za pomocą funkcji z pliku admin
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
<?php
include('../pages_header.html');
?>
<body>

<section class="dashboard">

    <h1 class="title">Edycja podstrony</h1>
    <a href="../admin_pages.php" class="white-btn">Wstecz</a>
    <div class="box-container">

        <div class="box">
            <form action="" method="post">
                <p style="size: 1rem">Tytuł podstrony:</p><br>
                <input type="text" name="page_title" id="page_title" value="<?php echo $page_title  ?>" required>

                <p style="size: 1rem">Treść podstrony:</p><br>
                <textarea name="page_content" id="page_content" value="<?php echo $page_content ?>"></textarea><br>

                <p style="size: 1rem">Aktywna</p><br>
                <input type="text" name="status" id="status" value="<?php echo $status ?>"><br>

                <input class="white-btn" type="submit" name="edit_submit" value="Zapisz">
            </form>
        </div>
    </div>
</section>
</body>
