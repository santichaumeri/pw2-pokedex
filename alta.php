<?php
    session_start();
    require_once "db.php";
    /** @var mysqli $conexion */
    $error = null;

    $numero_id = "";
    $nombre = "";
    $tipo = "";
    $descripcion = "";
    $imagen = "";
    $altura_m = "";
    $peso_kg = "";
    $habitat = "";
    $color = "";
    $habilidad = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $numero_id = $_POST["numero_id"];
    $nombre = $_POST["nombre"];
    $tipo = $_POST["tipo"];
    $descripcion = $_POST["descripcion"];
    $altura_m = $_POST["altura_m"];
    $peso_kg = $_POST["peso_kg"];
    $habitat = $_POST["habitat"];
    $color = $_POST["color"];
    $habilidad = $_POST["habilidad"];

    if ($_FILES["imagen"]["error"] == UPLOAD_ERR_NO_FILE) {
        $error = "El archivo es obligatorio.";
    }else{


    $nombre_archivo = $_FILES["imagen"]["name"];
    $tipo_archivo = $_FILES["imagen"]["type"];
    $tamano_archivo = $_FILES["imagen"]["size"] / 1024; // KB

    $rutaArchivo = "imagenes/" . $nombre_archivo;
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaArchivo)){

        $stmt = $conexion->prepare("
                INSERT INTO pokemons 
                    (numero_id, nombre, tipo, descripcion, imagen_ruta, altura_m, peso_kg, habitat, color, habilidad) 
                VALUES 
                    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

        $stmt->bind_param(
                "issssddsss",
                $numero_id,
                $nombre,
                $tipo,
                $descripcion,
                $rutaArchivo,
                $altura_m,
                $peso_kg,
                $habitat,
                $color,
                $habilidad
        );
        $stmt->execute();
        $_SESSION['mensaje'] = "Pokemon agregado correctamente. ";
        header('Location: index.php');
        exit();


    }else{
        $error = "Error al subir la imagen.";
    }
    }
}





    include 'header.php';
?>

<style>
    .alta-wrapper {
        max-width: 600px;
        margin: 0 auto;
    }

    .alta-title {
        font-family: 'Press Start 2P', monospace;
        font-size: 13px;
        color: #cc0000;
        text-align: center;
        margin-bottom: 30px;
        line-height: 1.8;
    }

    .alta-card {
        background: #16213e;
        border: 2px solid #0f3460;
        border-radius: 20px;
        padding: 36px;
    }

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
</style>

<div class="alta-wrapper">
    <h1 class="alta-title">Agregar Pokémon</h1>

    <div class="alta-card">
        <form action="alta.php" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label class="form-label" for="numero_id">Número identificador</label>
                <input type="number" id="numero_id" name="numero_id" class="form-input" placeholder="Ej: 25" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-input" placeholder="Ej: Pikachu" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="tipo">Tipo</label>
                <select id="tipo" name="tipo" class="form-select" required>
                    <option value="" disabled selected>Seleccionar tipo...</option>
                    <option value="fuego">Fuego</option>
                    <option value="agua">Agua</option>
                    <option value="planta">Planta</option>
                    <option value="electrico">Eléctrico</option>
                    <option value="psiquico">Psíquico</option>
                    <option value="dragon">Dragón</option>
                    <option value="siniestro">Siniestro</option>
                    <option value="veneno">Veneno</option>
                    <option value="hielo">Hielo</option>
                    <option value="normal">Normal</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="form-textarea" placeholder="Descripción del Pokémon..."></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="imagen">Imagen</label>
                <input type="file" id="imagen" name="imagen" class="form-input" accept="image/*">
            </div>

            <div class="form-group">
                <label class="form-label" for="altura_m">Altura (m)</label>
                <input type="number" step="0.1" id="altura_m" name="altura_m" class="form-input" placeholder="Ej: 0.4">
            </div>

            <div class="form-group">
                <label class="form-label" for="peso_kg">Peso (kg)</label>
                <input type="number" step="0.1" id="peso_kg" name="peso_kg" class="form-input" placeholder="Ej: 6.0">
            </div>

            <div class="form-group">
                <label class="form-label" for="habitat">Hábitat</label>
                <input type="text" id="habitat" name="habitat" class="form-input" placeholder="Ej: bosque">
            </div>

            <div class="form-group">
                <label class="form-label" for="color">Color</label>
                <input type="text" id="color" name="color" class="form-input" placeholder="Ej: amarillo">
            </div>

            <div class="form-group">
                <label class="form-label" for="habilidad">Habilidad</label>
                <input type="text" id="habilidad" name="habilidad" class="form-input" placeholder="Ej: Electricidad Estática">
            </div>

            <div style="display: flex; gap: 10px; margin-top: 24px;">
                <button type="submit" class="btn-login">Agregar Pokémon</button>
            </div>

        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
