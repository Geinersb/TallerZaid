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
    $cantidad = $registro["cantidad"];




    // $costo = $registro["costo"];

    // $total = $registro["total"];
    // $segundoapellido = $registro["segundoapellido"];
    // $usuario = $registro["usuario"];
    // $password = $registro["password"];
    // $correo = $registro["correo"];

    }


    if ($_POST) {
        // print_r($_POST);
       //recolectamos los datos del metodo post
       $txtID=(isset($_POST["txtID"])?$_POST["txtID"]:"");
       $cantidad_disminuir=(isset($_POST["cantidad_disminuir"])?$_POST["cantidad_disminuir"]:"");


  

       //Prepar la insercion de los datos 
       $sentencia = $conexion->prepare("UPDATE tbl_inventario SET 
       cantidad = cantidad - :cantidad_disminuir,
       total = cantidad * costo    
       WHERE id = :id
        ");
       
       //asignadno los valores que vienen del metodo POST(vienen del formulario)
       $sentencia-> bindParam(":cantidad_disminuir",$cantidad_disminuir);      
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
        Datos del usuario
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
      <input  readonly=true type="text"
      value="<?php echo $nombre;?>"
        class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre del usuario">
      </div>
      
      <div class="mb-3">
        <label for="cantidad" class="form-label">Cantidad Actual:</label>
        <input readonly=true type="text"
        value="<?php echo $cantidad;?>"
          class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" placeholder="Cantidad">
        </div>

      <!-- <div class="mb-3">
        <label for="costo" class="form-label">Costo:</label>
        <input readonly=true type="text"
        value="<?php echo $costo;?>"
          class="form-control" name="costo" id="costo" aria-describedby="helpId" placeholder="costo">
        </div>


      <div class="mb-3">
        <label for="total" class="form-label">Total:</label>
        <input readonly=true type="text"
        value="<?php echo $total;?>"
          class="form-control" name="total" id="total" aria-describedby="helpId" placeholder="total">
        </div> -->

      <div class="mb-3">
        <label for="cantidad_disminuir" class="form-label">Cantidad a Disminuir:</label>
        <input  type="text"
          class="form-control" name="cantidad_disminuir" id="cantidad_disminuir" aria-describedby="helpId" placeholder="Ingrese la cantidad a disminuir">
        </div>
        
        
    

<button type="submit" class="btn btn-success">Actualizar</button>
<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


    </form>


    </div>
    <div class="card-footer text-muted bg-dark"></div>
</div>



























<?php include("../../templates/footer.php"); ?>