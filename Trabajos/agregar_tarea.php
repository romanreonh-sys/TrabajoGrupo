<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['Id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['add']) && !empty($_POST['descripcion'])) {
    $usuario_id = $_SESSION['Id'];
    $descripcion = trim($_POST['descripcion']);

    $stmt = $pdo->prepare("INSERT INTO tareas (usuario_id, descripcion, estado) VALUES (:usuario_id, :descripcion, 'Pendiente')");
    $stmt->execute([
        'usuario_id' => $usuario_id,
        'descripcion' => $descripcion,
    ]);

    header('Location: inicio.php');
    exit();
}

header('Location: inicio.php');
exit();
?>