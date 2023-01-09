<?php
  // Inicjalizacja sesji
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sklep</title>
  <!-- Dodanie stylów -->
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
  
  
  <!-- Główny kontener -->
  <div class="container mt-3">
    <!-- Zawartość strony -->
    <h1>Strona główna</h1>
    <p>Witaj na stronie naszego sklepu!</p>
  </div>
  
<!-- Skrypty -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/js/adminlte.min.js"></script>
<script src="main.js"></script>
  
  <!-- Slider z promocjami -->
  <div id="promoSlider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#promoSlider" data-slide-to="0" class="active"></li>
      <li data-target="#promoSlider" data-slide-to="1"></li>
      <li data-target="#promoSlider" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="prod/promo1.jpg" class="d-block w-100" alt="Promocja 1">
        <div class="carousel-caption d-none d-md-block">
          <h5>Promocja 1</h5>
          <p>Opis promocji 1</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="prod/promo2.jpg" class="d-block w-100" alt="Promocja 2">
        <div class="carousel-caption d-none d-md-block">
          <h5>Promocja 2</h5>
          <p>Opis promocji 2</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="prod/promo3.jpg" class="d-block w-100" alt="Promocja 3">
        <div class="carousel-caption d-none d-md-block">
          <h5>Promocja 3</h5>
          <p>Opis promocji 3</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#promoSlider" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Poprzedni</span>
    </a>
    <a class="carousel-control-next" href="#promoSlider" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Następny</span>
    </a>
  </div>
  
  <!-- Sekcja z najczęściej kupowanymi produktami -->
  <div class="container mt-3">
    <h2>Najczęściej kupowane produkty</h2>
    <div class="row">
      <div class="col-md-4 mb-3">
        <div class="card">
          <img src="prod/prod1.jpg" class="card-img-top" alt="Produkt 1">
		  <div class="card-body">
			<h5 class="card-title">Produkt 1</h5>
			<p class="card-text">Opis produktu</p>
			<h6 class="card-subtitle mb-2 text-muted">Cena: 100 zł</h6>
			<a href="#" class="btn btn-primary">Dodaj do koszyka</a>
		  </div>
		</div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card">
          <img src="prod/prod2.jpg" class="card-img-top" alt="Produkt 2">
		  <div class="card-body">
			<h5 class="card-title">Produkt 2</h5>
			<p class="card-text">Opis produktu</p>
			<h6 class="card-subtitle mb-2 text-muted">Cena: 50 zł</h6>
			<a href="#" class="btn btn-primary">Dodaj do koszyka</a>
		  </div>
		</div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card">
          <img src="prod/prod3.jpg" class="card-img-top" alt="Produkt 3">
		  <div class="card-body">
			<h5 class="card-title">Produkt 3</h5>
			<p class="card-text">Opis produktu</p>
			<h6 class="card-subtitle mb-2 text-muted">Cena: 80 zł</h6>
			<a href="#" class="btn btn-primary">Dodaj do koszyka</a>
		  </div>
		</div>
      </div>
    </div>
  </div>
		  
 <!-- Sekcja z polecanymi produktami -->
  <div class="container mt-3">
    <h2>Polecane produkty</h2>
    <div class="row">
      <div class="col-md-4 mb-3">
        <div class="card">
          <img src="prod/prod4.jpg" class="card-img-top" alt="Produkt 4">
          <div class="card-body">
            <h5 class="card-title">Produkt 4</h5>

<p class="card-text">Opis produktu 4</p>
            <p class="price">129,99 zł</p>
            <button class="btn btn-primary">Dodaj do koszyka</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card">
          <img src="prod/prod5.jpg" class="card-img-top" alt="Produkt 5">
          <div class="card-body">
            <h5 class="card-title">Produkt 5</h5>
            <p class="card-text">Opis produktu 5</p>
            <p class="price">79,99 zł</p>
            <button class="btn btn-primary">Dodaj do koszyka</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="card">
          <img src="prod/prod6.jpg" class="card-img-top" alt="Produkt 6">
          <div class="card-body">
            <h5 class="card-title">Produkt 6</h5>
            <p class="card-text">Opis produktu 6</p>
            <p class="price">199,99 zł</p>
            <button class="btn btn-primary">Dodaj do koszyka</button>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- Stopka -->
  <footer class="bg-light py-3 mt-3">
    <div class="container">
      <p class="text-center">Copyright &copy; Sklep S.A.</p>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/js/adminlte.min.js"></script>
  <script src="main.js"></script>
</body>
</html>