<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'conexion.php'; 

    $usuario = trim($_POST['usuario']);
    $nombre_completo = trim($_POST['nombre_completo']);
    $clave_plana = $_POST['clave'];

    if (empty($usuario) || empty($nombre_completo) || empty($clave_plana)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        $clave_hasheada = md5($clave_plana);

        try {
            $sql = "INSERT INTO usuarios (usuario, nombre_completo, clave) VALUES (:usuario, :nombre_completo, :clave)";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':nombre_completo', $nombre_completo);
            $stmt->bindParam(':clave', $clave_hasheada);

            if ($stmt->execute()) {
                header("Location: index.php?mensaje=registrado");
                exit();
            }
        } catch(PDOException $e) {
            if ($e->getCode() == 23000) {
                $error = "El nombre de usuario ya existe.";
            } else {
                $error = "Error de base de datos.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Nuevo Registro</h1>
        
        <?php if(isset($error)): ?>
            <div class="alert alert-error">
                <i class='bx bx-error-circle'></i> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form action="Registrarse.php" method="POST">
            <div class="input-group">
                <label for="usuario">Usuario</label>
                <div class="input-wrapper">
                    <i class='bx bx-user'></i>
                    <input type="text" id="usuario" name="usuario" placeholder="Crea un usuario" required>
                </div>
            </div>

            <div class="input-group">
                <label for="nombre_completo">Nombre Completo</label>
                <div class="input-wrapper">
                    <i class='bx bx-id-card'></i>
                    <input type="text" id="nombre_completo" name="nombre_completo" placeholder="Tu nombre real" required>
                </div>
            </div>

            <div class="input-group">
                <label for="clave">Contraseña</label>
                <div class="input-wrapper">
                    <i class='bx bx-lock-alt'></i>
                    <input type="password" id="clave" name="clave" placeholder="Crea una contraseña" required>
                </div>
            </div>

            <button type="submit"><i class='bx bx-user-plus'></i> Registrarse</button>
            <p class="enlace-login">¿Ya tienes cuenta? <a href="index.php">Inicia Sesión</a></p>
        </form>
    </div>
</body>
</html>