<?php
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany
if ($_SESSION['logged_in'] == false and $_SESSION['is_admin'] == true) {
header('Location: index.php');
exit;
}

// Skrypt dodający nowy produkt do bazy danych

// Połączenie z bazą danych MySQL
$host = "localhost";
$username = "root";
$password = "";
$database = "store";

$conn = mysqli_connect($host, $username, $password, $database);
  // Pobranie danych z formularza
  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $image = $_POST['image'];
	echo ('ok');
  // Sprawdzenie, czy pola nie są puste
  if (empty($name) || empty($price) || empty($description) || empty($image)) {
    echo "Uzupełnij wszystkie pola!";
	header("Location: edycja_produktow_admin.php");
  } else {
    // Dodanie nowego produktu do bazy danych
    $query = "INSERT INTO products (name, price, description, image) VALUES ('$name', '$price', '$description', '$image')";
    mysqli_query($conn, $query);
    // Przekierowanie do strony z listą produktów
    header("Location: edycja_produktow_admin.php");
  }
?>