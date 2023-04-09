<?php

require "../../includes/funciones.php";
$auth = estaAutenticado();
if (!$auth) {
    header("Location: /");
}

//BASE DE DATOS
require "../../includes/config/database.php";
$db = conectarDB();


//CONSULTAR PARA OBTENER LOS VENDEDORES
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);


//ARREGLO CON MSJ DE ERRORES
$errores = [];

$titulo = "";
$precio = "";
$descripcion = "";
$habitaciones = "";
$wc = "";
$estacionamiento = "";
$vendedorId = "";


//EJECUTA EL CODIGO DESPUES DE QUE EL USUARIO ENVIA EL FORMULARIO
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    //SANITIZAR
    //$resultado = filter_var($variable, FILTER_SANITIZE_EMAIL);
    //$resultado = filter_var($variable, FILTER_VALIDATE_EMAIL);

    //exit;

    /* echo "<pre>";
    var_dump($_POST);
    echo "</pre>"; */
    /*$_POST | $_GET Post esconde los datos y get los muestra en la URL*/

    /*echo "<pre>";
    var_dump($_FILES);
    echo "</pre>"; PARA TODO SOBRE EL ARCHIVO*/

    $titulo =mysqli_real_escape_string($db, $_POST["titulo"]);
    $precio =mysqli_real_escape_string($db, $_POST["precio"]);
    $descripcion =mysqli_real_escape_string($db, $_POST["descripcion"]);
    $habitaciones =mysqli_real_escape_string($db, $_POST["habitaciones"]);
    $wc =mysqli_real_escape_string($db, $_POST["wc"]);
    $estacionamiento =mysqli_real_escape_string($db, $_POST["estacionamiento"]);
    $vendedorId =mysqli_real_escape_string($db, $_POST["vendedor"]);
    $creado = date("Y/m/d");

    //ASIGNAR FILES HACIA UNA VARIABLE
    $imagen = $_FILES['imagen'];


    if (!$titulo) {
        $errores[] = "Debes añadir un titulo";
    }

    if (!$precio) {
        $errores[] = "El precio es obligatorio";
    }

    if (strlen($descripcion) < 50) {
        $errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
    }

    if (!$habitaciones) {
        $errores[] = "El numero de habitaciones es obligatorio";
    }

    if (!$wc) {
        $errores[] = "El numero de Wc es obligatorio";
    }
    if (!$estacionamiento) {
        $errores[] = "El numero de lugares de estacionamiento es obligatorio";
    }
    if (!$vendedorId) {
        $errores[] = "Elige un vendedor";
    }
if(!$imagen["name"] || $imagen["error"]){
    $errores[] = "La imagen es obligatoria";
}

//VALIDAR POR TAMANO (100 kb por tamano)
$medida = 1000 * 1000; //SON BYTES 100,000 bytes = 100kb // 1,000,000 bytes = 1Mb
if($imagen["size"]> $medida){
    $errores[] = "La imagen es muy pesada";
}


    /*echo "<pre>";
    var_dump($errores);
    echo "</pre>";*/
    

    //REVISAR QUE EL ARREGLO DE ERRORES ESTE VACIO
    if (empty($errores)) {
//SUBIDA DE ARCHIVOS---------------


//CREAR UNA CARPETA
$carpetaImagenes = "../../imagenes/";
if(!is_dir($carpetaImagenes)){
    mkdir($carpetaImagenes);
} 

//GENERAR UN NOMBRE UNICO
$nombreImagen =md5(uniqid(rand(),true)).".jpg";

//SUBIR LA IMAGEN
move_uploaded_file($imagen["tmp_name"],$carpetaImagenes.$nombreImagen);   //tmp_name es el filename



        //INSERTAR EN LA BASE DE DATOS
        $query = "INSERT INTO propiedades (titulo, precio,imagen ,descripcion, habitaciones, wc, estacionamiento,creado, vendedores_id) 
    VALUES ('$titulo', '$precio','$nombreImagen','$descripcion','$habitaciones','$wc','$estacionamiento','$creado','$vendedorId')";

        //echo $query;

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            //REDIRECCIONAR AL USUARIO. EN LA REDIRECCION PREVIAMENTE NO PUEDE HABER CODIGO HTML
            header("Location: /admin?resultado=1");
        }
    }
}

incluirTemplate("header");
?>


    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="../index.php" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio propiedad" min="0" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripcion:</label>
                <textarea id="descripcion" name="descripcion"> <?php echo $descripcion; ?> </textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion Propiedad</legend>
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedor">
                    <option value="">--Seleccione--</option>
                   
                    <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                        <option <?php echo $vendedorId === $vendedor["id"] ? "selected" : ""; ?> value="<?php echo $vendedor["id"];?>"> <?php echo $vendedor["nombre"] . " " . $vendedor["apellido"]; ?> </option>
                    <?php endwhile; ?>

                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

    <?php
incluirTemplate("footer");
    ?>