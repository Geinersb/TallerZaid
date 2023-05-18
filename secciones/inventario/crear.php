<?php  
include("../../bd/bd.php");

if ($_POST) {


  $nombre=(isset($_POST["nombre"])?$_POST["nombre"]:"");
  $descripcion=(isset($_POST["descripcion"])?$_POST["descripcion"]:"");
  $cantidad=(isset($_POST["cantidad"])?$_POST["cantidad"]:"");
  $costo=(isset($_POST["costo"])?$_POST["costo"]:"");

  $costos = floatval($costo);
 
$suma = $cantidad * $costos;
  $total=(isset($suma)?$suma:""); 

  
  
  $sentencia = $conexion->prepare("INSERT INTO `tbl_inventario` (id,`nombre`, `descripcion`, `cantidad`, `costo`, `total`)
   VALUES (NULL,:nombre, :descripcion, :cantidad, :costo, :total);");
  
  $sentencia-> bindParam(":nombre",$nombre);
  $sentencia-> bindParam(":descripcion",$descripcion);
  $sentencia-> bindParam(":cantidad",$cantidad);
  $sentencia-> bindParam(":costo",$costo);
  $sentencia-> bindParam(":total",$total);

  
  
  $sentencia-> execute();
  
  // esto es para que muestre el contenido del mensaje luego de eliminado
  $mensaje="Registro Agregado";
  header("Location:index.php?mensaje=".$mensaje);
  }
  
  
  ?>
  <?php include("../../templates/header.php"); ?>



<br>
<div class="card">
    <div class="card-header bg-dark text-light">
        Datos del Articulo
    </div>
    <div class="card-body">
       
    <form action="" method="post" enctype="multipart/form-data">

      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del Articulo:</label>
        <input type="text"
          class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Ingrese el nombre del Articulo">
        </div>

      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripcion:</label>
        <input type="text"
          class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Ingrese la descripcion del articulo">
        </div>

      <div class="mb-3">
        <label for="cantidad" class="form-label">Cantidad:</label>
        <input type="text"
          class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" placeholder="Ingrese la cantidad del articulo">
        </div>
  
    <div class="mb-3">
      <label for="costo" class="form-label">Costo Articulo:</label>
      <input type="text"
        class="form-control" name="costo" id="costo" aria-describedby="helpId" placeholder="Costo del Articulo">
      </div>     

    

<button type="submit" class="btn btn-success">Agregar</button>
<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


    </form>


    </div>
    <div class="card-footer text-muted bg-dark"></div>
</div>


<?php include("../../templates/footer.php"); ?>