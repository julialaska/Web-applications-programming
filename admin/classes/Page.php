<?php

class Page {
    private $link;

    public function __construct() {
        include("../cfg.php");
        $this->link = $link;
    }

    public function dodajStrone(){

        if(isset($_POST['submit'])) {
// pobranie danych z formularza
            $page_title = $_POST['page_title'];
            $page_content = $_POST['page_content'];
            $status = $_POST['status'] ?? 0;

// sprzwadzenie czy której z pól nie pozostało puste
            if(empty($page_title) || empty($page_content) || !is_numeric($status)){
                $message[] = 'Wszystkie pola są wymagane';
            }
            else {
// zapytanie SQL dodające stronę
                $query = "INSERT INTO page_list SET id=NULL, page_title = '$page_title', page_content = '$page_content', status = '$status'";
                mysqli_query($this->link, $query) or die(mysqli_error($link));
                $message[] = 'Udane dodawanie strony';
            }
            PokazKomunikat($message);
        }
    }

    public function usunStrone(){
        if(isset($_GET['delete'])){
            $id = $_GET['delete'];
//  sprawdzenie, czy rekord o danym id istnieje w bazie danych
            $query = "SELECT * FROM page_list WHERE id = '$id'";
            $result = mysqli_query($this->link, $query);
//  sprawdzenie liczby wyników, jeśli ich liczba jest większa niż zero, rekord istnieje i zostaje usunięty z bazy
            if (mysqli_num_rows($result) <= 0) {
                $message[] = 'Strona o podanym id nie istnieje';
            }
            else {
                $query = "DELETE FROM page_list WHERE id = '$id'";
                mysqli_query($this->link, $query);
// po usunięciu link przekierowujący z powrotem na podgląd podstron
                header('location:admin_pages.php');
                $message[] = 'Udane usuwanie';
            }
            PokazKomunikat($message);
        }
    }
}