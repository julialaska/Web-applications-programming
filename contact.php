<?php
//funkcja zwracająca formularz kontaktowy
function PokazKontakt()
{
    $form = '
        <div class="heading">
           <h3>Skontaktuj się z nami</h3>
        </div>
        
        <section class="contact">
        
           <form method="post" enctype="text/plain">
              <h3>Napisz do nas</h3>
              <input type="email" name="email" required placeholder="Email" class="box">
              <input type="text" name="subject" required placeholder="Temat" class="box">
              <textarea name="body" class="box" placeholder="Wiadomosc" id="" cols="30" rows="10"></textarea>
              <input type="submit" value="Wyślij wiadomosc" name="send" class="btn">
           </form>
        
        </section>
            ';

    return $form;
}
// funkcja wysyłająca mail o konkretnej treści i tytule
function WyslijMailKontakt($odbiorca){

    if (empty($_POST['temat']) || empty($_POST['tresc']) || empty($_POST['email']))
    {
        echo PokazKontakt();
    }
    else
    {
        $mail['subject'] = $_POST['temat'];
        $mail['body'] = $_POST['tresc'];
        $mail['sender'] = $_POST['email'];
        $mail['reciptient'] = $odbiorca;

        $header = "From: Formularz kontaktowy <".$mail['sender'].">\n";
        $header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding: 8bit\n";
        $header .= "X-Sender: <".$mail['sender'].">\n";
        $header .= "X-Mailer: PRapWWW mail 1.2\n";
        $header .= "X-Priority: 3\n";
        $header .= "Return-Path: <".$mail['sender']."\n";

        mail($mail['reciptient'], $mail['subject'], $mail['body'], $header);
        echo '[wiadomosc_wyslana]';

    }
}

// funkcja zwracająca formularz do przypominania hasła
function FormularzHaslo()
{
    $form = '
        <div class="heading">
           <h3>Przypomnij hasło</h3>
        </div>
        
        <section class="contact">
        
           <form action="mailto:julkalas101@gmail.com" method="post" enctype="text/plain">
              <h3>przypomnij haslo</h3>
              <input type="email" name="email" required placeholder="Email" class="box">
              <input type="submit" value="Wyślij wiadomosc" name="send" class="btn">
           </form>
        
        </section>
            ';

    return $form;
}
function PrzypomnijHaslo()
{
    include('cfg.php');

    if (empty($_POST['email'])) {
        echo FormularzHaslo();
    } else {

       $mail['subject'] = $_POST['temat'] = "Przypomnienie hasla";
       $mail['body'] = "Haslo do konta adminisratora: ".$admin_pass."";
       $mail['sender'] = $admin_mail;
       $mail['reciptient'] = $_POST['email'];

       $header = "From: Formularz kontaktowy <" . $mail['sender'] . ">\n";
       $header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding: 8bit\n";
       $header .= "X-Sender: <" . $mail['sender'] . ">\n";
       $header .= "X-Mailer: PRapWWW mail 1.2\n";
       $header .= "X-Priority: 3\n";
       $header .= "Return-Path: <" . $mail['sender'] . "\n";

        mail($mail['reciptient'], $mail['subject'], $mail['body'], $header);
    }

}