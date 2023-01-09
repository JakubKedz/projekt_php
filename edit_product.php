<?php
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany
if ($_SESSION['logged_in'] == false and $_SESSION['is_admin'] == true) {
header('Location: index.php');
exit;
}
?>

<?php
// Połączenie z bazą danych MySQL
$host = "localhost";
$username = "root";
$password = "";
$database = "store";

$conn = mysqli_connect($host, $username, $password, $database);

// Pobranie ID produktu z formularza
$id = $_POST['id'];

// Pobranie danych produktu z bazy danych
$query = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$name = $row['name'];
$price = $row['price'];
$description = $row['description'];
$image = $row['image'];

// Jeśli formularz został wysłany...
if (isset($_POST['submit'])) {
  // Pobranie danych z formularza
  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $image = $_POST['image'];

  // Uaktualnienie danych produktu w bazie danych
  $query = "UPDATE products SET name='$name', price='$price', description='$description', image='$image' WHERE id=$id";
  mysqli_query($conn, $query);

  // Przekierowanie do strony z listą produktów
  header("Location: edycja_produktow_admin.php");
}
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel użytkownika</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/css/adminlte.min.css">
</head>
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

<!-- Formularz do edycji produktu -->
<form method="post" action="edit_product.php">
  <div class="form-group">
    <label for="name">Nazwa produktu:</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
  </div>
  <div class="form-group">
    <label for="price">Cena:</label>
    <input type="price" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
  </div>
  <div class="form-group">
    <label for="description">Opis:</label>
    <textarea class="form-control" id="description" name="description"><?php echo $description; ?></textarea>
  </div>
  <div class="form-group">
    <label for="image">Obraz:</label>
    <input type="text" class="form-control" id="image" name="image" value="<?php echo $image; ?>">
  </div>
  <input type="hidden" name="id" value="<?php echo $id; ?>">
<button type="submit" name="submit" class="btn btn-primary">Zapisz</button>

</form>

  <footer class="bg-light py-3 mt-5">
    <div class="container">
      <p class="text-center">&copy; <?php echo date('Y'); ?> Sklep</p>
    </div>
  </footer>