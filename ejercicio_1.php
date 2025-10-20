<?php
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Datos del cilindro
    $radio = floatval($_POST['radio'] ?? 0);
    $altura_cil = floatval($_POST['altura_cil'] ?? 0);

    // Datos del rectángulo
    $base_rect = floatval($_POST['base_rect'] ?? 0);
    $altura_rect = floatval($_POST['altura_rect'] ?? 0);

    // Cálculos
    if ($radio > 0 && $altura_cil > 0) {
        $area_cil = 2 * pi() * $radio * ($radio + $altura_cil); // Área superficie
        $volumen_cil = pi() * pow($radio, 2) * $altura_cil;    // Volumen (opcional)
        $mensaje .= "<h3>Cilindro:</h3>";
        $mensaje .= "Área superficial: " . round($area_cil, 2) . "<br>";
        $mensaje .= "Volumen: " . round($volumen_cil, 2) . "<br>";
    }

    if ($base_rect > 0 && $altura_rect > 0) {
        $area_rect = $base_rect * $altura_rect;
        $perimetro_rect = 2 * ($base_rect + $altura_rect);
        $mensaje .= "<h3>Rectángulo:</h3>";
        $mensaje .= "Área: " . round($area_rect, 2) . "<br>";
        $mensaje .= "Perímetro: " . round($perimetro_rect, 2) . "<br>";
    }

    if (!$mensaje) {
        $mensaje = "Por favor, ingrese valores válidos.";
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
            padding: 20px;
            background: #f4f4f4;
        }
        .formulario {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            margin: auto;
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
            margin-top: 20px;
            background: #e2e2e2;
            padding: 15px;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="formulario">
        <h2>Calculadora de Área y Perímetro</h2>

        <form method="POST" action="">
            <h3>Cilindro</h3>
            <label>Radio:</label>
            <input type="number" step="0.01" name="radio" required>
            <label>Altura:</label>
            <input type="number" step="0.01" name="altura_cil" required>

            <h3>Rectángulo</h3>
            <label>Base:</label>
            <input type="number" step="0.01" name="base_rect" required>
            <label>Altura:</label>
            <input type="number" step="0.01" name="altura_rect" required>

            <button type="submit">Calcular</button>
        </form>

        <?php if ($mensaje): ?>
            <div class="resultado">
                <?= $mensaje ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
