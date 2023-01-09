<?php
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany
if ($_SESSION['logged_in'] == false and $_SESSION['is_admin'] == true) {
header('Location: index.php');
exit;
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
<?php
// Połączenie z bazą danych MySQL
$host = "localhost";
$username = "root";
$password = "";
$database = "store";

$conn = mysqli_connect($host, $username, $password, $database);

// Pobranie wszystkich produktów z bazy danych
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

?>
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
<!-- Tabela z produktami -->
<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nazwa</th>
      <th>Cena</th>
      <th>Opis</th>
      <th>Obraz</th>
      <th>Opcje</th>
    </tr>
  </thead>
  <tbody>
    <?php
      // Pobranie wszystkich produktów z bazy danych
      $query = "SELECT * FROM products";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $description = $row['description'];
        $image = $row['image'];
        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$name</td>";
        echo "<td>$price</td>";
        echo "<td>$description</td>";
        echo "<td>$image</td>";
        echo "<td>";
        // Formularz do edycji produktu
        echo "<form method='post' action='edit_product.php'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<button type='submit' class='btn btn-primary'>Edytuj</button>";
        echo "</form>";
        // Przycisk do usuwania produktu
        echo "<form method='post' action='delete_product.php'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<button type='submit' class='btn btn-danger'>Usuń</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>
<!-- Formularz do dodawania produktu -->
<form method="post" action="add_product.php">
  <div class="form-group">
    <label for="name">Nazwa produktu:</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>
  <div class="form-group">
    <label for="price">Cena:</label>
    <input type="price" class="form-control" id="price" name="price">
  </div>
  <div class="form-group">
    <label for="description">Opis:</label>
    <textarea class="form-control" id="description" name="description"></textarea>
  </div>
  <div class="form-group">
    <label for="image">Obraz:</label>
    <input type="text" class="form-control" id="image" name="image">
  </div>
  <button type="submit" class="btn btn-primary">Dodaj produkt</button>
</form>
</body>

  <footer class="bg-light py-3 mt-5">
    <div class="container">
      <p class="text-center">&copy; <?php echo date('Y'); ?> Sklep</p>
    </div>
  </footer>