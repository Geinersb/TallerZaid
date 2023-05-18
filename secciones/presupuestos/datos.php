<?php
include("../../bd/bd.php");


// //ESTO ES PARA MOSTRAR LOS DATOS 
$sentencia = $conexion->prepare("SELECT * FROM `tbl_servicios_cot`");
$sentencia->execute();
$lista_tbl_presupuesto = $sentencia->fetchAll(PDO::FETCH_ASSOC);

foreach ($lista_tbl_presupuesto as $registro) {
 $numero=  $registro['id'];
 
}

$factura=0;

if($_POST){
$fecha=(isset($_POST["fecha"])?$_POST["fecha"]:"");


$sentencia = $conexion->prepare("SELECT * FROM `tbl_presupuestos`");
$sentencia->execute();
$lista_tbl_presupuesto = $sentencia->fetchAll(PDO::FETCH_ASSOC);


foreach ($lista_tbl_presupuesto as $registro) {
 $factura=  $registro['factura']; 
}

$factura++;

$idcliente=(isset($_POST["idcliente"])?$_POST["idcliente"]:"");


  $sql = 'INSERT INTO tbl_presupuestos(fecha,factura,idcliente)
  VALUES (:fecha, :factura, :idcliente)';

$statement = $conexion->prepare($sql);
$statement->bindParam(':fecha', $fecha);
$statement->bindParam(':factura', $factura);
$statement->bindParam(':idcliente', $idcliente);
$statement->execute();

}

//aqui busca el ultimo presupuesto agregado 
$idpresupuesto = $conexion->lastInsertId();



foreach($_POST['servicio']as $key => $value){
   $sql = 'INSERT INTO tbl_servicios_cot(servicio,costo,idpresupuesto)
  VALUES (:servicio, :costo,:idpresupuesto)';
  $sentencia = $conexion->prepare($sql);
    $sentencia-> execute([
'servicio' => $value,
'costo' => $_POST['costo'][$key],
'idpresupuesto' => $idpresupuesto
  ]);

}


 echo  'Presupuesto ingresado correctamente';
  

?>
