<?php

// sprawdzanie czy formularz został wysłany
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // pobieranie danych z formularza
  $username = $_POST['username'];
  $password = $_POST['password'];
  
    $conn = new mysqli('localhost', 'root', '', 'store');
    // Select data from database
  $sql = "SELECT * FROM użytkownicy WHERE nazwa_użytkownika='$username'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // User exists, check password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['hasło'])) {
      // Password is correct, start a new session
      session_start();
     $_SESSION['logged_in'] = true;
	 $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $username;
	$_SESSION['is_admin'] = $row['admin'];
	    header('Location: zamowienia.php');
	}
	else {
    // użytkownik nie został znaleziony
    $error = "Nieprawidłowa nazwa użytkownika lub hasło";
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
  

<!-- Strona -->
<div class="container mt-5">
  <div class="row">
    <div class="col-12">
      <h1>Zaloguj się</h1>

      <!-- Formularz do logowania -->
      <form action="zaloguj.php" method="post">
        <div class="form-group">
          <label for="username">Nazwa użytkownika</label>
          <input type="username" name="username" class="form-control">
        </div>
        <div class="form-group">
          <label for="password">Hasło</label>
          <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" name="login" class="btn btn-primary">Zaloguj</button>
      </form>
    </div>
  </div>
</div>

<!-- skrypty -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>


  <!-- stopka -->
  <footer class="bg-light py-3 mt-5">
    <div class="container">
      <p class="text-center">&copy; <?php echo date('Y'); ?> Sklep</p>
    </div>
  </footer>