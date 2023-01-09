<?php
  // Inicjalizacja sesji
  session_start();
  
  ?>

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

// Połączenie z bazą danych
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "store";

// Tworzenie połączenia
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Sprawdzanie połączenia
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Zapytanie do bazy danych
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

// Pętla po wynikach zapytania
while($row = mysqli_fetch_assoc($result)) {
  $id = $row['id'];
  $name = $row['name'];
  $price = $row['price'];
  $description = $row['description'];
  $image = $row['image'];
  ?>

  <!-- Kafelka z produktem -->
  <div class="col-sm-6 col-md-4">
    <div class="card mb-4 shadow-sm">
      <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>" class="card-img-top">
      <div class="card-body">
        <h5 class="card-title"><?php echo $name; ?></h5>
        <p class="card-text"><?php echo $description; ?></p>
        <div class="d-flex justify-content-between align-items-center">
          <div class="btn-group">
			  <!-- Formularz do dodawania produktu do koszyka -->
			          <form action="dodaj_do_koszyka.php" method="post">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="name" value="<?php echo $name; ?>">
          <input type="hidden" name="price" value="<?php echo $price; ?>">
          <button type="submit" class="btn btn-primary">Dodaj do koszyka</button>
        </form>
      </div>
      <strong class="text-muted"><?php echo $price; ?> zł</strong>
    </div>
  </div>
</div>
  </div>
<?php
}



// Zamykanie połączenia z bazą danych
mysqli_close($conn);

?>

  <!-- stopka -->
  <footer class="bg-light py-3 mt-5">
    <div class="container">
      <p class="text-center">&copy; <?php echo date('Y'); ?> Sklep</p>
    </div>
  </footer>