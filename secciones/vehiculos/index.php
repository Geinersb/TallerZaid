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
(SELECT cedula FROM tbl_clientes 
WHERE tbl_clientes.id = tbl_vehiculos.idcliente limit 1) as cliente

FROM `tbl_vehiculos`");
$sentencia->execute();
$lista_tbl_vehiculos = $sentencia->fetchAll(PDO::FETCH_ASSOC);




//con esto estoy recepcionando el ID del boton eliminar
//ESTO ES PARA ELIMINAR LOS DATOS 
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

//con esto se hace el borrado del registro
    $sentencia = $conexion->prepare("DELETE FROM tbl_vehiculos WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);

    $sentencia->execute();

   // esto es para que muestre el contenido del mensaje luego de eliminado
    $mensaje="Registro Eliminado";
    header("Location:index.php?mensaje=".$mensaje);
    
}
?>



<?php include("../../templates/header.php"); ?>

<br>
<h4>Vehiculos</h4>
<div class="card">
    <div class="card-header bg-dark">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar vehiculos</a>
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
    <table class="table" id="tabla_id">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Año</th>
                <th scope="col">Placa</th>
                <th scope="col">Combustible</th>
                <th scope="col">Km\Millas</th>
                <th scope="col">Cliente</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
             <!-- aqui leo registros para ingresar en la tabla  -->

           <?php  foreach ($lista_tbl_vehiculos as $registro) { ?> 
           
            <tr class="">
                <td scope="row"><?php echo $registro['id'] ?></td>
                <td><?php echo $registro['marca'] ?></td>
                <td><?php echo $registro['modelo'] ?></td>
                <td><?php echo $registro['tiempo'] ?></td>
                <td><?php echo $registro['placa'] ?></td>
                <td><?php echo $registro['combustible'] ?></td>
                <td><?php echo $registro['km'] ?></td>
                <td><?php echo $registro['cliente'] ?></td>
                <td>
                <a class="btn btn-outline-primary bi-pencil-square" href="editar.php?txtID=<?php echo $registro['id'] ?>" role="button"></a>
                      
            <a class="btn btn-outline-warning bi-trash-fill" href="javascript:borrar(<?php echo $registro['id'] ?>);" role="button"></a>
            
                </td>
            </tr>

          <?php }?>           
            


        </tbody>
    </table>
</div>

    </div>
    
</div>




<?php include("../../templates/footer.php"); ?>