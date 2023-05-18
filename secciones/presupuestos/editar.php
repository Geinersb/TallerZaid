<?php  
include("../../bd/bd.php");

if (isset($_GET['txtID'])|| ($_GET['txtPre'])) {    
    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";
    $txtPre = (isset($_GET['txtPre'])) ? $_GET['txtPre'] : "";
    
    $sentencia = $conexion->prepare("SELECT * FROM tbl_servicios_cot WHERE idpresupuesto=:id");
    $sentencia-> bindParam(":id",$txtID);
    $sentencia-> execute();
    $lista_tbl_presupuesto = $sentencia->fetchAll(PDO::FETCH_ASSOC);   


$sentencia = $conexion->prepare("SELECT SUM(costo) as total_cantidad FROM tbl_servicios_cot WHERE idpresupuesto = :id3");
$sentencia-> bindParam(":id3",$txtPre);
$sentencia-> execute();
$total = $sentencia->fetch(PDO::FETCH_ASSOC);  

   

    }

   

    ?>
    <?php include("../../templates/header.php"); ?>

<br>

    <h4>DETALLE DEL PRESUPUESTO</h4>
<div class="card">
    <div class="card-header bg-dark">
    <!-- <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar usuarios</a> -->
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
    <table class="table" id="tabla_id">
        <thead>
            <tr>
                <th scope="col">#Presupuesto</th>
                <th scope="col">Servicio</th>
                <th scope="col">Precio Unitario</th>
                  <th>Total</th>
               
                <!-- <th scope="col">Acciones</th> -->
            </tr>
        </thead>
        <tbody>
             <!-- aqui leo registros para ingresar en la tabla  -->

           <?php  foreach ($lista_tbl_presupuesto as $registro) { ?> 
           
            <tr class="">
                <!-- <td scope="row"><?php echo $registro['id'] ?></td> -->
                <td><?php echo $registro['idpresupuesto'] ?></td>
                <td><?php echo $registro['servicio'] ?></td>
                <td>¢<?php echo $registro['costo'] ?></td>
               
                <td>¢<?php echo $registro['costo']?></td>              
                
            </tr>

          <?php }?>           
            


        </tbody>
        <!-- <td colspan="2"><strong>Total Presupuesto</strong></td>
        <td><strong>¢<?php echo $total['total_cantidad']?></strong></td> -->

  
    </table>
    <label for=""><strong>Total Presupuesto:</strong></label>
   <strong>¢<?php echo $total['total_cantidad']?></strong>

<?php 


?> 
<br><br>
<a name="" id="" class="btn btn-primary" href="index.php" role="button">Regresar</a>
    
</div>

    </div>
    
</div>























    <?php include("../../templates/footer.php"); ?>