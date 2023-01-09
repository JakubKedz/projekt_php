<?php
  // Inicjalizacja sesji
  session_start();

  // Sprawdzenie, czy sesja koszyka jest utworzona
  if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
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
  
  <!-- Główna treść -->
  <div class="container mt-4">
    <h1>Koszyk</h1>
    <hr>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nazwa</th>
          <th scope="col">Cena</th>
          <th scope="col">Ilość</th>
          <th scope="col">Całkowita cena</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php
          if (empty($_SESSION['cart'])) {
            echo '<tr><td colspan="6">Twój koszyk jest pusty</td></tr>';
          } else {
            $total = 0;
            foreach ($_SESSION['cart'] as $key => $product) {
        ?>
        <tr>
          <th scope="row"><?php echo $product['id']; ?></th>
          <td><?php echo $product['name']; ?></td>
          <td>$<?php echo $product['price']; ?></td>
          <td>
            <!-- Formularz do modyfikowania ilości produktów w koszyku -->
            <form action="modyfikuj_koszyk.php" method="post">
              <input type="hidden" name="id" value="<?php echo $key; ?>">
              <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" min="1" max="99" class="form-control form-control-sm">
			  <button type="submit" name="modify_product" class="btn btn-secondary btn-sm">Zmień</button>
</form>
</td>
<td>$<?php echo $product['price']*$product['quantity']; ?></td>
<td>
<!-- Formularz do usuwania pojedynczych produktów z koszyka -->
<form action="usun_z_koszyka.php" method="post">
<input type="hidden" name="id" value="<?php echo $key; ?>">
<button type="submit" name="remove_product" class="btn btn-danger btn-sm">Usuń</button>
</form>
</td>
</tr>
<?php
       $total = $total + ($product['price']*$product['quantity']);
		  }}
		if (!isset($total)) {
  $total = 0;
}
     ?>
<tr>
<td></td>
<td></td>
<td></td>
<td>Suma:</td>
<td>$<?php echo $total; ?></td>
<td>
<!-- Formularz do usuwania wszystkich produktów z koszyka -->
<form action="wyczysc_koszyk.php" method="post">
  <button type="submit" name="clear_cart" class="btn btn-secondary btn-sm">Wyczyść koszyk</button>
</form>
</td>
</tr>
</tbody>
</table>
<div class="d-flex justify-content-between align-items-center">
<a href="produkty.php" class="btn btn-secondary">Kontynuuj zakupy</a>
<a href="zamowienie.php" class="btn btn-primary">Złóż zamówienie</a>
</div>

  </div>
  <!-- stopka -->
  <footer class="bg-light py-3 mt-5">
    <div class="container">
      <p class="text-center">&copy; <?php echo date('Y'); ?> Sklep</p>
    </div>
  </footer>
  <!-- skrypty -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>