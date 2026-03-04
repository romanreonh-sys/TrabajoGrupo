<?php
$host = 'localhost';
$dbname = 'inicio_sesion'; 
$username = 'root'; 
$password = 'zS759!NL}@bstk]'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión a la base de datos.");
}
?>