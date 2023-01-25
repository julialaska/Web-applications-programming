<?php
include('cfg.php');

//funkcja wyświetlająca komunikat jeżeli zmienna message została ustawiona
function PokazKomunikat($message){
    if(isset($message)){
        foreach($message as $message){
            echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
        }
    }
}

// funkcja zwracająca formularz logowania
function FormularzLogowania(){
        return '
        <div class="form-container">

           <form action="" method="post">
              <h3>Zaloguj się</h3>
              <input type="email" name="email" placeholder="Email" required class="box">
              <input type="password" name="password" placeholder="Hasło" required class="box">
              <input type="submit" name="submit" value="login now" class="btn">
              <p>Nie masz konta? <a href="register.php">Zarejestruj się</a></p>
              <p>Nie pamiętasz hasła? <a href="remind.php">Przypomnij</a></p>
           </form>

        </div>
        ';
}

function ListaPodstron(){
    include('cfg.php');

// pobranie wszystkich danych z tabeli page_list oraz wykonanie zapytania do bazy
    $query = " SELECT * FROM page_list ";
    $result = mysqli_query($link, $query);

// "przejście" po każdym wierszu, pobranie danych jako tablice asocjacyjną oraz wyświetlenie id i tytułu strony
    while ($row = mysqli_fetch_array($result)) {
        echo '<p style="size: 1rem">'.$row['id'].' '.$row['page_title'].'<br />'.'</p>';
    }
}

// funkcja zwracajaca formularz edycji podstrony
function EdytujPodstrone(){
    include('cfg.php');

//  sprawdzenie czy formularz został wysłany
    if(isset($_POST['submit'])) {
// pobranie danych z formularza
        $id = $_POST['id'];
        $page_title = $_POST['page_title'];
        $page_content = $_POST['page_content'];
        $status = isset($_POST['status']) ? $_POST['status'] : 0;

        if(empty($page_title) || empty($page_content) || !is_numeric($status)){
            $message[] = 'Wszystkie pola są wymagane';
        }
        else{
            // zapytanie SQL edytujące stronę o podanym id
            $query = "UPDATE page_list SET page_title='$page_title', page_content='$page_content', status='$status' WHERE id='$id' LIMIT 1";
            mysqli_query($link, $query) or die(mysqli_error($link));
            $message[] = 'Udana edycja';
        }
        PokazKomunikat($message);
    }
    $_POST['id'] = null;
    $_POST['page_content'] = null;
    $_POST['page_title'] = null;
    $_POST['status'] = null;
    $_POST['submit'] = null;

        echo $form;
}

// funkcja mająca za zadanie dodać nową podstronę
function DodajNowaPodstrone(): void
{
    include('cfg.php');

    $form = '
    <form action="" method="post">

        <p style="size: 1rem">Tytuł podstrony:</p><br>
        <input type="text" name="page_title" id="page_title">

        <p style="size: 1rem">Treść podstrony:</p><br>
        <textarea name="page_content" id="page_content" required></textarea>

        <p style="size: 1rem">Aktywna</p><br>
        <input type="checkbox" name="status" id="status" value="1"><br>

        <input class="white-btn" type="submit" name="submit" value="Dodaj">
    </form>
    ';

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
// zapytanie SQL dodający stronę
            $query = "INSERT INTO page_list SET id=NULL, page_title = '$page_title', page_content = '$page_content', status = '$status'";
            mysqli_query($link, $query) or die(mysqli_error($link));
            $message[] = 'Udane dodawanie strony';
        }
        PokazKomunikat($message);
    }
    $_POST['id'] = null;
    $_POST['page_content'] = null;
    $_POST['page_title'] = null;
    $_POST['status'] = null;

    echo $form;

}

// funkcja usuwająca podstronę o podanym id
function UsunPodstrone() {
    include "cfg.php";


// sprawdzenie czy formularz został wysłany
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];

//  sprawdzenie, czy rekord o danym id istnieje w bazie danych
        $query = "SELECT * FROM page_list WHERE id = '$id'";
        $result = mysqli_query($link, $query);
//  sprawdzenie liczby wyników, jeśli ich liczba jest większa niż zero, rekord istnieje i zostaje usunięty z bazy
        if (mysqli_num_rows($result) <= 0) {
            $message[] = 'Strona o podanym id nie istnieje';
        }
        else {

            $query = "DELETE FROM page_list WHERE id = '$id'";
            mysqli_query($link, $query);
// po usunięciu link przekierowujący z powrotem na podgląd podstron
//        header('location:../admin_pages.php');
            $message[] = 'Udane usuwanie';

        }
        PokazKomunikat($message);
    }
    $_POST['id'] = null;

    echo $form;
}


// funkcja mająca za zadanie dodać nową kategorię
function DodajNowaKategorie(): void
{
    include('cfg.php');

    $form = '
    <form action="" method="post">

        <p style="size: 1rem">Nazwa kategorii/podkategorii:</p><br>
        <input type="text" name="nazwa" id="nazwa">

        <p style="size: 1rem">ID matki podkategorii</p><br>
        <input type="text" name="matka" id="matka" value="1"><br>

        <input class="white-btn" type="submit" name="submit" value="Dodaj">
    </form>
    ';

    if(isset($_POST['submit'])) {
// pobranie danych z formularza
        $nazwa = $_POST['nazwa'];
        $matka = $_POST['matka'];

// sprzwadzenie czy której z pól nie pozostało puste
        if(empty($nazwa)){
            $message[] = 'Wszystkie pola są wymagane';
        }
        else {
// zapytanie SQL dodający stronę
            $query = "INSERT INTO category_list SET id=NULL, nazwa = '$nazwa', matka = '$matka'";
            mysqli_query($link, $query) or die(mysqli_error($link));
            $message[] = 'Kategoria została dodana';
        }
        PokazKomunikat($message);
    }
    $_POST['id'] = null;
    $_POST['nazwa'] = null;
    $_POST['matka'] = null;


    echo $form;

}

// funkcja usuwająca kategorie o podanym id
function UsunKategorie() {
    include "cfg.php";

    $form = '
    <form action="" method="post">
        <p style="size: 1rem">Wybierz id kategorii:</p><br>
        <input type="text" name="id" id="id" required><br>
        <input class="white-btn" type="submit" name="submit" value="Usuń">
    </form>
        ';

// sprawdzenie czy formularz został wysłany
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];

        // zapytanie SQL usuwające podstronę
        $query = "DELETE FROM category_list WHERE id = '$id'";
        mysqli_query($link, $query);

    }
    $_POST['id'] = null;

    echo $form;
}

function GenerujDrzewoKategorii() {

    include('cfg.php');

    $drzewo = '';

    // pobranie głównych kategorii
    $kategorie = mysqli_query($link, "SELECT * FROM category_list where matka = 0");
    while($row = mysqli_fetch_array($kategorie)) {
        $id = $row['id'];
        $nazwaKategori = $row['nazwa'];
//        $drzewo .= "<h2>Kategoria: $nazwaKategori</h2>";
        $drzewo .= '<p style="size: 1rem; background-color: chocolate; color: #1a1201">Id: '.$id.'.Kategoria: '.$nazwaKategori.'<br />'.'</p>';

        // pobranie podkategorii dla danej matki
        $podkategorie = mysqli_query($link, "SELECT * FROM category_list where matka = '$id'");
        while($row2 = mysqli_fetch_array($podkategorie)) {
            $sub_name = $row2['nazwa'];
            $id_subcat = $row2['id'];
            $drzewo .= '<p style="size: 0.5rem; background-color: navajowhite;color: #652c00">Id: '.$id_subcat.'.Podkategoria: '.$sub_name.'<br />'.'</p>';
        }
    }
    echo $drzewo;
}

// funkcja mająca za zadanie dodać nowy produkt
function DodajNowyProdukt(): void
{
    include('cfg.php');

    $form = '
    <form action="" method="post" enctype="multipart/form-data">

        <p style="size: 1rem">Tytuł produktu:</p><br>
        <input type="text" name="tytul" id="tytul">
        
        <p style="size: 1rem">Opis produktu:</p><br>
        <input type="textarea" name="opis" id="opis">
        
        <p style="size: 1rem">Data utworzenia produktu:</p><br>
        <input type="datetime-local" name="data_utworzenia" id="data_utworzenia">
        
        <p style="size: 1rem">Data modyfikacji produktu:</p><br>
        <input type="date" name="data_modyfikacji" id="data_modyfikacji">
        
        <p style="size: 1rem">Data wygasniecia produktu:</p><br>
        <input type="date" name="data_wygasniecia" id="data_wygasniecia">

        <p style="size: 1rem">Cena netto</p><br>
        <input type="text" name="cena_netto" id="cena_netto"><br>
        
        <p style="size: 1rem">Podatek VAT</p><br>
        <input type="text" name="podatek_vat" id="podatek_vat"><br>
        
        <p style="size: 1rem">Ilość</p><br>
        <input type="text" name="ilosc" id="ilosc"><br>
        
        <p style="size: 1rem">Status dostępnosci</p><br>
        <input type="text" name="status_dostepnosci" id="status_dostepnosci"><br>
        
        <p style="size: 1rem">Kategoria</p><br>
        <input type="text" name="kategoria" id="kategoria"><br>
        
        <p style="size: 1rem">Gabaryt</p><br>
        <input type="text" name="gabaryt" id="gabaryt"><br>
        
        <p style="size: 1rem">Zdjecie</p><br>
        <input type="file" name="zdjecie" id="zdjecie" accept="zdjecie/jpg, zdjecie/jpeg, zdjecie/png"><br>

        <input class="white-btn" type="submit" name="submit" value="Dodaj">
    </form>
    ';

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

        $tytul = mysqli_real_escape_string($link, $_POST['tytul']);
        $zdjecie = $_FILES['zdjecie']['tmp_name'];


// sprzwadzenie czy której z pól nie pozostało puste
        if (empty($tytul) || empty($cena_netto)) {
            $message[] = 'Wszystkie pola są wymagane';
        } else {
// zapytanie SQL dodające produkt
            $query = mysqli_query($link, "INSERT INTO product_list(id, tytul, opis, data_utworzenia, data_modyfikacji, data_wygasniecia, 
			cena_netto, podatek_vat, ilosc, status_dostepnosci, kategoria, gabaryt, zdjecie) 
			VALUES ('NULL', '$tytul', '$opis', '$data_utworzenia', '$data_modyfikacji', '$data_wygasniecia', 
			'$cena_netto', '$podatek_vat', '$ilosc', '$status_dostepnosci', '$kategoria', '$gabaryt', '$zdjecie');");
//            mysqli_query($link, $query) or die(mysqli_error($link));

            $message[] = 'produkt dodany';
        }
        mysqli_close($link);
    }

        // wyświetlenie wiadomości jeśli została ustawiona
        if (isset($message)) {
            foreach ($message as $message) {
                echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
            }
        }

    echo $form;

}

function PokazProdukty(): void
{
        include 'cfg.php';
        $select_products = mysqli_query($link, "SELECT * FROM `product_list`") or die('query failed');
        if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
                ?>
                <div class="box">
                    <img src="../uploaded_img/<?php echo $fetch_products['zdjecie']; ?>" alt="">
                    <div class="name">Nazwa: <?php echo $fetch_products['tytul']; ?></div>
                    <div class="price">Cena: <?php echo $fetch_products['cena_netto']; ?>PLN</div>
                    <a href="#<?php echo $fetch_products['id']; ?>" class="white-btn">Dodaj</a>
                </div>
                <?php
            }
        }else{
            echo '<p class="empty">no products added yet!</p>';
        }
}

function EdytujProdukt(): void
{
    include('cfg.php');

    $form = '
    <form action="" method="post" enctype="multipart/form-data">
        <p style="size: 1rem">Id produktu:</p><br>
        <input type="text" name="id" id="id">

        <p style="size: 1rem">Tytuł produktu:</p><br>
        <input type="text" name="tytul" id="tytul">
        
        <p style="size: 1rem">Opis produktu:</p><br>
        <input type="textarea" name="opis" id="opis">
        
        <p style="size: 1rem">Data utworzenia produktu:</p><br>
        <input type="datetime-local" name="data_utworzenia" id="data_utworzenia">
        
        <p style="size: 1rem">Data modyfikacji produktu:</p><br>
        <input type="date" name="data_modyfikacji" id="data_modyfikacji">
        
        <p style="size: 1rem">Data wygasniecia produktu:</p><br>
        <input type="date" name="data_wygasniecia" id="data_wygasniecia">

        <p style="size: 1rem">Cena netto</p><br>
        <input type="text" name="cena_netto" id="cena_netto"><br>
        
        <p style="size: 1rem">Podatek VAT</p><br>
        <input type="text" name="podatek_vat" id="podatek_vat"><br>
        
        <p style="size: 1rem">Ilość</p><br>
        <input type="text" name="ilosc" id="ilosc"><br>
        
        <p style="size: 1rem">Status dostępnosci</p><br>
        <input type="text" name="status_dostepnosci" id="status_dostepnosci"><br>
        
        <p style="size: 1rem">Kategoria</p><br>
        <input type="text" name="kategoria" id="kategoria"><br>
        
        <p style="size: 1rem">Gabaryt</p><br>
        <input type="text" name="gabaryt" id="gabaryt"><br>
        
        <p style="size: 1rem">Zdjecie</p><br>
        <input type="file" name="zdjecie" id="zdjecie" accept="zdjecie/jpg, zdjecie/jpeg, zdjecie/png"><br>

        <input class="white-btn" type="submit" name="submit" value="Dodaj">
    </form>
    ';

    if(isset($_POST['submit'])) {
// pobranie danych z formularza
        $id = $_POST['id'];
        $tytul = $_POST['tytul'];
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

        $nazwa = mysqli_real_escape_string($link, $_POST['tytul']);
        $zdjecie = $_FILES['zdjecie']['nazwa'];
        $tmp = $_FILES['zdjecie']['tmp'];
        $zdjecia_folder = 'uploaded_img/' . $zdjecie;


// sprzwadzenie czy której z pól nie pozostało puste
        if (empty($tytul) || empty($cena_netto)) {
            $message[] = 'Wszystkie pola są wymagane';
        } else {
// zapytanie SQL dodające produkt
        mysqli_query($link,"UPDATE product_list SET tytul='$tytul', opis='$opis', data_utworzenia='$data_utworzenia', data_modyfikacji='$data_modyfikacji',
		data_wygasniecia='$data_wygasniecia', cena_netto='$cena_netto', podatek_vat='$podatek_vat', ilosc='$ilosc',
		status='$status', kategoria='$kategoria', gabaryt='$gabaryt', zdjecie='$zdjecie' WHERE id='$id'");
//            mysqli_query($link, $query) or die(mysqli_error($link));

            move_uploaded_file($tmp, $zdjecia_folder);
            $message[] = 'produkt dodany';
        }
    }

    // wyświetlenie wiadomości jeśli została ustawiona
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
        }
    }

    echo $form;

}

function UsunProdukt() {
    include "cfg.php";

    $form = '
    <form action="" method="post">
        <p style="size: 1rem">Wybierz id produktu:</p><br>
        <input type="text" name="id" id="id" required><br>
        <input class="white-btn" type="submit" name="submit" value="Usuń">
    </form>
        ';

// sprawdzenie czy formularz został wysłany
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];

        // zapytanie SQL usuwające podstronę
        $query = "DELETE FROM product_list WHERE id = '$id'";
        mysqli_query($link, $query);

    }
    $_POST['id'] = null;

    echo $form;
}
