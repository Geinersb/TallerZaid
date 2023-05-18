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
(SELECT nombre FROM tbl_proveedor 
WHERE tbl_proveedor.id = tbl_facturas.id_proveedor limit 1) as proveedor

FROM `tbl_facturas`");
$sentencia->execute();
$lista_tbl_facturas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// //esto es para mostrar los datos en la tabla 
// $sentencia = $conexion ->prepare("SELECT * FROM `tbl_facturas`");
// $sentencia-> execute();
// $lista_tbl_facturas = $sentencia->fetchAll(PDO::FETCH_ASSOC);


//con esto estoy recepcionando el ID del boton eliminar
//ESTO ES PARA ELIMINAR LOS DATOS 
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("DELETE FROM tbl_facturas WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

  
    $mensaje="Registro Eliminado";
    header("Location:index.php?mensaje=".$mensaje);
}

?>


<?php include("../../templates/header.php"); ?>

<br>
<h4>Facturas</h4>
<div class="card">
    <div class="card-header bg-dark">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Facturas</a>
  
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
    <table class="table" id="tabla_id">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Numero Factura</th>
                <th scope="col">Fecha de Factura</th>
                <th scope="col">Monto </th>
                <th scope="col">Estado</th>                
                <th scope="col">Proveedor</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
             <!-- aqui leo registros para ingresar en la tabla  -->

           <?php  foreach ($lista_tbl_facturas as $registro) { ?> 
           
            <tr class="">
                <td scope="row"><?php echo $registro['id'] ?></td>
              <td><?php echo $registro['factura'] ?></td>
                <td><?php echo $registro['fecha'] ?></td>
                <td><?php echo "₡" ?><?php echo $registro['monto'] ?></td>
                <td><?php echo $registro['estado'] ?></td>
                <td><?php echo $registro['proveedor'] ?></td>
               
               
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