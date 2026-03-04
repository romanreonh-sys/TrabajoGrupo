<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Acceso</h1>
        
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-error">
                <i class='bx bx-error-circle'></i> <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php } ?>
        
        <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'registrado') { ?>
            <div class="alert alert-success">
                <i class='bx bx-check-circle'></i> Cuenta creada con éxito.
            </div>
        <?php } ?>

        <form action="InicioSesion.php" method="POST">
            <div class="input-group">
                <label for="username">Usuario</label>
                <div class="input-wrapper">
                    <i class='bx bx-user'></i>
                    <input type="text" name="Usuario" id="username" placeholder="Tu nombre de usuario" required>
                </div>
            </div>

            <div class="input-group">
                <label for="password">Contraseña</label>
                <div class="input-wrapper">
                    <i class='bx bx-lock-alt'></i>
                    <input type="password" name="Clave" id="password" placeholder="Tu contraseña" required>
                </div>
            </div>
            
            <button type="submit"><i class='bx bx-log-in'></i> Iniciar Sesión</button>
            <p class="enlace-login">¿No tienes cuenta? <a href="Registrarse.php">Regístrate aquí</a></p>
        </form>
    </div>
</body>
</html>