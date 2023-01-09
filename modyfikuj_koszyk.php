<?php

// Inicjalizacja sesji
session_start();

// Pobranie identyfikatora i ilości produktu z formularza
$id = $_POST['id'];
$quantity = $_POST['quantity'];

// Modyfikacja ilości produktu w sesji
$_SESSION['cart'][$id]['quantity'] = $quantity;

// Przekierowanie do koszyka
header('Location: koszyk.php');

?>