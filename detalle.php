<?php
session_start();
require_once 'db.php';

if (!isset($_GET['id'])) {
    header("location: index.php");
    exit();
}

$id = $_GET['id'];

$statement = $conexion->prepare("SELECT * FROM pokemons WHERE id=?");
$statement->bind_param("i", $id);
$statement->execute();
$resultado = $statement->get_result();

if ($resultado->num_rows === 0) {
    $_SESSION['error'] = 'no_existe';
    header("location: index.php");
    exit();
}

$pokemon = $resultado->fetch_assoc();

$iconosTipos = [
        'planta' => 'Grass.ico',
        'fuego' => 'Fire.ico',
        'agua' => 'Water.ico',
        'electrico' => 'Electric.ico',
        'psiquico' => 'Psychic.ico',
        'siniestro' => 'Ghost.ico',
        'dragon' => 'Dragon.ico',
];

include 'header.php';
?>

    <style>
        .detalle-wrapper {
            max-width: 860px;
            margin: 0 auto;
        }

        .detalle-card {
            background: #16213e;
            border: 2px solid #0f3460;
            border-radius: 20px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        @media (max-width: 600px) {
            .detalle-card { grid-template-columns: 1fr; }
        }

        .detalle-imagen {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #0f1b35;
        }

        .detalle-imagen img {
            max-height: 280px;
            object-fit: contain;
            width: 100%;
        }

        .detalle-info {
            padding: 36px;
        }

        .detalle-info h1 {
            font-family: 'Press Start 2P', monospace;
            font-size: 16px;
            color: #fff;
            text-transform: capitalize;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .detalle-info h5 {
            font-size: 11px;
            color: #555;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
            margin-top: 16px;
        }

        .detalle-info p {
            font-size: 15px;
            color: #ddd;
            font-weight: 700;
            margin: 0;
        }

        .detalle-info hr {
            border: none;
            border-top: 1px solid #0f3460;
            margin: 20px 0;
        }

        .detalle-info .btn-volver {
            display: inline-block;
            margin-top: 24px;
            padding: 10px 22px;
            background: transparent;
            border: 2px solid #555;
            border-radius: 10px;
            color: #eee;
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .detalle-info .btn-volver:hover {
            border-color: #eee;
            color: #fff;
        }
    </style>

    <div class="detalle-wrapper">
        <div class="detalle-card">

            <div class="detalle-imagen">
                <img src="<?php echo htmlspecialchars($pokemon['imagen_ruta']); ?>"
                     alt="<?php echo htmlspecialchars($pokemon['nombre']); ?>">
            </div>

            <div class="detalle-info">

                <h1><?php echo htmlspecialchars($pokemon['nombre']); ?></h1>

                <h5>Tipo</h5>
                <img src="assets/tipos/<?php echo htmlspecialchars($iconosTipos[$pokemon['tipo']]); ?>" width="35">

                <hr>

                <h5>Id</h5>
                <p><?php echo htmlspecialchars($pokemon['id']); ?></p>

                <h5>Número en Pokédex</h5>
                <p><?php echo htmlspecialchars($pokemon['numero_id']); ?></p>

                <h5>Descripción</h5>
                <p style="font-weight:400; color:#aaa; font-size:14px; line-height:1.7;"><?php echo htmlspecialchars($pokemon['descripcion']); ?></p>

                <h5>Habitat</h5>
                <p><?php echo htmlspecialchars($pokemon['habitat']); ?></p>

                <h5>Peso</h5>
                <p><?php echo htmlspecialchars($pokemon['peso_kg']) . " KG"; ?></p>

                <h5>Altura</h5>
                <p><?php echo htmlspecialchars($pokemon['altura_m']) . " MTS"; ?></p>

                <a href="index.php" class="btn-volver">← Volver a la Pokédex</a>

            </div>
        </div>
    </div>

<?php
$statement->close();
$conexion->close();
include 'footer.php';
?>