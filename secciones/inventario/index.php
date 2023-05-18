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


$sentencia = $conexion ->prepare("SELECT * FROM `tbl_inventario`");
$sentencia-> execute();
$lista_tbl_inventario = $sentencia->fetchAll(PDO::FETCH_ASSOC);



if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("DELETE FROM tbl_inventario WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $mensaje="Registro Eliminado";
    header("Location:index.php?mensaje=".$mensaje);
}



$sentencia = $conexion->prepare("SELECT SUM(costo * cantidad) as total_cantidad FROM tbl_inventario");
$sentencia-> execute();
$total = $sentencia->fetch(PDO::FETCH_ASSOC);  


?>


<?php include("../../templates/header.php"); ?>

<br>
<h4>Inventario</h4>
<div class="card">
    <div class="card-header bg-dark">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Inventario</a>    
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
    <table class="table" id="tabla_id">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre Articulo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Cantidad </th>
                <th scope="col">Costo</th>                
                <th scope="col">total</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
             <!-- aqui leo registros para ingresar en la tabla  -->

           <?php  foreach ($lista_tbl_inventario as $registro) { ?> 
           
            <tr class="">
                <td scope="row"><?php echo $registro['id'] ?></td>
                <td><?php echo $registro['nombre'] ?></td>
                <td><?php echo $registro['descripcion'] ?></td>
                <td><?php echo $registro['cantidad'] ?></td>
                <td>¢<?php echo $registro['costo'] ?></td>
                <td>¢<?php echo $registro['costo']*$registro['cantidad'] ?></td>
               
                <td>
                    <a class="btn btn-outline-danger bi-dash-circle" href="actualizar.php?txtID=<?php echo $registro['id'] ?>" role="button"></a>

                    <a class="btn btn-outline-primary bi-pencil-square" href="editar.php?txtID=<?php echo $registro['id'] ?>" role="button"></a>
                       
            <a class="btn btn-outline-warning bi-trash-fill" href="javascript:borrar(<?php echo $registro['id'] ?>);" role="button"></a>
            
                </td>
            </tr>

          <?php }?>           
            


        </tbody>
    </table>
    <label for=""><strong>Total en inventario:</strong></label>
   <strong>¢<?php echo $total['total_cantidad']?></strong>
</div>

    </div>
    
</div>




<?php include("../../templates/footer.php"); ?>