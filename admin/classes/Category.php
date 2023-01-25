<?php

class Category {
    private $link;

    public function __construct() {
        include("../cfg.php");
        $this->link = $link;
    }

    public function dodajKategorie(){
        if(isset($_POST['submit'])) {
// pobranie danych z formularza
            $nazwa = $_POST['nazwa'];
            $matka = $_POST['matka'];

// sprzwadzenie czy któreś z pól nie pozostało puste
            if(empty($nazwa)){
                $message[] = 'Wszystkie pola są wymagane';
            }
            else {
// zapytanie SQL dodające kategorie
                $query = "INSERT INTO category_list SET id=NULL, nazwa = '$nazwa', matka = '$matka'";
                mysqli_query($this->link, $query) or die(mysqli_error($link));
                $message[] = 'Kategoria została dodana';
            }
            PokazKomunikat($message);
        }
        $_POST['id'] = null;
        $_POST['nazwa'] = null;
        $_POST['matka'] = null;

    }

    public function usunKategorie(){
        if(isset($_GET['delete'])){
            $id = $_GET['delete'];
//  sprawdzenie, czy rekord o danym id istnieje w bazie danych
            $query = "SELECT * FROM category_list WHERE id = '$id'";
            $result = mysqli_query($this->link, $query);
//  sprawdzenie liczby wyników, jeśli ich liczba jest większa niż zero, rekord istnieje i zostaje usunięty z bazy
            if (mysqli_num_rows($result) <= 0) {
                $message[] = 'Kategoria o podanym id nie istnieje';
            }
            else {
                $query = "DELETE FROM category_list WHERE id = '$id'";
                mysqli_query($this->link, $query);
// po usunięciu link przekierowujący z powrotem na podgląd podstron
                header('location:admin_categories.php');
                $message[] = 'Udane usuwanie';
            }
            PokazKomunikat($message);
        }
    }

    public function edytujKategorie(){
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
    }

}