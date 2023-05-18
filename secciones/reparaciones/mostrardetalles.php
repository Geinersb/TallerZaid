<?php  
include("../../bd/bd.php");

if (isset($_GET['txtID'])|| ($_GET['txtPre'])) {    
    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";
    $txtPre = (isset($_GET['txtPre'])) ? $_GET['txtPre'] : "";
    
    $sentencia = $conexion->prepare("SELECT * FROM tbl_servicios_mant WHERE idreparacion=:id");
    $sentencia-> bindParam(":id",$txtID);
    $sentencia-> execute();
    $lista_tbl_presupuesto = $sentencia->fetchAll(PDO::FETCH_ASSOC);   


$sentencia = $conexion->prepare("SELECT SUM(costo ) as total_cantidad FROM tbl_servicios_mant WHERE idreparacion = :id3");
$sentencia-> bindParam(":id3",$txtPre);
$sentencia-> execute();
$total = $sentencia->fetch(PDO::FETCH_ASSOC);  

   

// repuestos 
$sentencia = $conexion->prepare("SELECT * FROM tbl_repuestos_mant WHERE idreparacion=:id");
$sentencia-> bindParam(":id",$txtID);
$sentencia-> execute();
$lista_tbl_repuestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);  
// total de repuestos 
$sentencia = $conexion->prepare("SELECT SUM(costo ) as total_cantidad FROM tbl_repuestos_mant WHERE idreparacion = :id3");
$sentencia-> bindParam(":id3",$txtPre);
$sentencia-> execute();
$total2 = $sentencia->fetch(PDO::FETCH_ASSOC);  



    }

   

    ?>
    <?php include("../../templates/header.php"); ?>

<br>

    <h4>DETALLE DE LA REPARACION</h4>
<div class="card">
    <div class="card-header bg-dark">
    <!-- <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar usuarios</a> -->
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
    <table class="table" id="tabla_id">
        <thead>
            <tr>
                <th scope="col">#Reparacion</th>
                <th scope="col">Servicio</th>
                <th scope="col">costo</th>
                <!-- <th scope="col">Cantidad</th> -->
                <th>Total</th>
               
                <!-- <th scope="col">Acciones</th> -->
            </tr>
        </thead>
        <tbody>
             <!-- aqui leo registros para ingresar en la tabla  -->

           <?php  foreach ($lista_tbl_presupuesto as $registro) { ?> 
           
            <tr class="">
                <!-- <td scope="row"><?php echo $registro['id'] ?></td> -->
                <td><?php echo $registro['idreparacion'] ?></td>
                <td><?php echo $registro['servicio'] ?></td>
                <td>¢<?php echo $registro['costo'] ?></td>
               
                <td>¢<?php echo $registro['costo']?></td>              
                
            </tr>

          <?php }?>           
            


        </tbody>
        <!-- <td colspan="3"><strong>Total Presupuesto</strong></td>
        <td><strong>¢<?php echo $total['total_cantidad']?></strong></td> -->

  
    </table>
    <label for=""><strong>Total Reparacion:</strong></label>
   <strong>¢<?php echo $total['total_cantidad']?></strong>

<?php 


?> 
<br><br>
<!-- <a name="" id="" class="btn btn-primary" href="index.php" role="button">Regresar</a> -->
    
</div>

    </div>
    
</div>

<h4>REPUESTOS UTILIZADOS EN LA REPARACION</h4>
<div class="card">
    <div class="card-header bg-dark">
    <!-- <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar usuarios</a> -->
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
    <table class="table" id="tabla_id">
        <thead>
            <tr>
                <th scope="col">#Reparacion</th>
                <th scope="col">Repuesto</th>
                <th scope="col">costo</th>
                <!-- <th scope="col">Cantidad</th> -->
                <th>Total</th>
               
                <!-- <th scope="col">Acciones</th> -->
            </tr>
        </thead>
        <tbody>
             <!-- aqui leo registros para ingresar en la tabla  -->

           <?php  foreach ($lista_tbl_repuestos as $registro) { ?> 
           
            <tr class="">
                <!-- <td scope="row"><?php echo $registro['id'] ?></td> -->
                <td><?php echo $registro['idreparacion'] ?></td>
                <td><?php echo $registro['repuesto'] ?></td>
                <td>¢<?php echo $registro['costo'] ?></td>
               
                <td>¢<?php echo $registro['costo']?></td>              
                
            </tr>

          <?php }?>           
            


        </tbody>
        <!-- <td colspan="3"><strong>Total Presupuesto</strong></td>
        <td><strong>¢<?php echo $total['total_cantidad']?></strong></td> -->

  
    </table>
    <label for=""><strong>Total Repuestos:</strong></label>
   <strong>¢<?php echo $total2['total_cantidad']?></strong>

<?php 


?> 
<br><br>
<a name="" id="" class="btn btn-primary" href="index.php" role="button">Regresar</a>
    
</div>

    </div>
    
</div>




















    <?php include("../../templates/footer.php"); ?>