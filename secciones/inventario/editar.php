<?php  
include("../../bd/bd.php");

//esto es para validar que este recibiendo el ID a editar 
if (isset($_GET['txtID'])) {    
    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";
    
    $sentencia = $conexion->prepare("SELECT * FROM tbl_inventario WHERE id=:id");
    $sentencia-> bindParam(":id",$txtID);
    $sentencia-> execute();

    $registro = $sentencia-> fetch(PDO::FETCH_LAZY);

    $nombre = $registro["nombre"];
    $descripcion = $registro["descripcion"];
    $cantidad = $registro["cantidad"];
    $costo = $registro["costo"];
    $total = $registro["total"];
    

    }


    if ($_POST) {
        // print_r($_POST);
       //recolectamos los datos del metodo post
       $txtID=(isset($_POST["txtID"])?$_POST["txtID"]:"");
       $nombre=(isset($_POST["nombre"])?$_POST["nombre"]:"");
       $descripcion=(isset($_POST["descripcion"])?$_POST["descripcion"]:"");
       $cantidad=(isset($_POST["cantidad"])?$_POST["cantidad"]:"");
       $costo=(isset($_POST["costo"])?$_POST["costo"]:"");
      

         $costos = floatval($costo);
 
$suma = $cantidad * $costos;
  $total=(isset($suma)?$suma:""); 
       
       //Prepar la insercion de los datos 
       $sentencia = $conexion->prepare("UPDATE tbl_inventario SET
       nombre = :nombre,
       descripcion = :descripcion,
       cantidad = :cantidad,
       costo = :costo,
       total = :total      
       WHERE id = :id
        ");
       
       //asignadno los valores que vienen del metodo POST(vienen del formulario)
       $sentencia-> bindParam(":nombre",$nombre);
       $sentencia-> bindParam(":descripcion",$descripcion);
       $sentencia-> bindParam(":cantidad",$cantidad);
       $sentencia-> bindParam(":costo",$costo);
       $sentencia-> bindParam(":total",$total);       
       $sentencia-> bindParam(":id",$txtID);
       $sentencia-> execute();

       // esto es para que muestre el contenido del mensaje luego de eliminado
    $mensaje="Registro Actualizado";
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
      <label for="txtID" class="form-label">ID:</label>
      <input type="text"
      value="<?php echo $txtID;?>"
        class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
        
    </div>
    
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre del Articulo:</label>
      <input type="text"
      value="<?php echo $nombre;?>"
      class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre del Articulo">
    </div>
    
    <div class="mb-3">
    <label for="descripcion" class="form-label">Descripcion:</label>
    <input type="text"
    value="<?php echo $descripcion;?>"
      class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion Articulo">
    </div>


    <div class="mb-3">
        <label for="cantidad" class="form-label">Cantidad:</label>
        <input type="text"
        value="<?php echo $cantidad;?>"
          class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" placeholder="Ingrese la cantidad">
        </div>
        
        <div class="mb-3">
          <label for="costo" class="form-label">Costo:</label>
          <input type="text"
          value="<?php echo $costo;?>"
            class="form-control" name="costo" id="costo" aria-describedby="helpId" placeholder="Ingrese el Costo">
          </div>

    <div class="mb-3">
      <label for="total" class="form-label">Total:</label>
      <input type="text"
      value="<?php echo $total;?>"
        class="form-control" readonly name="total" id="total" aria-describedby="helpId" placeholder="Total">
      </div>



  

    

<button type="submit" class="btn btn-success">Actualizar</button>
<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


    </form>


    </div>
    <div class="card-footer text-muted bg-dark"></div>
</div>


<?php include("../../templates/footer.php"); ?>