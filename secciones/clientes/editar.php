<?php  
include("../../bd/bd.php");

//esto es para validar que este recibiendo el ID a editar 
if (isset($_GET['txtID'])) {    
    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";
    
    $sentencia = $conexion->prepare("SELECT * FROM `tbl_clientes` WHERE id=:id");
    $sentencia-> bindParam(":id",$txtID);
    $sentencia-> execute();

    $registro = $sentencia-> fetch(PDO::FETCH_LAZY);

    $nombre = $registro["nombre"];
    $primerapellido = $registro["primerapellido"];
    $segundoapellido = $registro["segundoapellido"];
    $cedula = $registro["cedula"];
    $telefono = $registro["telefono"];
    $direccion = $registro["direccion"];
    $correo = $registro["correo"];
    // $idvehiculo = $registro["idvehiculo"];
    
//ESTO ES PARA MOSTRAR LOS DATOS 
// $sentencia = $conexion->prepare("SELECT * FROM `tbl_vehiculos`");
// $sentencia->execute();
// $lista_tbl_vehiculos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    }


    if ($_POST) {

       
       //recolectamos los datos del metodo post
       $txtID=(isset($_POST["txtID"])?$_POST["txtID"]:"");
       $nombre=(isset($_POST["nombre"])?$_POST["nombre"]:"");
       $primerapellido=(isset($_POST["primerapellido"])?$_POST["primerapellido"]:"");
       $segundoapellido=(isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:"");
       $cedula=(isset($_POST["cedula"])?$_POST["cedula"]:"");
       $direccion=(isset($_POST["direccion"])?$_POST["direccion"]:"");
       $telefono=(isset($_POST["telefono"])?$_POST["telefono"]:"");
       $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
      //  $idvehiculo=(isset($_POST["idvehiculo"])?$_POST["idvehiculo"]:"");



       //Prepar la insercion de los datos 
       $sentencia = $conexion->prepare("UPDATE tbl_clientes SET
       
       nombre = :nombre,
       primerapellido = :primerapellido,
       segundoapellido = :segundoapellido,
       cedula = :cedula,
       direccion = :direccion,
       telefono = :telefono,
       correo = :correo
      --  idvehiculo = :idvehiculo
       WHERE id = :id
        ");
       
       //asignadno los valores que vienen del metodo POST(vienen del formulario)
       $sentencia-> bindParam(":nombre",$nombre);
       $sentencia-> bindParam(":primerapellido",$primerapellido);
       $sentencia-> bindParam(":segundoapellido",$segundoapellido);
       $sentencia-> bindParam(":cedula",$cedula);
       $sentencia-> bindParam(":telefono",$telefono);
       $sentencia-> bindParam(":direccion",$direccion);
       $sentencia-> bindParam(":correo",$correo);
      //  $sentencia-> bindParam(":idvehiculo",$idvehiculo);
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
        Datos del Cliente
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
      <label for="nombre" class="form-label">Nombre:</label>
      <input type="text"
      value="<?php echo $nombre;?>"
        class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre">
      </div>

      <div class="mb-3">
      <label for="primerapellido" class="form-label">Pimer Apellido:</label>
      <input type="text"
      value="<?php echo $primerapellido;?>"
        class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer apellido">
      </div>


    <div class="mb-3">
      <label for="segundoapellido" class="form-label">Segundo Apellido:</label>
      <input type="text"
      value="<?php echo $segundoapellido;?>"
        class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo apellido">
      </div>

    <div class="mb-3">
      <label for="cedula" class="form-label">Cedula:</label>
      <input type="text"
      value="<?php echo $cedula;?>"
        class="form-control" name="cedula" id="cedula" aria-describedby="helpId" placeholder="Cedula">
      </div>

    <div class="mb-3">
      <label for="telefono" class="form-label">Telefono:</label>
      <input type="text"
      value="<?php echo $telefono;?>"
        class="form-control" name="telefono" id="telefono" aria-describedby="helpId" placeholder="Telefono">
      </div>  
      
      
      
      
      <div class="mb-3">
        <label for="direccion" class="form-label">Direccion:</label>
        <input type="text"
        value="<?php echo $direccion;?>"
          class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Direccion">
        </div>

    <div class="mb-3">
      <label for="correo" class="form-label">Correo</label>
      <input type="text"
      value="<?php echo $correo;?>"
        class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo">
      </div>

      <!-- <div class="mb-3">
        <label for="idvehiculo" class="form-label">Placa:</label>
        
        <select class="form-select form-select-sm" name="idvehiculo" id="idvehiculo">
          <?php foreach ($lista_tbl_vehiculos as $registro) {   ?>
            
            <option <?php echo($idvehiculo ==$registro['id'])?"selected":"";?> value="<?php echo $registro['id'] ?>">
            <?php echo $registro['placa'] ?>
          </option>      
                             
          <?php } ?>
        </select>
      </div> -->
    

<button type="submit" class="btn btn-success">Actualizar</button>
<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


    </form>


    </div>
    <div class="card-footer text-muted bg-dark"></div>
</div>


<?php include("../../templates/footer.php"); ?>