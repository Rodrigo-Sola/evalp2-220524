<?php
session_start();

// Verificar sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lado1 = floatval($_POST['lado1'] ?? 0);
    $lado2 = floatval($_POST['lado2'] ?? 0);
    $lado3 = floatval($_POST['lado3'] ?? 0);

    // Validar que los lados formen un triángulo
    if ($lado1 > 0 && $lado2 > 0 && $lado3 > 0 &&
        $lado1 + $lado2 > $lado3 &&
        $lado1 + $lado3 > $lado2 &&
        $lado2 + $lado3 > $lado1) {

        // Determinar tipo de triángulo
        if ($lado1 == $lado2 && $lado2 == $lado3) {
            $tipo = "Equilátero";
        } elseif ($lado1 == $lado2 || $lado1 == $lado3 || $lado2 == $lado3) {
            $tipo = "Isósceles";
        } else {
            $tipo = "Escaleno";
        }

        $mensaje = "El triángulo con lados $lado1, $lado2 y $lado3 es <strong>$tipo</strong>.";
    } else {
        $mensaje = "Los valores ingresados no forman un triángulo válido.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2 - Tipo de Triángulo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
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

        .formulario {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            margin: 40px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        input[type=number] {
            width: 100%;
            padding: 8px;
            margin: 8px 0 15px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }

        .resultado {
            margin-top: 15px;
            background: #e2e2e2;
            padding: 12px;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="dashboard.php">Dashboard</a>
        <a href="ejercicio_1.php">Ejercicio 1</a>
        <a href="ejercicio_2.php">Ejercicio 2</a>
        <a href="pagina1.php">Página 1</a>
        <a href="pagina2.php">Página 2</a>
        <span class="usuario">Usuario: <?= htmlspecialchars($_SESSION['usuario']) ?></span>
        <a href="logout.php">Cerrar sesión</a>
    </div>

    <!-- Formulario Triángulo -->
    <div class="formulario">
        <h2>Determinar Tipo de Triángulo</h2>
        <form method="POST" action="">
            <label>Lado 1:</label>
            <input type="number" step="0.01" name="lado1" required>
            <label>Lado 2:</label>
            <input type="number" step="0.01" name="lado2" required>
            <label>Lado 3:</label>
            <input type="number" step="0.01" name="lado3" required>

            <button type="submit">Calcular Triángulo</button>
        </form>

        <?php if ($mensaje): ?>
            <div class="resultado"><?= $mensaje ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
