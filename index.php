<?php
require_once 'cn.php'; // incluir la clase de conexión

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $conexion = new cn();

    // Buscar el usuario
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $resultado = $conexion->consulta($sql);

    if ($resultado && $resultado->num_rows === 1) {
        $fila = $resultado->fetch_assoc();

        // Si las contraseñas están encriptadas con password_hash():
        if (password_verify($contrasena, $fila['contrasena'])) {
            $mensaje = "✅ Bienvenido, " . htmlspecialchars($fila['usuario']);
            // Aquí podrías iniciar sesión:
            // session_start();
            // $_SESSION['usuario'] = $fila['usuario'];
            // header('Location: panel.php');
            // exit;
        } else {
            $mensaje = "❌ Contraseña incorrecta.";
        }
    } else {
        $mensaje = "❌ Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            width: 300px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type=text], input[type=password] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: 100%;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .mensaje {
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <button type="submit">Ingresar</button>
        </form>

        <?php if ($mensaje): ?>
            <div class="mensaje"><?= $mensaje ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
