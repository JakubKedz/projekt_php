<?php
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany
if ($_SESSION['logged_in'] == false and $_SESSION['is_admin'] == true) {
header('Location: index.php');
exit;
}
?>

<!-- Skrypt usuwający produkt z bazy danych -->
<?php
// Połączenie z bazą danych MySQL
$host = "localhost";
$username = "root";
$password = "";
$database = "store";

$conn = mysqli_connect($host, $username, $password, $database);
// Pobranie ID produktu z formularza
$id = $_POST['id'];

// Usunięcie produktu z bazy danych
$query = "DELETE FROM products WHERE id=$id";
mysqli_query($conn, $query);

// Przekierowanie do strony z listą produktów
header("Location: edycja_produktow_admin.php");
?>