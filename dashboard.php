<?php
session_start();

// Verificar si hay sesión iniciada
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de usuario</title>
</head>
<body>
    <h1>Bienvenido al Dashboard, <?php echo htmlspecialchars($_SESSION['usuario']); ?> 👋</h1>
    <p>Has iniciado sesión correctamente.</p>

    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
