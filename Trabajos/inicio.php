<?php
session_start();
if (!isset($_SESSION['Usuario'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container text-center">
        <i class='bx bx-store-alt' style='font-size: 3rem; color: #111111; margin-bottom: 10px;'></i>
        <h1>Bienvenido</h1>
        
        <p style="color: #555555; margin-bottom: 2rem; font-size: 0.95rem;">
            Hola, <strong><?php echo htmlspecialchars($_SESSION['Usuario']); ?></strong>. Has accedido correctamente al sistema.
        </p>

        <a href="CerrarSesion.php" style="text-decoration: none; width: 100%; display: block;">
            <button type="button" class="btn-outline">
                <i class='bx bx-log-out'></i> Cerrar Sesión
            </button>
        </a>
    </div>
</body>
</html>