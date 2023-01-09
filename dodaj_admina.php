<?php
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany i ma uprawnienia administratora
if ($_SESSION['logged_in'] == false || $_SESSION['is_admin'] == false) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sklep</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/css/adminlte.min.css">
</head>
<body>
<!-- Główny pasek nawigacyjny -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Sklep</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Strona główna</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="produkty.php">Produkty</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="koszyk.php">Koszyk</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="zamowienia.php">Zamówienia</a>
    </ul>
	<ul class="navbar-nav ml-auto">
  <?php 
  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true): ?>
    <li class="nav-item">
      <a class="nav-link" href="#"><?php echo $_SESSION['username']; ?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="wyloguj.php">Wyloguj</a>
    </li>
	  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="panel_uzytkownika.php">Panel użytkownika</a>
    </li>
	<?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true):?>
    <li class="nav-item">
      <a class="nav-link" href="panel_administratora.php">Panel administratora</a>
    </li>
	<?php endif; ?>
  </ul>
  <?php else: ?>
    <li class="nav-item">
      <a class="nav-link" href="zaloguj.php">Zaloguj</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="zarejestruj.php">Zarejestruj</a>
    </li>
	  <?php endif; ?>
</ul>
  </div>
  </nav>

<?php
// Połączenie z bazą danych MySQL
$mysqli = new mysqli("localhost", "root", "", "store");

if ($mysqli->connect_errno) {
    echo "Błąd połączenia z bazą danych: " . $mysqli->connect_error;
    exit;
}

// Zapytanie do bazy danych, pobierające wszystkich użytkowników
$result = $mysqli->query("SELECT * FROM użytkownicy");

if (!$result) {
    echo "Błąd zapytania do bazy danych: " . $mysqli->error;
    exit;
}

// Wyświetlenie danych użytkowników w tabeli
echo "<table>";
echo "<tr><th>Nazwa użytkownika </th><th> Adres e-mail </th><th> Uprawnienia administratora </th><th> Akcje </th></tr>";
while ($row = $result->fetch_assoc()) {
    $username = $row['nazwa_użytkownika'];
    $email = $row['adres_email'];
    $is_admin = $row['admin'];
    echo "<tr>";
    echo "<td>" . $username . "</td>";
    echo "<td>" . $email . "</td>";
    echo "<td>" . ($is_admin ? "Tak" : "Nie") . "</td>";
    // Wyświetlenie przycisku do nadawania lub odbierania uprawnień administratora
if ($is_admin) {
    echo "<td><a href='odebranie_uprawnien_admina.php?username=$username'>Odbierz uprawnienia administratora</a></td>";
} else {
    echo "<td><a href='nadanie_uprawnien_admina.php?username=$username'>Dodaj uprawnienia administratora</a></td>";
}
echo "</tr>";

}
echo "</table>";
?>


  <!-- stopka -->
  <footer class="bg-light py-3 mt-5">
    <div class="container">
      <p class="text-center">&copy; <?php echo date('Y'); ?> Sklep</p>
    </div>
  </footer>
