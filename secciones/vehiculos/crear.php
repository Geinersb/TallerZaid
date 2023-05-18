<?php  
include("../../bd/bd.php");


//ESTO ES PARA MOSTRAR LOS DATOS 
$sentencia = $conexion->prepare("SELECT * FROM `tbl_clientes`");
$sentencia->execute();
$lista_tbl_clientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);

if ($_POST) {

$marca=(isset($_POST["marca"])?$_POST["marca"]:"");
$modelo=(isset($_POST["modelo"])?$_POST["modelo"]:"");
$tiempo=(isset($_POST["tiempo"])?$_POST["tiempo"]:"");
$placa=(isset($_POST["placa"])?$_POST["placa"]:"");
$combustible=(isset($_POST["combustible"])?$_POST["combustible"]:"");
$km=(isset($_POST["km"])?$_POST["km"]:"");
 $idcliente=(isset($_POST["idcliente"])?$_POST["idcliente"]:"");

//Prepar la insercion de los datos 
$sentencia = $conexion->prepare("INSERT INTO tbl_vehiculos (id,marca,modelo,tiempo,placa,combustible,km,idcliente) 
VALUES (NULL,:marca,:modelo,:tiempo,:placa,:combustible,:km,:idcliente )");

//asignadno los valores que vienen del metodo POST(vienen del formulario)
$sentencia-> bindParam(":marca",$marca);
$sentencia-> bindParam(":modelo",$modelo);
$sentencia-> bindParam(":tiempo",$tiempo);
$sentencia-> bindParam(":placa",$placa);
$sentencia-> bindParam(":combustible",$combustible);
$sentencia-> bindParam(":km",$km);
$sentencia-> bindParam(":idcliente",$idcliente);

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
        Datos del vehiculo
    </div>
    <div class="card-body">
       
    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="marca" class="form-label">Marca:</label>
      <input type="text"
        class="form-control" name="marca" id="marca" aria-describedby="helpId" placeholder="Nombre de la marca">
      </div>

      <div class="mb-3">
      <label for="modelo" class="form-label">Modelo:</label>
      <input type="text"
        class="form-control" name="modelo" id="modelo" aria-describedby="helpId" placeholder="Nombre del modelo">
      </div>


    <div class="mb-3">
      <label for="tiempo" class="form-label">Año:</label>
      <input type="text"
        class="form-control" name="tiempo" id="tiempo" aria-describedby="helpId" placeholder="Año del vehiculo">
      </div>

    <div class="mb-3">
      <label for="placa" class="form-label">Placa:</label>
      <input type="text"
        class="form-control" name="placa" id="placa" aria-describedby="helpId" placeholder="Placa del vehiculo">
      </div>

    <div class="mb-3">
      <label for="combustible" class="form-label">Combustible:</label>
      <input type="text"
        class="form-control" name="combustible" id="combustible" aria-describedby="helpId" placeholder="Tipo de combustible">
      </div>

    <div class="mb-3">
      <label for="km" class="form-label">Km/millas:</label>
      <input type="text"
        class="form-control" name="km" id="km" aria-describedby="helpId" placeholder="Kilometraje del vehiculo">
      </div>


      <div class="mb-3">
                <label for="idcliente" class="form-label">Cedula del cliente:</label>
                <select class="form-select form-select-sm" name="idcliente" id="idcliente">
                <?php foreach ($lista_tbl_clientes as $registro) {   ?>
                    <option value="<?php echo $registro['id'] ?>">
                        <?php echo $registro['cedula'] ?></option>
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