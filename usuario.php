<?php
//1-IMPORTAR LA CONEXIOn
require "includes/config/database.php";
$db=conectarDB();

//2-CREAR EMAIL Y PASSWORD
$email="correo@correo.com";
$password = "123456";

//-HasearPassword
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

//3-QUERY PARA CREAR EL USUARIO
$query = "INSERT INTO usuarios (email,password) VALUES('${email}', '${passwordHash}');";

//echo $query; //PARA VER SI ESTA CORRECTO EL INSERT
//exit(); //ESTE EXIT HACE QUE NO SE EJECUTE LO DE ABAJO DE LA LINEA DE EXIT

//4- AGG A LA BASE DE DATOS
mysqli_query($db, $query);