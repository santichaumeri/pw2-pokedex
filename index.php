<?php
session_start();
require_once 'db.php';
/** @var mysqli $conexion */
$resultado = $conexion->query("SELECT * FROM pokemons ORDER BY numero_id ASC");

$iconosTipos = [
        'planta' => 'Grass.ico',
        'fuego' => 'Fire.ico',
        'agua' => 'Water.ico',
        'electrico' => 'Electric.ico',
        'psiquico' => 'Psychic.ico',
        'siniestro' => 'Ghost.ico',
        'dragon' => 'Dragon.ico',
];


if (isset($_GET['search'])) {
    $busqueda = $_GET['search'];

    $statement = $conexion->prepare("SELECT * FROM pokemons WHERE nombre LIKE ?");

    $string = $busqueda . "%";
    $statement->bind_param("s", $string);
    $statement->execute();

    $resultadoBusqueda = $statement->get_result();

    if ($resultadoBusqueda->num_rows === 1) {
        $pokemon = $resultadoBusqueda->fetch_assoc();
        if (strtolower($busqueda) === strtolower($pokemon['nombre'])) {
            header('Location: detalle.php?id=' . $pokemon['id']);
            exit();
        }else{
            $resultadoBusqueda->data_seek(0);
            $resultado = $resultadoBusqueda;
        }

    } elseif ($resultadoBusqueda->num_rows === 0) {
        $_SESSION['error'] = 'no_existe';
        header('Location: index.php');
        exit();
    } else {
        $resultado = $resultadoBusqueda;
    }
} else {
    $resultado = $conexion->query("SELECT * FROM pokemons ORDER BY numero_id ASC");
}

include 'header.php';
?>

    <style>
        .container-index {
            max-width: 960px;
            margin: 0 auto;
        }

        .buscador-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
        }

        .buscador-inner {
            display: flex;
            width: 100%;
            max-width: 500px;
            gap: 0;
        }

        .buscador-inner input {
            flex: 1;
            padding: 12px 18px;
            background: #0f1b35;
            border: 2px solid #0f3460;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: #eee;
            font-family: 'Nunito', sans-serif;
            font-size: 14px;
            font-weight: 700;
            outline: none;
            transition: border 0.2s;
        }

        .buscador-inner input:focus {
            border-color: #cc0000;
        }

        .buscador-inner input::placeholder {
            color: #3a4a6a;
            font-weight: 400;
        }

        .buscador-inner button {
            padding: 12px 22px;
            background: #cc0000;
            border: 2px solid #cc0000;
            border-radius: 0 12px 12px 0;
            color: #fff;
            font-family: 'Nunito', sans-serif;
            font-weight: 900;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .buscador-inner button:hover {
            background: #ff1a1a;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            justify-items: center;
        }

        .pokemon-card {
            background: #16213e;
            border: 2px solid #0f3460;
            border-radius: 16px;
            width: 100%;
            overflow: hidden;
            transition: all 0.25s ease;
        }

        .pokemon-card:hover {
            border-color: #cc0000;
            box-shadow: 0 8px 25px rgba(204,0,0,0.3);
            transform: translateY(-4px);
        }

        .pokemon-card img.card-img-top {
            width: 100%;
            height: 160px;
            object-fit: contain;
            background: #0f1b35;
            padding: 16px;
        }

        .pokemon-card .card-body {
            padding: 16px;
            text-align: center;
        }

        .pokemon-card .card-title {
            color: #fff;
            font-weight: 900;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .pokemon-card .card-text {
            color: #aaa;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .pokemon-card .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background: #cc0000;
            border: none;
            border-radius: 10px;
            color: #fff;
            font-family: 'Nunito', sans-serif;
            font-weight: 900;
            font-size: 13px;
            text-decoration: none;
            transition: background 0.2s;
            margin-top: 12px;
        }

        .pokemon-card .btn:hover {
            background: #ff1a1a;
            color: #fff;
        }
    </style>

<?php if (isset($_SESSION['error']) && $_SESSION['error'] == 'no_existe'): ?>
    <div class="flash-message flash-error">El Pokémon que buscás no existe.</div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

    <div class="container-index">

        <!-- Buscador -->
        <div class="buscador-wrapper">
            <form action="index.php" method="GET" class="buscador-inner">
                <input
                        type="text"
                        name="search"
                        placeholder="Buscar Pokémon por nombre..."
                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                >
                <button type="submit">Buscar</button>
            </form>
        </div>

        <!-- Cards -->
        <div class="cards-grid">
            <?php while ($pokemon = $resultado->fetch_assoc()): ?>
                <div class="pokemon-card">
                    <img src="<?php echo $pokemon['imagen_ruta']; ?>" class="card-img-top"
                         alt="<?php echo $pokemon['nombre']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $pokemon['nombre']; ?></h5>
                        <p class="card-text">Tipo:
                            <img src="assets/tipos/<?php echo $iconosTipos[$pokemon['tipo']]; ?>"
                                 alt="<?php echo $pokemon['tipo']; ?>" style="width: 30px; height: 30px;">
                        </p>
                        <a href="detalle.php?id=<?php echo $pokemon['id']; ?>" class="btn">Ver detalle</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

    </div>

<?php
$conexion->close();
include 'footer.php';
?>