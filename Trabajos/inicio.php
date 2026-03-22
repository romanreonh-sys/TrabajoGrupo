<?php
session_start();
if (!isset($_SESSION['Id'])) {
    header("Location: index.php");
    exit();
}
require 'conexion.php';
$usuario_id = $_SESSION['Id'];

$stmt = $pdo->prepare("SELECT * FROM tareas WHERE usuario_id = :usuario_id ORDER BY id_tarea DESC");
$stmt->execute(['usuario_id' => $usuario_id]);
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TO DO LIST</title>
</head>
<body>
    <div>
        <div>
            <h1>TO DO LIST</h1>
            <p>Usuario activo: <?php echo htmlspecialchars($_SESSION['Usuario']); ?></p>
        </div>

        <div>
            <section>
                <h2>Pomodoro Time</h2>
                <p id="time-display">25:00</p>
                <div>
                    <button type="button" onclick="startTimer()">Iniciar</button>
                    <button type="button" onclick="pauseTimer()">Pausar</button>
                    <button type="button" onclick="resetTimer()">Reiniciar</button>
                </div>
            </section>

            <section>
                <h2>Tareas</h2>
                <form method="POST" action="agregar_tarea.php">
                    <input type="text" name="descripcion" placeholder="Nueva tarea..." required>
                    <button type="submit" name="add">Añadir</button>
                </form>

                <table>
                    <thead>
                        <tr><th>Tarea</th><th>Estado</th><th>Acciones</th></tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tareas as $fetch) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($fetch['descripcion']); ?></td>
                            <td><?php echo htmlspecialchars($fetch['estado']); ?></td>
                            <td>
                                <?php if($fetch['estado'] != 'Hecho'): ?>
                                    <a href="editar_tarea.php?id_tarea=<?php echo $fetch['id_tarea']; ?>">Completar</a>
                                <?php endif; ?>
                                <a href="eliminar_tarea.php?id_tarea=<?php echo $fetch['id_tarea']; ?>">Eliminar</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </div>
        <div>
            <a href="CerrarSesion.php">Cerrar Sesión</a>
        </div>
    </div>

    <script>
        // Lógica del Pomodoro
        let timerInterval; let isRunning = false; let timeRemaining = 25 * 60; let endTime;
        const display = document.getElementById('time-display');

        function updateDisplay(sec) {
            const m = Math.floor(sec / 60).toString().padStart(2, '0');
            const s = (sec % 60).toString().padStart(2, '0');
            display.textContent = `${m}:${s}`;
        }
        function runTimer() {
            const diff = Math.round((endTime - Date.now()) / 1000);
            if (diff <= 0) { clearInterval(timerInterval); isRunning = false; updateDisplay(0); alert("¡Tiempo!"); } 
            else { timeRemaining = diff; updateDisplay(timeRemaining); }
        }
        function startTimer() { if (isRunning) return; isRunning = true; endTime = Date.now() + (timeRemaining * 1000); timerInterval = setInterval(runTimer, 1000); }
        function pauseTimer() { if (!isRunning) return; clearInterval(timerInterval); isRunning = false; }
        function resetTimer() { clearInterval(timerInterval); isRunning = false; timeRemaining = 25 * 60; updateDisplay(timeRemaining); }
    </script>
</body>
</html>