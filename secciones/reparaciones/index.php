<?php
ob_start();
session_start();
$url_base = "http://localhost:8080/final_app_tallerzaid/";
if (!isset($_SESSION['usuario'])) {
    header("Location:" . $url_base . "index.php");
}

?>

<?php
include("../../bd/bd.php");



//ESTO ES PARA MOSTRAR LOS DATOS 
$sentencia = $conexion->prepare("SELECT *,
(SELECT placa FROM tbl_vehiculos 
WHERE tbl_vehiculos.id = tbl_reparaciones.idvehiculo limit 1) as vehiculo

FROM `tbl_reparaciones`");
$sentencia->execute();
$lista_tbl_mantenimiento = $sentencia->fetchAll(PDO::FETCH_ASSOC);





//con esto estoy recepcionando el ID del boton eliminar
//ESTO ES PARA ELIMINAR LOS DATOS 
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

   


//con esto se hace el borrado del registro
    $sentencia = $conexion->prepare("DELETE FROM tbl_reparaciones WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);

    $sentencia->execute();

   // esto es para que muestre el contenido del mensaje luego de eliminado
    $mensaje="Registro Eliminado";
    header("Location:index.php?mensaje=".$mensaje);
    
}

?>

<?php include("../../templates/header.php"); ?>

<br>
<h4>Reparaciones</h4>
<div class="card">
    <div class="card-header bg-dark">
        <a name="" id="" class="btn btn-primary" href="reparacion.php" role="button">Agregar Reparacion</a>
    </div>
    <div class="card-body">

        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Placa</th>
                        <!-- <th scope="col">Total Reparacion</th>                        -->
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody>

                   
                <?php foreach ($lista_tbl_mantenimiento as $registro) {   ?>
                    <tr class="">
                        <td><?php echo $registro['id'] ?></td>
                        <td scope="row">
                            <?php echo $registro['fecha'] ?>                                                  

                        </td>    
                        
                        <td> <?php echo $registro['vehiculo'] ?></td>

                        
                        
                        <!-- <td><?php echo $resultado['costo_total'] ?></td> -->
                        
                        
                         
                       
                       
                        
                        <td>
                        <a class="btn btn-outline-success bi-plus-circle" href="mostrardetalles.php?txtID=<?php echo $registro['id'] ?>&txtPre=<?php echo $registro['id'] ?>" role="button"></a>
                           
                        <a target="_blank" href="carta.php?txtID=<?php echo $registro['id'] ?>&txtPre=<?php echo $registro['vehiculo'] ?>" class="btn btn-outline-danger bi-file-earmark-pdf-fill" role="button"></a>
                            
                            <a class="btn btn-outline-warning bi-trash-fill" href="javascript:borrar(<?php echo $registro['id'] ?>);"
                                role="button"></a>
                        </td>
                    </tr>

                    <?php } ?>




                </tbody>
            </table>
        </div>


    </div>

</div>

<?php include("../../templates/footer.php"); ?>