<?php
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany
if ($_SESSION['logged_in'] == false) {
  header('Location: index.php');
  exit;
}

// Połączenie z bazą danych
$conn = mysqli_connect('localhost', 'root', '', 'store');

// Pobranie zamówień użytkownika z bazy danych
$user_id = $_SESSION['user_id'];
$sql = "SELECT z.id_produktu, z.ilosc, p.name FROM zamowienie z, products p WHERE id_uzytkownika=$user_id AND z.id_produktu=p.id";
$result = mysqli_query($conn, $sql);

// Pobranie adresu email użytkownika z bazy danych
$sql = "SELECT adres_email FROM użytkownicy WHERE id=$user_id";
$result2 = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result2);
$email = $row['adres_email'];

// Wyświetlenie zamówień użytkownika
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
  
<!-- Treść strony -->
<div class="container mt-5">
  <h2>Zamówienia</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Email użytkownika</th>
        <th>Nazwa produktu</th>
        <th>Ilość</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
          <td>
            <?php
              // Pobranie adresu email użytkownika
              $sql = "SELECT adres_email FROM użytkownicy WHERE id=$user_id";
              $user_result = mysqli_query($conn, $sql);
              $user = mysqli_fetch_assoc($user_result);
              echo $user['adres_email'];
            ?>
          </td>
          <td>
            <?php
              // Pobranie nazwy produktu
			  $product_id = $row['id_produktu'];
$sql = "SELECT name FROM products WHERE id=$product_id";
$product_result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($product_result);
echo $product['name'];
?>
</td>
<td>
<?php
           // Wyświetlenie ilości zamówionych produktów
           echo $row['ilosc'];
         ?>
</td>
</tr>

<?php } ?>
</tbody>
</table>

  </div>
</body>
</html>

  <!-- stopka -->
  <footer class="bg-light py-3 mt-5">
    <div class="container">
      <p class="text-center">&copy; <?php echo date('Y'); ?> Sklep</p>
    </div>
  </footer>