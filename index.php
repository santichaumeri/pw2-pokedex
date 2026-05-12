<?php

require_once 'db.php';
/** @var mysqli $conexion */
$resultado = $conexion->query("SELECT * FROM pokemons ORDER BY numero_id ASC");

/*
while ($pokemon = $resultado->fetch_assoc()) {
echo $pokemon["id"] . "<br>";
echo $pokemon["nombre"] . "<br>";
}
*/

$iconosTipos = [
        'planta' => 'Grass.ico',
        'fuego' => 'Fire.ico',
        'agua' => 'Water.ico',
        'electrico' => 'Electric.ico',
        'psiquico' => 'Psychic.ico',
        'siniestro' => 'Ghost.ico',
        'dragon' => 'Dragon.ico',
];


?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<!-- Contenedor principal de Bootstrap -->
<main class="container mt-5">
    <h1 class="text-center mb-4">Mi Pokédex</h1>

    <!-- Iniciamos la grilla -->
    <div class="row">

        <?php while ($pokemon = $resultado->fetch_assoc()) : ?>


            <div class="col-md-4 col-12 mb-4">

                <div class="card h-100 shadow-sm">

                    <img src="<?php echo $pokemon['imagen_ruta'];?>" class="card-img-top" alt="<?php echo $pokemon['nombre'];?>">

                    <div class="card-body text-center">

                        <h5 class="card-title"><?php echo $pokemon['nombre']; ?></h5>


                        <p class="card-text">Tipo:<img src="assets/tipos/<?php echo $iconosTipos[$pokemon['tipo']];?>" alt="<?php echo $pokemon['tipo'];?>" width="20"> </p>
                    </div>
                </div>


            </div>

        <?php endwhile; ?>

    </div>
</main>


</body>
</html>
