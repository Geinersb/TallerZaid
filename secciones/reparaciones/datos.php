<?php
include("../../bd/bd.php");



if($_POST){


$fecha=(isset($_POST["fecha"])?$_POST["fecha"]:"");


$idvehiculo=(isset($_POST["idvehiculo"])?$_POST["idvehiculo"]:"");

  $sql = 'INSERT INTO tbl_reparaciones(fecha, idvehiculo)
  VALUES (:fecha, :idvehiculo)';

$statement = $conexion->prepare($sql);
$statement->bindParam(':fecha', $fecha);
$statement->bindParam(':idvehiculo', $idvehiculo);
$statement->execute();




}

$idreparacion = $conexion->lastInsertId();

// Insertar los servicios
foreach($_POST['servicio']as $key => $value){
   $sql = 'INSERT INTO tbl_servicios_mant(servicio, costo,idreparacion)
  VALUES (:servicio, :costo,:idreparacion)';
  $sentencia = $conexion->prepare($sql);
    $sentencia-> execute([
'servicio' => $value,
'costo' => $_POST['costo'][$key],
'idreparacion' => $idreparacion
  ]);


}



foreach($_POST['repuesto']as $key => $value){
  $sql = 'INSERT INTO tbl_repuestos_mant(repuesto,costo,idreparacion)
 VALUES (:repuesto, :costo,:idreparacion)';
 $sentencia = $conexion->prepare($sql);
   $sentencia-> execute([
'repuesto' => $value,
'costo' => $_POST['costos'][$key],
'idreparacion' => $idreparacion
 ]);
}
 




 


   echo  'Reparacion ingresada correctamente';


?>
