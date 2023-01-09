<?php
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany
if ($_SESSION['logged_in'] == false) {
header('Location: index.php');
exit;
}

// Połączenie z bazą danych
$conn = mysqli_connect('localhost', 'root', '', 'store');

// Pobranie danych użytkownika z bazy danych
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM użytkownicy WHERE id=$user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Sprawdzenie, czy formularz został wysłany
if (isset($_POST['update'])) {
// Pobranie danych z formularza
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['haslo']);
$password_old = mysqli_real_escape_string($conn, $_POST['haslo_old']);

// Sprawdzenie, czy podane hasło jest poprawne
if (password_verify($password_old, $user['hasło'])) {
// Zmiana danych użytkownika w bazie danych
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$sql = "UPDATE użytkownicy SET adres_email='$email', hasło='$hashed_password' WHERE id=$user_id";
if (mysqli_query($conn, $sql)) {
// Powiadomienie użytkownika o pomyślnej aktualizacji danych
$message = '<div class="alert alert-success">Twoje dane zostały zaktualizowane pomyślnie.</div>';
header('Location: panel_uzytkownika.php');
exit;
} else {
// Powiadomienie użytkownika o błędzie
$message = '<div class="alert alert-danger">Wystąpił błąd podczas aktualizowania danych.</div>';
}
} else {
// Powiadomienie użytkownika o błędnym haśle
$message = '<div class="alert alert-danger">Podane hasło jest niepoprawne.</div>';
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel użytkownika</title>
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
<div class="container mt-5">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card">
        <div class="card-header">
          <h4>Panel użytkownika</h4>
        </div>
        <div class="card-body">
          <form action="panel_uzytkownika.php" method="post">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" value="<?php echo $user['adres_email']; ?>">
            </div>
            <div class="form-group">
              <label for="haslo">Nowe hasło</label>
              <input type="password" name="haslo" id="haslo" class="form-control">
            </div>
            <div class="form-group">
              <label for="haslo_ponownie">Stare hasło</label>
              <input type="password" name="haslo_old" id="haslo_old" class="form-control">
            </div>
            <div class="form-group">
              <button type="submit" name="update" class="btn btn-primary btn-block">Zapisz</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
	  
  <!-- stopka -->
  <footer class="bg-light py-3 mt-5">
    <div class="container">
      <p class="text-center">&copy; <?php echo date('Y'); ?> Sklep</p>
    </div>
  </footer>