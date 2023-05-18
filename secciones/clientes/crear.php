<?php  
include("../../bd/bd.php");

if ($_POST) {


$nombre=(isset($_POST["nombre"])?$_POST["nombre"]:"");
$primerapellido=(isset($_POST["primerapellido"])?$_POST["primerapellido"]:"");
$segundoapellido=(isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:"");
$cedula=(isset($_POST["cedula"])?$_POST["cedula"]:"");
$direccion=(isset($_POST["direccion"])?$_POST["direccion"]:"");
$telefono=(isset($_POST["telefono"])?$_POST["telefono"]:"");
$correo=(isset($_POST["correo"])?$_POST["correo"]:"");
// $idvehiculo=(isset($_POST["idvehiculo"])?$_POST["idvehiculo"]:"");


$sentencia = $conexion->prepare("INSERT INTO `tbl_clientes` (`id`, `nombre`, `primerapellido`, `segundoapellido`, `cedula`, `direccion`,telefono,correo)
 VALUES (NULL, :nombre, :primerapellido, :segundoapellido, :cedula, :direccion, :telefono, :correo);");

$sentencia-> bindParam(":nombre",$nombre);
$sentencia-> bindParam(":primerapellido",$primerapellido);
$sentencia-> bindParam(":segundoapellido",$segundoapellido);
$sentencia-> bindParam(":cedula",$cedula);
$sentencia-> bindParam(":direccion",$direccion);
$sentencia-> bindParam(":telefono",$telefono);
$sentencia-> bindParam(":correo",$correo);
// $sentencia-> bindParam(":idvehiculo",$idvehiculo);


$sentencia-> execute();

// esto es para que muestre el contenido del mensaje luego de eliminado
$mensaje="Registro Agregado";
header("Location:index.php?mensaje=".$mensaje);
}



// //ESTO ES PARA MOSTRAR LOS DATOS 
// $sentencia = $conexion->prepare("SELECT * FROM `tbl_vehiculos`");
// $sentencia->execute();
// $lista_tbl_vehiculos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

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
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre del cliente">
            </div>

            <div class="mb-3">
                <label for="primerapellido" class="form-label">Primer apellido</label>
                <input type="text" class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer apellido">
            </div>

            <div class="mb-3">
                <label for="segundoapellido" class="form-label">Segundo apellido</label>
                <input type="text" class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo apellido">
            </div>

            <div class="mb-3">
                <label for="cedula" class="form-label">Cedula</label>
                <input type="text" class="form-control" name="cedula" id="cedula" aria-describedby="helpId" placeholder="Cedula">
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Direccion</label>
                <input type="text" class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Direccion de domicilio">
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">telefono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" aria-describedby="helpId" placeholder="Telefono">
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo">
            </div>
            

            <!-- <div class="mb-3">
                <label for="idvehiculo" class="form-label">Placa del vehiculo:</label>
                <select class="form-select form-select-sm" name="idvehiculo" id="idvehiculo">
                <?php foreach ($lista_tbl_vehiculos as $registro) {   ?>
                    <option value="<?php echo $registro['id'] ?>">
                        <?php echo $registro['placa'] ?></option>
                    <?php } ?>
                </select>
            </div>            -->

            <button type="submit" class="btn btn-success">Agregar registro</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>


    </div>
    <div class="card-footer text-muted bg-dark"></div>
</div>


<?php include("../../templates/footer.php"); ?>