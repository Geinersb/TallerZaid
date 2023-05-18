<?php  
ob_start();
include("../../bd/bd.php");


$sentencia = $conexion->prepare("SELECT * FROM `tbl_proveedor`");
$sentencia->execute();
$lista_tbl_proveedor = $sentencia->fetchAll(PDO::FETCH_ASSOC);

if($_POST){
  $factura=(isset($_POST["factura"])?$_POST["factura"]:"");
  $fecha=(isset($_POST["fecha"])?$_POST["fecha"]:"");
  $monto=(isset($_POST["monto"])?$_POST["monto"]:"");
  $estado=(isset($_POST["estado"])?$_POST["estado"]:"");
  $id_proveedor=(isset($_POST["id_proveedor"])?$_POST["id_proveedor"]:""); 

  $sentencia = $conexion->prepare("INSERT INTO `tbl_facturas` (id,`factura`, `fecha`, `monto`, `estado`,`id_proveedor`)
   VALUES (NULL,:factura, :fecha, :monto, :estado, :id_proveedor);");
  
  $sentencia-> bindParam(":factura",$factura);
  $sentencia-> bindParam(":fecha",$fecha);
  $sentencia-> bindParam(":monto",$monto);
  $sentencia-> bindParam(":estado",$estado);
  $sentencia-> bindParam(":id_proveedor",$id_proveedor);

 $sentencia-> execute();
 $mensaje="Registro Agregado";
 header("Location:index.php?mensaje=".$mensaje);
    
}
?>
 <?php include("../../templates/header.php"); ?>
 
<br>
<div class="card">
    <div class="card-header bg-dark text-light">
        Datos de la Factura
    </div>
    <div class="card-body">
       
    <form action="" method="post" enctype="multipart/form-data">

      <div class="mb-3">
        <label for="factura" class="form-label">Numero de Factura:</label>
        <input type="text"
          class="form-control" name="factura" id="factura" aria-describedby="helpId" placeholder="Ingrese el numero de la factura">
        </div>

      <div class="mb-3">
        <label for="fecha" class="form-label">Fecha Factura:</label>
        <input type="date"
          class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Ingrese fecha factura">
        </div>

      <div class="mb-3">
        <label for="monto" class="form-label">Monto:</label>
        <input type="text"
          class="form-control" name="monto" id="monto" aria-describedby="helpId" placeholder="Ingrese el monto de la factura">
        </div>
  
    <div class="mb-3">
      <label for="estado" class="form-label">Estado:</label>
      <input type="text"
        class="form-control" name="estado" id="estado" aria-describedby="helpId" placeholder="Digite el estado de la Factura">
      </div>     


      <div class="mb-3">
                <label for="id_proveedor" class="form-label">Proveedor:</label>
                <select class="form-select form-select-sm" name="id_proveedor" id="id_proveedor">
                <?php foreach ($lista_tbl_proveedor as $registro) {   ?>
                    <option value="<?php echo $registro['id'] ?>">
                        <?php echo $registro['nombre'] ?></option>
                    <?php } ?>
                </select>
            </div>   

    

<button type="submit" class="btn btn-success">Agregar</button>
<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


    </form>


    </div>
    <div class="card-footer text-muted bg-dark"></div>
</div>


<?php include("../../templates/footer.php"); ?>