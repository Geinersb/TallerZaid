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


// //esto es para mostrar los datos en la tabla 
// $sentencia = $conexion ->prepare("SELECT * FROM `tbl_presupuestos`");
// $sentencia-> execute();
// $lista_tbl_presupuesto = $sentencia->fetchAll(PDO::FETCH_ASSOC);




//ESTO ES PARA MOSTRAR LOS DATOS 
$sentencia = $conexion->prepare("SELECT *,
(SELECT cedula FROM tbl_clientes 
WHERE tbl_clientes.id = tbl_presupuestos.idcliente limit 1) as cliente
FROM `tbl_presupuestos`");
$sentencia->execute();
$lista_tbl_presupuesto = $sentencia->fetchAll(PDO::FETCH_ASSOC);



//con esto estoy recepcionando el ID del boton eliminar
//ESTO ES PARA ELIMINAR LOS DATOS 
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("DELETE FROM tbl_presupuestos WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

      // esto es para que muestre el contenido del mensaje luego de eliminado
    $mensaje="Registro Eliminado";
    header("Location:index.php?mensaje=".$mensaje);
}

?>


<?php include("../../templates/header.php"); ?>

<br>
<h4>Presupuestos</h4>
<div class="card">
    <div class="card-header bg-dark">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Presupuesto</a>
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
    <table class="table" id="tabla_id">
        <thead>
            <tr>
                <th scope="col"># Presupuesto</th>             
                            
                <!-- <th scope="col">idcliente </th> -->
                <th scope="col">Cliente </th>
                <th scope="col">Fecha de Presupuesto</th>
                <!-- <th scope="col">Total Presupuesto </th> -->
                         
               
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
             <!-- aqui leo registros para ingresar en la tabla  -->

           <?php  foreach ($lista_tbl_presupuesto as $registro) { ?> 
           
            <tr class="">
                <td scope="row"><?php echo $registro['id'] ?></td>                
                <!-- <td><?php echo $registro['idcliente'] ?></td> -->
                <td><?php echo $registro['cliente'] ?></td>
                <td><?php echo $registro['fecha'] ?></td>
                
               
               
                <td>
                
                    <!-- <a class="btn btn-outline-success bi-plus-circle" href="servicios.php?txtID=<?php echo $registro['id'] ?>" role="button"></a> -->

                <a class="btn btn-outline-success bi-plus-circle" href="editar.php?txtID=<?php echo $registro['id'] ?>&txtPre=<?php echo $registro['id'] ?>" role="button"></a>

                <!-- <a class="btn btn-info bi-printer" href="editar.php?txtID=<?php echo $registro['id'] ?>" role="button"></a> -->       
              
                <a target="_blank" href="carta.php?txtID=<?php echo $registro['idcliente'] ?>&txtPre=<?php echo $registro['id'] ?>" class="btn btn-outline-danger bi-file-earmark-pdf-fill" role="button"></a>
                      
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