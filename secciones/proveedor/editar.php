<?php  
include("../../bd/bd.php");

//esto es para validar que este recibiendo el ID a editar 
if (isset($_GET['txtID'])) {    
    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";
    
    $sentencia = $conexion->prepare("SELECT * FROM tbl_proveedor WHERE id=:id");
    $sentencia-> bindParam(":id",$txtID);
    $sentencia-> execute();

    $registro = $sentencia-> fetch(PDO::FETCH_LAZY);

    $nombre = $registro["nombre"];
    $direccion = $registro["direccion"];
    $telefono = $registro["telefono"];
    $correo = $registro["correo"];
    $cedula = $registro["cedula"];
    

    }


    if ($_POST) {
        // print_r($_POST);
       //recolectamos los datos del metodo post
       $txtID=(isset($_POST["txtID"])?$_POST["txtID"]:"");
       $nombre=(isset($_POST["nombre"])?$_POST["nombre"]:"");
       $direccion=(isset($_POST["direccion"])?$_POST["direccion"]:"");
       $telefono=(isset($_POST["telefono"])?$_POST["telefono"]:"");
       $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
       $cedula=(isset($_POST["cedula"])?$_POST["cedula"]:"");
       
       //Prepar la insercion de los datos 
       $sentencia = $conexion->prepare("UPDATE tbl_proveedor SET
       nombre = :nombre,
       direccion = :direccion,
       telefono = :telefono,
       correo = :correo,
       cedula = :cedula      
       WHERE id = :id
        ");
       
       //asignadno los valores que vienen del metodo POST(vienen del formulario)
       $sentencia-> bindParam(":nombre",$nombre);
       $sentencia-> bindParam(":direccion",$direccion);
       $sentencia-> bindParam(":telefono",$telefono);
       $sentencia-> bindParam(":correo",$correo);
       $sentencia-> bindParam(":cedula",$cedula);       
       $sentencia-> bindParam(":id",$txtID);
       $sentencia-> execute();

       // esto es para que muestre el contenido del mensaje luego de eliminado
    $mensaje="Registro Actualizado";
    header("Location:index.php?mensaje=".$mensaje);
       }
       
       ?>


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
      <label for="txtID" class="form-label">ID:</label>
      <input type="text"
      value="<?php echo $txtID;?>"
        class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
        
    </div>
    
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre del Proveedor:</label>
      <input type="text"
      value="<?php echo $nombre;?>"
      class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre del usuario">
    </div>
    
    <div class="mb-3">
    <label for="cedula" class="form-label">Cedula:</label>
    <input type="text"
    value="<?php echo $cedula;?>"
      class="form-control" name="cedula" id="cedula" aria-describedby="helpId" placeholder="Cedula">
    </div>


    <div class="mb-3">
        <label for="direccion" class="form-label">Direccion:</label>
        <input type="text"
        value="<?php echo $direccion;?>"
          class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Ingrese la direccion">
        </div>
        
        <div class="mb-3">
          <label for="telefono" class="form-label">Telefono:</label>
          <input type="tel"
          value="<?php echo $telefono;?>"
            class="form-control" name="telefono" id="telefono" aria-describedby="helpId" placeholder="Ingrese el telefono">
          </div>

    <div class="mb-3">
      <label for="correo" class="form-label">Correo:</label>
      <input type="email"
      value="<?php echo $correo;?>"
        class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo">
      </div>



  

    

<button type="submit" class="btn btn-success">Actualizar</button>
<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


    </form>


    </div>
    <div class="card-footer text-muted bg-dark"></div>
</div>


<?php include("../../templates/footer.php"); ?>