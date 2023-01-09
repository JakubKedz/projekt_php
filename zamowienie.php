<?php

session_start();

// połączenie z bazą danych
$db = mysqli_connect("localhost", "root", "", "store");

// pobieranie danych z formularza
$user_id = $_SESSION['user_id'];
$count = count($_SESSION['cart']);

foreach ($_SESSION['cart'] as $key => $product) {
$query = "INSERT INTO zamowienie (id_uzytkownika, id_produktu, ilosc)
          VALUES('$user_id', '{$product['id']}', '{$product['quantity']}')";
  mysqli_query($db, $query);
}

// czyszczenie koszyka
unset($_SESSION['cart']);

// przekierowanie do strony głównej
header('location: zamowienia.php');

?>