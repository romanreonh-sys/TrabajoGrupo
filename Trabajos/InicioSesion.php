<?php
session_start();
require 'conexion.php';

if (isset($_POST['Usuario']) && isset($_POST['Clave'])) {
    
    $Usuario = trim($_POST['Usuario']);
    $Clave = trim($_POST['Clave']);

    if (empty($Usuario)) {
        header("Location: index.php?error=El nombre de usuario es requerido");
        exit();
    } else if (empty($Clave)) {
        header("Location: index.php?error=La contraseña es requerida");
        exit();
    } else {
        $ClaveMD5 = md5($Clave);

        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND clave = :clave";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['usuario' => $Usuario, 'clave' => $ClaveMD5]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $_SESSION['Usuario'] = $row['usuario'];
            $_SESSION['Nombre Completo'] = $row['nombre_completo'];
            $_SESSION['Id'] = $row['id'];
            
            header("Location: inicio.php");
            exit();
        } else {
            header("Location: index.php?error=Usuario o contraseña incorrectos");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>