<?php

session_start();

// Usunięcie zmiennych z sesji
unset($_SESSION['user_id']);
unset($_SESSION['email']);
unset($_SESSION['logged_in']);

// Przekierowanie do strony głównej
header('location: index.php');

?>