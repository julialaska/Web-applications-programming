<?php

class Product {
    private $link;

    public function __construct() {
        include("../cfg.php");
        $this->link = $link;
    }

    public function dodajProdukt() {

        if(isset($_POST['submit'])) {
// pobranie danych z formularza
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

            $tytul = mysqli_real_escape_string($this->link, $_POST['tytul']);
            $zdjecie = $_FILES['zdjecie']['tytul'];


            // sprzwadzenie czy której z pól nie pozostało puste
            if (empty($tytul) || empty($cena_netto)) {
                $message[] = 'Wszystkie pola są wymagane';
            } else {
                // zapytanie SQL dodające produkt
                $query = mysqli_query($this->link, "INSERT INTO product_list(id, tytul, opis, data_utworzenia, data_modyfikacji, data_wygasniecia, 
			cena_netto, podatek_vat, ilosc, status_dostepnosci, kategoria, gabaryt, zdjecie) 
			VALUES ('NULL', '$tytul', '$opis', '$data_utworzenia', '$data_modyfikacji', '$data_wygasniecia', 
			'$cena_netto', '$podatek_vat', '$ilosc', '$status_dostepnosci', '$kategoria', '$gabaryt', '$zdjecie');");

                $message[] = 'produkt dodany';

            }
            PokazKomunikat($message);
        }
    }

    public function usunProdukt(){
        if(isset($_GET['delete'])){
            $delete_id = $_GET['delete'];
            mysqli_query($this->link, "DELETE FROM `product_list` WHERE id = '$delete_id'") or die('query failed');
            header('location:admin_products.php');
        }
    }
}