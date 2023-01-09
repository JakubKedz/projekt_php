<?php
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany
if ($_SESSION['logged_in'] == false) {
  header('Location: index.php');
  exit;
}

// Pobranie ID zamówienia z formularza
$order_id = $_POST['order_id'];

// Połączenie z bazą danych
$conn = mysqli_connect('localhost', 'root', '', 'store');

// Usunięcie zamówienia z bazy danych
$sql = "DELETE FROM zamowienie WHERE id=$order_id";
mysqli_query($conn, $sql);

// Przekierowanie do strony zamówień
header('Location: zamowienia_admin.php');
exit;