<?php

session_start();

// Jeśli sesja 'cart' nie istnieje, to tworzenie jej
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];

// Sprawdzenie, czy produkt jest już w koszyku
$key = array_search($id, array_column($_SESSION['cart'], 'id'));

// Jeśli produkt jest w koszyku, to zwiększenie jego ilości o 1
if ($key !== false) {
  $_SESSION['cart'][$key]['quantity']++;
  header('Location: produkty.php');
  exit;
}

// Jeśli produkt nie jest w koszyku, to dodanie go do koszyka
$count = count($_SESSION['cart']);
$item_array = array(
  'id' => $id,
  'name' => $name,
  'price' => $price,
  'quantity' => 1
);
$_SESSION['cart'][$count] = $item_array;

header('Location: produkty.php');
exit;

?>