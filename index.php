<?php

require_once 'db.php';

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

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Pokédex</title>
</head>
<body>


<main class="container mt-5">
    <h1 class="text-center mb-4">Mi Pokédex</h1>


    <div class="row">

        <?php while ($pokemon = $resultado->fetch_assoc()) : ?>


            <div class="col-md-4 col-12 mb-4">

                <div class="card h-100 shadow-sm">

                    <img src="<?php echo $pokemon['imagen_ruta']; ?>" class="card-img-top"
                         alt="<?php echo $pokemon['nombre']; ?>">

                    <div class="card-body text-center">

                        <h5 class="card-title"><?php echo $pokemon['nombre']; ?></h5>


                        <p class="card-text">Tipo:<img src="assets/tipos/<?php echo $iconosTipos[$pokemon['tipo']]; ?>"
                                                       alt="<?php echo $pokemon['tipo']; ?>" width="20"></p>
                    </div>
                </div>


            </div>

        <?php endwhile; ?>

    </div>
</main>


</body>
</html>
