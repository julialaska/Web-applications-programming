<?php


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
           </form>

        </div>
        ';
}

function ListaPodstron(){
    include('../cfg.php');

    $query = " SELECT * FROM page_list ";
    $result = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($result)) {
        echo '<p style="size: 1rem">'.$row['id'].' '.$row['page_title'].'<br />'.'</p>';
    }
}

// funkcja zwracajaca formularz edycji podstrony
function EdytujPodstrone(){
    include('../cfg.php');

    $form = '
    <form action="" method="post">
        <p style="size: 1rem">Wybierz id podstrony:</p><br>
        <select name="id" id="id" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
        </select>

        <p style="size: 1rem">Tytuł podstrony:</p><br>
        <input type="text" name="page_title" id="page_title" required>

        <p style="size: 1rem">Treść podstrony:</p><br>
        <textarea name="page_content" id="page_content" required></textarea><br>

        <p style="size: 1rem">Aktywna</p><br>
        <input type="checkbox" name="status" id="status" value="1"><br>

        <input class="white-btn" type="submit" name="submit" value="Zapisz">
    </form>
    ';

//  sprawdzenie czy formularz został wysłany
    if(isset($_POST['submit'])) {
// pobranie danych z formularza
        $id = $_POST['id'];
        $page_title = $_POST['page_title'];
        $page_content = $_POST['page_content'];
        $status = isset($_POST['status']) ? $_POST['status'] : 0;

//        if(empty($page_title) || !empty($page_content) || is_numeric($status)){
//            $message[] = 'Wszystkie pola są wymagane';
//        }

// zapytanie SQL edytujące stronę
        $query = "UPDATE page_list SET page_title='$page_title', page_content='$page_content', status='$status' WHERE id='$id' LIMIT 1";
        mysqli_query($link, $query) or die(mysqli_error($link));
    }
    $_POST['id'] = null;
    $_POST['page_content'] = null;
    $_POST['page_title'] = null;
    $_POST['status'] = null;

    if(isset($message)){
        foreach($message as $message){
            echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
        }
    }else{
        echo $form;
    }
}

function DodajNowaPodstrone() {
    include '../cfg.php';

    $form = '
    <form action="" method="post">

        <p style="size: 1rem">Tytuł podstrony:</p><br>
        <input type="text" name="page_title" id="page_title" required>

        <p style="size: 1rem">Treść podstrony:</p><br>
        <textarea name="page_content" id="page_content" required></textarea>

        <p style="size: 1rem">Aktywna</p><br>
        <input type="checkbox" name="status" id="status" value="1"><br>

        <input class="white-btn" type="submit" name="submit" value="Dodaj">
    </form>
    ';

// sprawdzenie czy formularz został wysłany
    if(isset($_POST['submit'])) {
// pobranie danych z formularza
        $page_title = $_POST['page_title'];
        $page_content = $_POST['page_content'];
        $status = isset($_POST['status']) ? $_POST['status'] : 0;

// sprzwadzenie czy której z pól nie pozostało puste
        if(empty($page_title) || empty($page_content) || !is_numeric($status)){
            $message[] = 'Wszystkie pola są wymagane';
        }
// zapytanie SQL dodający stronę
        $query = "INSERT INTO page_list SET page_title = '$page_title', page_content = '$page_content', status = '$status'";
        mysqli_query($link, $query) or die(mysqli_error($link));

        $_POST['id'] = null;
        $_POST['page_content'] = null;
        $_POST['page_title'] = null;
        $_POST['status'] = null;
    }else {
        echo $form;
    }
}

// funkcja usuwająca podstronę
function UsunPodstrone() {
    include "../cfg.php";
    $form = '
    <form action="" method="post">
        <p style="size: 1rem">Wybierz id podstrony:</p><br>
        <select name="id" id="id" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
        </select><br>
        <input class="white-btn" type="submit" name="submit" value="Dodaj">
    </form>
        ';

// sprawdzenie czy formularz został wysłany
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];

//sprawdzenie poprawnosci id
        if(empty($id) || !is_numeric($id)) {
            die("Invalid page ID.");
        }

// zapytanie SQL usuwające podstronę
        $query = "DELETE FROM page_list WHERE id = $id LIMIT 1";
        mysqli_query($link, $query) or die(mysqli_error($link));

        $_POST['id'] = null;
        $_POST['page_content'] = null;
        $_POST['page_title'] = null;
        $_POST['status'] = null;
    }
    else{
        echo $form;
    }

}