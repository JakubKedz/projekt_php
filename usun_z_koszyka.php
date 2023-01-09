<?php
session_start();

// Jeśli istnieje tablica 'cart' w sesji, to usunięcie produktu o podanym ID
if(isset($_SESSION['cart'])) {
  $id = $_POST['id'];
  unset($_SESSION['cart'][$id]);
}

// Przekierowanie do strony koszyka
header('Location: koszyk.php');