<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$baza = 'moja_strona';

$admin_email = 'julkalas101@gmail.com';
$admin_pass = 'julia';

$link = mysqli_connect($dbhost, $dbuser, $dbpass, $baza);

if (!$link) echo '<b>przerwane połączenie </b>';
if (!mysqli_select_db($link, $baza)) echo 'nie wybrano bazy';

