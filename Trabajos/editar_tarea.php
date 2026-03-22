<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['Id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id_tarea'])) {
    $id_tarea = (int)$_GET['id_tarea'];
    $usuario_id = $_SESSION['Id'];

    $stmt = $pdo->prepare("UPDATE tareas SET estado = 'Hecho' WHERE id_tarea = :id_tarea AND usuario_id = :usuario_id");
    $stmt->execute([
        'id_tarea' => $id_tarea,
        'usuario_id' => $usuario_id,
    ]);

    header('Location: inicio.php');
    exit();
}

header('Location: inicio.php');
exit();
?>