<?php
session_start();

// Resetowanie zmiennej sesji 'cart' do pustej tablicy
$_SESSION['cart'] = array();

// Przekierowywanie do koszyka
header('Location: koszyk.php');