<?php

//datos de la base de datos a conectar
$servidor = "localhost"; //127.0.0.1
$baseDeDatos = "app_taller";
$usuario = "root";
$password ="";


//esto me hace la conexion a la BD 
try {
   $conexion= new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$password);
} catch (Exception $ex) {
    echo $ex->getMessage();
}



?>