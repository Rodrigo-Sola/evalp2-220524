<?php
session_start();

// Verificar sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$mensaje_cil = '';
$mensaje_rect = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Determinar qué formulario se envió
    if (isset($_POST['calcular_cil'])) {
        $radio = floatval($_POST['radio'] ?? 0);
        $altura_cil = floatval($_POST['altura_cil'] ?? 0);

        if ($radio > 0 && $altura_cil > 0) {
            $area_cil = 2 * pi() * $radio * ($radio + $altura_cil);
            $volumen_cil = pi() * pow($radio, 2) * $altura_cil;
            $mensaje_cil = "Área superficial: " . round($area_cil, 2) . "<br>Volumen: " . round($volumen_cil, 2);
        } else {
            $mensaje_cil = "Ingrese valores válidos para el cilindro.";
        }

    } elseif (isset($_POST['calcular_rect'])) {
        $base_rect = floatval($_POST['base_rect'] ?? 0);
        $altura_rect = floatval($_POST['altura_rect'] ?? 0);

        if ($base_rect > 0 && $altura_rect > 0) {
            $area_rect = $base_rect * $altura_rect;
            $perimetro_rect = 2 * ($base_rect + $altura_rect);
            $mensaje_rect = "Área: " . round($area_rect, 2) . "<br>Perímetro: " . round($perimetro_rect, 2);
        } else {
            $mensaje_rect = "Ingrese valores válidos para el rectángulo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1 - Área y Perímetro</title>
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
            margin: 20px auto;
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
        <a href="ejercicio_2.php">Página 2</a>
        <span class="usuario">Usuario: <?= htmlspecialchars($_SESSION['usuario']) ?></span>
        <a href="logout.php">Cerrar sesión</a>
    </div>

    <!-- Formulario cilindro -->
    <div class="formulario">
        <h2>Cálculo Cilindro</h2>
        <form method="POST" action="">
            <label>Radio:</label>
            <input type="number" step="0.01" name="radio" required>
            <label>Altura:</label>
            <input type="number" step="0.01" name="altura_cil" required>

            <button type="submit" name="calcular_cil">Calcular Cilindro</button>
        </form>

        <?php if ($mensaje_cil): ?>
            <div class="resultado"><?= $mensaje_cil ?></div>
        <?php endif; ?>
    </div>

    <!-- Formulario rectángulo -->
    <div class="formulario">
        <h2>Cálculo Rectángulo</h2>
        <form method="POST" action="">
            <label>Base:</label>
            <input type="number" step="0.01" name="base_rect" required>
            <label>Altura:</label>
            <input type="number" step="0.01" name="altura_rect" required>

            <button type="submit" name="calcular_rect">Calcular Rectángulo</button>
        </form>

        <?php if ($mensaje_rect): ?>
            <div class="resultado"><?= $mensaje_rect ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
