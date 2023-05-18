<?php  
ob_start();
include("../../bd/bd.php");

if ($_POST) {
  $nombre=(isset($_POST["nombre"])?$_POST["nombre"]:"");
  $direccion=(isset($_POST["direccion"])?$_POST["direccion"]:"");
  $telefono=(isset($_POST["telefono"])?$_POST["telefono"]:"");
  $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
  $cedula=(isset($_POST["cedula"])?$_POST["cedula"]:""); 

  
  
  $sentencia = $conexion->prepare("INSERT INTO `tbl_proveedor` (`nombre`, `direccion`, `telefono`, `correo`, `cedula`,`id`)
   VALUES (:nombre, :direccion, :telefono, :correo, :cedula, NULL);");
  
  $sentencia-> bindParam(":nombre",$nombre);
  $sentencia-> bindParam(":direccion",$direccion);
  $sentencia-> bindParam(":telefono",$telefono);
  $sentencia-> bindParam(":correo",$correo);
  $sentencia-> bindParam(":cedula",$cedula);

  
  
  $sentencia-> execute();
  
  // esto es para que muestre el contenido del mensaje luego de eliminado
// esto es para que muestre el contenido del mensaje luego de eliminado
$mensaje="Registro Agregado";
header("Location:index.php?mensaje=".$mensaje);
  }
  ?>
  <?php include("../../templates/header.php"); ?>



<br>
<div class="card">
    <div class="card-header bg-dark text-light">
        Datos del Proveedor
    </div>
    <div class="card-body">
       
    <form action="" method="post" enctype="multipart/form-data">

      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del Proveedor:</label>
        <input type="text"
          class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Ingrese el nombre del Proveedor">
        </div>

      <div class="mb-3">
        <label for="cedula" class="form-label">Cedula:</label>
        <input type="text"
          class="form-control" name="cedula" id="cedula" aria-describedby="helpId" placeholder="Ingrese la cedula">
        </div>

      <div class="mb-3">
        <label for="telefono" class="form-label">Telefono:</label>
        <input type="tel"
          class="form-control" name="telefono" id="telefono" aria-describedby="helpId" placeholder="Ingrese el telefono">
        </div>
  
    <div class="mb-3">
      <label for="direccion" class="form-label">Direccion:</label>
      <input type="text"
        class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Digite la direccion">
      </div>     


    <div class="mb-3">
      <label for="correo" class="form-label">Correo:</label>
      <input type="email"
        class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
      </div>

    

<button type="submit" class="btn btn-success">Agregar</button>
<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


    </form>


    </div>
    <div class="card-footer text-muted bg-dark"></div>
</div>


<?php include("../../templates/footer.php"); ?>