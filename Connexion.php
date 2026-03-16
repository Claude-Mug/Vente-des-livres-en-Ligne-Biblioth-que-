<?php
$name = 'mysql:host=localhost;dbname=bibliotheque';
$user = 'root';
$pass = '';
try {
    $connect = new PDO($name, $user, $pass);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo 'Erreur de la connexion : ' . $ex->getMessage();
}
?>
