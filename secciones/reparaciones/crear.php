<?php  
include("../../bd/bd.php");

if ($_POST) {


$nombre=(isset($_POST["nombre"])?$_POST["nombre"]:"");
$descripcion=(isset($_POST["descripcion"])?$_POST["descripcion"]:"");
$costo=(isset($_POST["costo"])?$_POST["costo"]:"");
$idvehiculo=(isset($_POST["idvehiculo"])?$_POST["idvehiculo"]:"");
$fecha=(isset($_POST["fecha"])?$_POST["fecha"]:"");


$sentencia = $conexion->prepare("INSERT INTO `tbl_mantenimiento` (`id`, `nombre`, `descripcion`, `costo`, `idvehiculo`, `fecha`)
 VALUES (NULL, :nombre, :descripcion, :costo, :idvehiculo, :fecha);");

$sentencia-> bindParam(":nombre",$nombre);
$sentencia-> bindParam(":descripcion",$descripcion);
$sentencia-> bindParam(":costo",$costo);
$sentencia-> bindParam(":idvehiculo",$idvehiculo);
$sentencia-> bindParam(":fecha",$fecha);


$sentencia-> execute();

// esto es para que muestre el contenido del mensaje luego de eliminado
$mensaje="Registro Agregado";
header("Location:index.php?mensaje=".$mensaje);
}



//ESTO ES PARA MOSTRAR LOS DATOS 
$sentencia = $conexion->prepare("SELECT * FROM `tbl_vehiculos`");
$sentencia->execute();
$lista_tbl_vehiculos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

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
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre del Mantenimiento">
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Digite el mantenimiento a realizar">
            </div>

            <div class="mb-3">
                <label for="costo" class="form-label">Costo</label>
                <input type="text" class="form-control" name="costo" id="costo" aria-describedby="helpId" placeholder="Digite el costo del mantenimiento">
            </div>         
          
            

            <div class="mb-3">
                <label for="idvehiculo" class="form-label">Placa del vehiculo:</label>
                <select class="form-select form-select-sm" name="idvehiculo" id="idvehiculo">
                <?php foreach ($lista_tbl_vehiculos as $registro) {   ?>
                    <option value="<?php echo $registro['id'] ?>">
                        <?php echo $registro['placa'] ?></option>
                    <?php } ?>
                </select>
            </div>   
            
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha del Mantenimiento</label>
                <input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha">
            </div>           



            <button type="submit" class="btn btn-success">Agregar registro</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>


    </div>
    <div class="card-footer text-muted bg-dark"></div>
</div>


<?php include("../../templates/footer.php"); ?>