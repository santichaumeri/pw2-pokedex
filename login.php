<?php
require_once "db.php";
/** @var mysqli $conexion */

if (isset($_SESSION["admin"])) {
    header('Location: index.php');
    exit();
}

$error = null;


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt-> bind_param("s", $_POST["usuario"]);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if($user != null && password_verify($_POST["password"], $user["password"])) {
        $_SESSION["admin"] = $user;
        header('Location: index.php');
        exit();
    }else{
        $error = "Usuario o contraseña incorrectos";
    }

}
$error = isset($error) ? $error : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin – Pokédex</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #1a1a2e;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header mínimo */
        .mini-header {
            background: linear-gradient(135deg, #cc0000, #ff1a1a, #cc0000);
            border-bottom: 6px solid #8b0000;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .mini-header::before {
            content: '';
            display: block;
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 8px;
        }

        .pokeball-sm {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(180deg, #fff 50%, #cc0000 50%);
            border: 3px solid #333;
            position: relative;
            box-shadow: 0 0 0 2px #fff, 0 0 0 4px #333;
            flex-shrink: 0;
        }

        .pokeball-sm::before {
            content: '';
            position: absolute;
            top: 50%; left: 0; right: 0;
            height: 3px;
            background: #333;
            transform: translateY(-50%);
        }

        .pokeball-sm::after {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            width: 10px; height: 10px;
            background: #fff;
            border: 2px solid #333;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }

        .mini-header a {
            font-family: 'Press Start 2P', monospace;
            font-size: 14px;
            color: #fff;
            text-decoration: none;
            text-shadow: 2px 2px 0 #8b0000;
        }

        /* Contenedor central */
        .login-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .login-card {
            background: #16213e;
            border: 2px solid #0f3460;
            border-radius: 20px;
            padding: 40px 36px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        }

        /* Ícono pokeball grande */
        .login-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(180deg, #fff 50%, #cc0000 50%);
            border: 5px solid #333;
            position: relative;
            box-shadow: 0 0 0 4px #fff, 0 0 0 6px #333;
            margin: 0 auto 24px;
        }

        .login-icon::before {
            content: '';
            position: absolute;
            top: 50%; left: 0; right: 0;
            height: 5px;
            background: #333;
            transform: translateY(-50%);
        }

        .login-icon::after {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            width: 18px; height: 18px;
            background: #fff;
            border: 4px solid #333;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }

        .login-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 12px;
            color: #cc0000;
            text-align: center;
            line-height: 1.8;
            margin-bottom: 8px;
        }

        .login-subtitle {
            font-size: 13px;
            color: #666;
            text-align: center;
            margin-bottom: 32px;
        }

        /* Error message */
        .error-msg {
            background: #4a1a1a;
            border: 2px solid #e74c3c;
            color: #e74c3c;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Formulario */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 13px 18px;
            background: #0f1b35;
            border: 2px solid #0f3460;
            border-radius: 12px;
            color: #eee;
            font-family: 'Nunito', sans-serif;
            font-size: 15px;
            font-weight: 700;
            outline: none;
            transition: border 0.2s, box-shadow 0.2s;
        }

        .form-input:focus {
            border-color: #cc0000;
            box-shadow: 0 0 0 3px rgba(204,0,0,0.15);
        }

        .form-input::placeholder {
            color: #3a4a6a;
            font-weight: 400;
        }

        /* Submit */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #cc0000, #ff1a1a);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-family: 'Nunito', sans-serif;
            font-weight: 900;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 8px;
            letter-spacing: 0.5px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #ff1a1a, #cc0000);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(204,0,0,0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Volver */
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #555;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #cc0000;
        }

        /* Footer */
        footer {
            background: #0d0d1a;
            border-top: 3px solid #cc0000;
            padding: 20px;
            text-align: center;
        }

        footer p {
            font-size: 12px;
            color: #444;
        }
    </style>
</head>
<body>

<!-- Header mínimo -->
<div class="mini-header">
    <div class="pokeball-sm"></div>
    <a href="index.php">Pokédex</a>
</div>

<!-- Login -->
<div class="login-wrapper">
    <div class="login-card">

        <div class="login-icon"></div>

        <h1 class="login-title">Área<br>Admin</h1>
        <p class="login-subtitle">Ingresá tus credenciales para continuar</p>

        <?php if ($error): ?>
            <div class="error-msg"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">

            <div class="form-group">
                <label class="form-label" for="usuario">Usuario</label>
                <input
                    type="text"
                    id="usuario"
                    name="usuario"
                    class="form-input"
                    placeholder="admin"
                    required
                    autocomplete="username"
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Contraseña</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                >
            </div>

            <button type="submit" class="btn-login">Ingresar</button>

        </form>

        <a href="index.php" class="back-link">← Volver al Pokédex</a>

    </div>
</div>

<footer>
    <p>Programación Web Avanzada &mdash; 2022</p>
</footer>

</body>
</html>
