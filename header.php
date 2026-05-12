<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex</title>

    <!-- W3CSS -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #1a1a2e;
            color: #eee;
            min-height: 100vh;
        }

        /* ── HEADER ── */
        .pokedex-header {
            background: linear-gradient(135deg, #cc0000 0%, #ff1a1a 50%, #cc0000 100%);
            border-bottom: 6px solid #8b0000;
            padding: 0;
            position: relative;
            box-shadow: 0 4px 20px rgba(0,0,0,0.5);
        }

        /* Detalle superior decorativo */
        .pokedex-header::before {
            content: '';
            display: block;
            height: 8px;
            background: repeating-linear-gradient(
                90deg,
                #ff4444 0px,
                #ff4444 20px,
                #cc0000 20px,
                #cc0000 40px
            );
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        /* Logo */
        .pokedex-logo {
            display: flex;
            align-items: center;
            gap: 16px;
            text-decoration: none;
        }

        .pokeball-icon {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: linear-gradient(180deg, #fff 50%, #cc0000 50%);
            border: 4px solid #333;
            position: relative;
            box-shadow: 0 0 0 3px #fff, 0 0 0 5px #333;
            flex-shrink: 0;
        }

        .pokeball-icon::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 4px;
            background: #333;
            transform: translateY(-50%);
        }

        .pokeball-icon::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 14px;
            height: 14px;
            background: #fff;
            border: 3px solid #333;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }

        .logo-text {
            font-family: 'Press Start 2P', monospace;
            font-size: 18px;
            color: #fff;
            text-shadow: 3px 3px 0px #8b0000, -1px -1px 0px #8b0000;
            letter-spacing: 1px;
            line-height: 1.4;
        }

        .logo-text span {
            display: block;
            font-size: 9px;
            color: #ffdd44;
            text-shadow: 1px 1px 0px #b38600;
            margin-top: 4px;
            letter-spacing: 2px;
        }

        /* Nav */
        .pokedex-nav {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .nav-btn {
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            font-size: 13px;
            padding: 8px 18px;
            border-radius: 999px;
            text-decoration: none;
            border: 2px solid transparent;
            transition: all 0.2s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .nav-btn-primary {
            background: #fff;
            color: #cc0000;
            border-color: #fff;
        }

        .nav-btn-primary:hover {
            background: #ffdd44;
            border-color: #ffdd44;
            color: #8b0000;
            transform: translateY(-1px);
        }

        .nav-btn-outline {
            background: transparent;
            color: #fff;
            border-color: rgba(255,255,255,0.6);
        }

        .nav-btn-outline:hover {
            background: rgba(255,255,255,0.15);
            border-color: #fff;
            transform: translateY(-1px);
        }

        .nav-btn-danger {
            background: #8b0000;
            color: #fff;
            border-color: #8b0000;
        }

        .nav-btn-danger:hover {
            background: #5c0000;
            border-color: #5c0000;
            transform: translateY(-1px);
        }

        /* Badge admin */
        .admin-badge {
            background: #ffdd44;
            color: #8b0000;
            font-size: 10px;
            font-weight: 900;
            padding: 2px 8px;
            border-radius: 999px;
            font-family: 'Nunito', sans-serif;
            letter-spacing: 1px;
        }

        /* Barra de búsqueda */
        .search-bar {
            background: rgba(0,0,0,0.25);
            border-top: 2px solid rgba(0,0,0,0.2);
            padding: 12px 24px;
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .search-input {
            flex: 1;
            padding: 10px 18px;
            border-radius: 999px;
            border: 2px solid rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.12);
            color: #fff;
            font-family: 'Nunito', sans-serif;
            font-size: 14px;
            font-weight: 700;
            outline: none;
            transition: border 0.2s;
        }

        .search-input::placeholder {
            color: rgba(255,255,255,0.55);
        }

        .search-input:focus {
            border-color: #ffdd44;
            background: rgba(255,255,255,0.18);
        }

        .search-btn {
            padding: 10px 22px;
            border-radius: 999px;
            border: none;
            background: #ffdd44;
            color: #8b0000;
            font-family: 'Nunito', sans-serif;
            font-weight: 900;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .search-btn:hover {
            background: #fff;
            transform: translateY(-1px);
        }

        /* ── MAIN CONTENT ── */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        /* Mensaje flash */
        .flash-message {
            padding: 12px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 700;
            font-size: 14px;
        }

        .flash-success {
            background: #1a4a2e;
            border: 2px solid #2ecc71;
            color: #2ecc71;
        }

        .flash-error {
            background: #4a1a1a;
            border: 2px solid #e74c3c;
            color: #e74c3c;
        }

        /* ── CARDS DE POKÉMON ── */
        .pokemon-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 10px;
        }

        .pokemon-card {
            background: #16213e;
            border: 2px solid #0f3460;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            text-decoration: none;
            color: #eee;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .pokemon-card::before {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }

        .pokemon-card:hover {
            transform: translateY(-6px);
            border-color: #cc0000;
            box-shadow: 0 8px 25px rgba(204,0,0,0.3);
            color: #fff;
        }

        .pokemon-card img {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }

        .pokemon-card .pokemon-number {
            font-size: 11px;
            color: #888;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .pokemon-card .pokemon-name {
            font-size: 16px;
            font-weight: 900;
            margin: 8px 0 6px;
            text-transform: capitalize;
        }

        /* Tipo badge */
        .tipo-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .tipo-fuego     { background: #7a2000; color: #ff6b35; }
        .tipo-agua      { background: #003366; color: #66b3ff; }
        .tipo-planta    { background: #1a3d00; color: #66cc44; }
        .tipo-electrico { background: #4d3d00; color: #ffdd44; }
        .tipo-hielo     { background: #003344; color: #88ddff; }
        .tipo-veneno    { background: #2d0044; color: #cc66ff; }
        .tipo-psiquico  { background: #440033; color: #ff66bb; }
        .tipo-dragon    { background: #1a0066; color: #8866ff; }
        .tipo-siniestro { background: #1a1a1a; color: #aaaaaa; }
        .tipo-normal    { background: #2a2a2a; color: #cccccc; }

        /* ── BOTONES GENERALES ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 22px;
            border-radius: 999px;
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #cc0000;
            color: #fff;
            border-color: #cc0000;
        }

        .btn-primary:hover {
            background: #ff1a1a;
            border-color: #ff1a1a;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: transparent;
            color: #eee;
            border-color: #555;
        }

        .btn-secondary:hover {
            border-color: #eee;
            transform: translateY(-1px);
        }

        .btn-danger {
            background: #8b0000;
            color: #fff;
            border-color: #8b0000;
        }

        .btn-danger:hover {
            background: #cc0000;
            border-color: #cc0000;
        }

        /* ── FORMULARIOS ── */
        .form-card {
            background: #16213e;
            border: 2px solid #0f3460;
            border-radius: 16px;
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
        }

        .form-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 14px;
            color: #cc0000;
            margin-bottom: 24px;
            text-align: center;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            background: #0f1b35;
            border: 2px solid #0f3460;
            border-radius: 10px;
            color: #eee;
            font-family: 'Nunito', sans-serif;
            font-size: 14px;
            font-weight: 700;
            outline: none;
            transition: border 0.2s;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: #cc0000;
        }

        .form-select option {
            background: #0f1b35;
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }
    </style>
</head>
<body>

<header class="pokedex-header">
    <div class="header-inner">
        <a href="index.php" class="pokedex-logo">
            <div class="pokeball-icon"></div>
            <div class="logo-text">
                Pokédex
                <span>Prog. Web Avanzada</span>
            </div>
        </a>

        <nav class="pokedex-nav">
            <?php if (isset($_SESSION['admin'])): ?>
                <span class="admin-badge">ADMIN</span>
                <a href="alta.php" class="nav-btn nav-btn-primary">+ Agregar</a>
                <a href="logout.php" class="nav-btn nav-btn-danger">Salir</a>
            <?php else: ?>
                <a href="index.php" class="nav-btn nav-btn-outline">Inicio</a>
                <a href="login.php" class="nav-btn nav-btn-primary">Admin</a>
            <?php endif; ?>
        </nav>
    </div>

    <!-- Barra de búsqueda -->
    <form action="index.php" method="GET" class="search-bar">
        <input
            type="text"
            name="search"
            class="search-input"
            placeholder="Buscar Pokémon..."
            value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
        >
        <button type="submit" class="search-btn">Buscar</button>
    </form>
</header>

<div class="main-content">

<?php
// Mostrar mensajes flash si existen
if (isset($_SESSION['mensaje'])): ?>
    <div class="flash-message flash-success">
        <?= htmlspecialchars($_SESSION['mensaje']) ?>
    </div>
<?php
    unset($_SESSION['mensaje']);
endif;
?>