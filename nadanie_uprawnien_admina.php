<?php
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany i ma uprawnienia administratora
if ($_SESSION['logged_in'] == false || $_SESSION['is_admin'] == false) {
    header('Location: index.php');
    exit;
}

// Pobranie nazwy użytkownika z adresu URL
$username = $_GET['username'];

// Połączenie z bazą danych MySQL
$mysqli = new mysqli("localhost", "root", "", "store");

if ($mysqli->connect_errno) {
    echo "Błąd połączenia z bazą danych: " . $mysqli->connect_error;
    exit;
}

// Zapytanie do bazy danych, nadające uprawnienia administratora dla wybranego użytkownika
$result = $mysqli->query("UPDATE użytkownicy SET admin = 1 WHERE nazwa_użytkownika = '$username'");

if (!$result) {
    echo "Błąd zapytania do bazy danych: " . $mysqli->error;
    exit;
}

// Przekierowanie do strony dodaj_admina.php
header('Location: dodaj_admina.php');
exit;