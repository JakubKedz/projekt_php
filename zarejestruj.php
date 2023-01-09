<?php

$conn = new mysqli('localhost', 'root', '', 'store');

// inicjalizacja sesji
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
// sprawdzenie czy formularz został wysłąny
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // pobranie danych z formularza
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  $password_confirm = htmlspecialchars($_POST['password_confirm']);

  // sprawdzenie czy hasło jest odpowiedniej długości i ma dużą literę oraz cyfrę
  if (strlen($password) < 8) {
    $_SESSION['error_message'] = 'Hasło musi mieć co najmniej 8 znaków';
    header('Location: zarejestruj.php');
    exit;
  } elseif (!preg_match('/[A-Z]/', $password)) {
	  $_SESSION['error_message'] = 'Hasło musi zawierać co najmniej jedną dużą literę';
header('Location: zarejestruj.php');
exit;
} elseif (!preg_match('/[0-9]/', $password)) {
$_SESSION['error_message'] = 'Hasło musi zawierać co najmniej jedną cyfrę';
header('Location: zarejestruj.php');
exit;
} elseif ($password != $password_confirm) {
$_SESSION['error_message'] = 'Hasła nie są takie same';
header('Location: zarejestruj.php');
exit;
} else {
// hashowanie hasła
$password = password_hash($password, PASSWORD_DEFAULT);

// wprowadzenie danych o użytkowniku do bazy
$sql = "INSERT INTO użytkownicy (nazwa_użytkownika, adres_email, hasło) VALUES ('$name', '$email', '$password')";
$result = mysqli_query($conn, $sql);

if ($result) {
// dodanie komunikatu do zmiennej sesji o powodzeniu
$_SESSION['success_message'] = 'Użytkownik został zarejestrowany';
// przejście do zaloguj.php
header('Location: zaloguj.php');
exit;
} else {
// dodanie komunikatu do zmiennej sesji o błędzie
$_SESSION['error_message'] = 'Wystąpił błąd podczas rejestracji';
// powrót do zarejestruj.php
header('Location: zarejestruj.php');
exit;
}
}
}


?>


<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Zamówienia</title>
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
 
<!-- Formularz rejestracji -->
<form action="zarejestruj.php" method="post">
  <div class="form-group">
    <label for="name">Nazwa użytkownika:</label> 
    <input type="text" class="form-control" id="name" name="name" required>
  </div>
  <div class="form-group">
    <label for="password">Hasło:</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
    <div class="form-group">
    <label for="password_confirm">Powtórz hasło:</label>
    <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
  </div>
  <div class="form-group">
    <label for="email">Adres email:</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <button type="submit" class="btn btn-primary">Zarejestruj się</button>
</form>


  <!-- stopka -->
  <footer class="bg-light py-3 mt-5">
    <div class="container">
      <p class="text-center">&copy; <?php echo date('Y'); ?> Sklep</p>
    </div>
  </footer>