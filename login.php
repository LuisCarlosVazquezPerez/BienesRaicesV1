<?php
require "includes/config/database.php";
$db = conectarDB();

//AUTENTICAR EL USUARIO

$errores=[];


if($_SERVER["REQUEST_METHOD"]==="POST"){ //Para leer el resultado de Post

$email=mysqli_real_escape_string($db ,filter_var($_POST["email"],FILTER_VALIDATE_EMAIL));
$password =mysqli_real_escape_string($db ,$_POST["password"]);

if(!$email){
    $errores[] = "El email es obligatorio o no es valido";
}
if(!$password){
    $errores[] = "El password es obligatorio";
}
if(empty($errores)){
    //REVISAR SI EL USUARIO EXISTE
    $query = "SELECT * FROM usuarios WHERE email = '${email}' ";
    $resultado = mysqli_query($db, $query); //LEER LOS RESULTADOS
    
    
    if($resultado->num_rows){ //ES UN OBJETO SE UTILIZa ->
//REVISAR SI EL PASSWORD ES CORRECTO
$usuario = mysqli_fetch_assoc($resultado);

//VERIFICAR SI EL PASSWORD ES CORRECTO
$auth=password_verify($password, $usuario["password"]); //TRUE O FALSE 

if($auth){
    //EL USUARIO ESTA AUTENTICADO
    session_start();
    //LLENAR EL ARREGLO DE LA SESION
    $_SESSION["usuario"]=$usuario["email"]; //ES PARA UN EJEMPLO ROLES!
    $_SESSION["login"] = true;

    header("Location: /admin");

}else{
    $errores[] = "El password es incorrecto";
}

    }else{
$errores[] = "El usuario no existe";
    }
}

}




//INCLUYE EL HEADER
require "includes/funciones.php";
incluirTemplate("header");
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>
<?php foreach($errores as $error)://No se ejecuta si el arreglo esta vacio ?>  
<div class="alerta error">
    <?php echo $error; ?>
</div>
<?php endforeach; ?>
    <form method="POST" class="formulario">

        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu email" id="email" require>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tu Password" id="password" requires>
        </fieldset>
<input type="submit" value="Iniciar Sesion" class="boton boton-verde">

    </form>
</main>


<?php
incluirTemplate("footer");
?>