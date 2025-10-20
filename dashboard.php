<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }

        /* Navbar */
        .navbar {
            background-color: #007bff;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #0056b3;
        }
        .navbar .usuario {
            float: right;
            padding: 14px 20px;
            color: #fff;
        }

        main {
            padding: 30px;
            text-align: center;
        }

        a.button {
            display: inline-block;
            margin: 10px;
            background: #28a745;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 6px;
        }
        a.button:hover {
            background: #218838;
        }

        a.logout {
            background: #dc3545;
        }
        a.logout:hover {
            background: #b52a37;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <a href="dashboard.php">Inicio</a>
        <a href="pagina1.php">Página 1</a>
        <a href="pagina2.php">Página 2</a>
        <span class="usuario">Usuario: <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
    </div>

    <!-- Contenido principal -->
    <main>
        <h1>Bienvenido al Dashboard, <?php echo htmlspecialchars($_SESSION['usuario']); ?> 👋</h1>
        <p>Selecciona una opción del menú para navegar.</p>

        <div>
            <a class="button" href="pagina1.php">Ir a Página 1</a>
            <a class="button" href="pagina2.php">Ir a Página 2</a>
            <a class="button logout" href="logout.php">Cerrar sesión</a>
        </div>
    </main>

</body>
</html>
