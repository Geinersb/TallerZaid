<?php  
include("../../bd/bd.php");

//esto es para validar que este recibiendo el ID a editar 
if (isset($_GET['txtID'])) {    
    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";
    
    $sentencia = $conexion->prepare("SELECT * FROM tbl_mantenimiento WHERE id=:id");
    $sentencia-> bindParam(":id",$txtID);
    $sentencia-> execute();

    $registro = $sentencia-> fetch(PDO::FETCH_LAZY);

    $nombre = $registro["nombre"];
    $descripcion = $registro["descripcion"];
    $costo = $registro["costo"];
    $idvehiculo = $registro["idvehiculo"];
    $fecha = $registro["fecha"];
    
//ESTO ES PARA MOSTRAR LOS DATOS de vehiculos 
$sentencia = $conexion->prepare("SELECT * FROM `tbl_vehiculos`");
$sentencia->execute();
$lista_tbl_vehiculos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    }


    if ($_POST) {
        // print_r($_POST);
       //recolectamos los datos del metodo post
       $txtID=(isset($_POST["txtID"])?$_POST["txtID"]:"");
       $nombre=(isset($_POST["nombre"])?$_POST["nombre"]:"");
       $descripcion=(isset($_POST["descripcion"])?$_POST["descripcion"]:"");
       $costo=(isset($_POST["costo"])?$_POST["costo"]:"");
       $idvehiculo=(isset($_POST["idvehiculo"])?$_POST["idvehiculo"]:"");
       $fecha=(isset($_POST["fecha"])?$_POST["fecha"]:"");
       
       //Prepar la insercion de los datos 
       $sentencia = $conexion->prepare("UPDATE tbl_mantenimiento SET
       nombre = :nombre,
       descripcion = :descripcion,
       costo = :costo,
       idvehiculo = :idvehiculo,
       fecha = :fecha      
       WHERE id = :id
        ");
       
       //asignadno los valores que vienen del metodo POST(vienen del formulario)
       $sentencia-> bindParam(":nombre",$nombre);
       $sentencia-> bindParam(":descripcion",$descripcion);
       $sentencia-> bindParam(":costo",$costo);
       $sentencia-> bindParam(":idvehiculo",$idvehiculo);
       $sentencia-> bindParam(":fecha",$fecha);       
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
        Datos del Mantenimiento
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
      <label for="nombre" class="form-label">Nombre del Mantenimiento:</label>
      <input type="text"
      value="<?php echo $nombre;?>"
      class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre del usuario">
    </div>
    
    <div class="mb-3">
    <label for="descripcion" class="form-label">Descripcion</label>
    <input type="text"
    value="<?php echo $descripcion;?>"
      class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion de lo realizado">
    </div>


    <div class="mb-3">
        <label for="costo" class="form-label">Costo:</label>
        <input type="text"
        value="<?php echo $costo;?>"
          class="form-control" name="costo" id="costo" aria-describedby="helpId" placeholder="Costo del mantenimiento realizado">
        </div>
        
        <div class="mb-3">
        <label for="idvehiculo" class="form-label">Placa del vehiculo:</label>
        
        <select class="form-select form-select-sm" name="idvehiculo" id="idvehiculo">
        <?php foreach ($lista_tbl_vehiculos as $registro) {   ?>
            
            <option <?php echo($idvehiculo ==$registro['id'])?"selected":"";?> value="<?php echo $registro['id'] ?>">
            <?php echo $registro['placa'] ?>
          </option>      
                             
          <?php } ?>
        </select>
      </div>   


      <div class="mb-3">
                <label for="fecha" class="form-label">Fecha del Mantenimiento:</label>
                <input 
                value="<?php echo $fecha;?>"
                type="date" class="form-control" name="fecha" id="fecha"
                    aria-describedby="emailHelpId" placeholder="Fecha de mantenimiento">

            </div>

  

    

<button type="submit" class="btn btn-success">Actualizar</button>
<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


    </form>


    </div>
    <div class="card-footer text-muted bg-dark"></div>
</div>


<?php include("../../templates/footer.php"); ?>







            
                    
            
          









 

