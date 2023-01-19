<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php
    include 'admin/admin.php';
    FormularzLogowania();
?>
</body>
<?php

include 'cfg.php';

session_start();

// sprawdzenie czy został przesłany formularz logowania
if(isset($_POST['submit'])){

//   mysqli_real_escape_string jest to funkcja pozwalająca na zabezpieczenie ciągów znaków
// przed nieprawidłowymi znakami, przed atakami typu SQL injection
   $email = mysqli_real_escape_string($link, $_POST['email']);
   $pass = mysqli_real_escape_string($link, md5($_POST['password']));

//  pobranie danych z bazy dla podanego maila i hasła
   $select_users = mysqli_query($link, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);
// sprawdzenie typu użytkownika
      if($row['user_type'] == 'admin'){
// przypisanie danych do sesji i przekierowanie do panelu administracyjnego
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin/admin_page.php');

      }elseif($row['user_type'] == 'user'){
// przypisanie danych do sesji i przekierowanie do strony głównej
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:index.php?idp=main');

      }

   }else{
// ustawienie komunikatu o błędnym mailu lub haśle
      $message[] = 'niepoprawne dane logowania';
   }

}
else{

//  jeśli formularz nie został jeszcze wysłany, wywołanie funkcji z formularzem logowania
    echo FormularzLogowania();
}

// wyświetlenie wiadomości o błędzie, jeśli istnieje
if(isset($message)){
   foreach($message as $message){
      echo '
    <div
} class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
