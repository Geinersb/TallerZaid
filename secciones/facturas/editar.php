<?php  
include("../../bd/bd.php");

//esto es para validar que este recibiendo el ID a editar 
if (isset($_GET['txtID'])) {    
    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";
    
    $sentencia = $conexion->prepare("SELECT * FROM tbl_facturas WHERE id=:id");
    $sentencia-> bindParam(":id",$txtID);
    $sentencia-> execute();

    $registro = $sentencia-> fetch(PDO::FETCH_LAZY);

    $factura = $registro["factura"];
    $fecha = $registro["fecha"];
    $monto = $registro["monto"];
    $estado = $registro["estado"];
    $id_proveedor = $registro["id_proveedor"];
    
   //ESTO ES PARA MOSTRAR LOS DATOS 
$sentencia = $conexion->prepare("SELECT * FROM `tbl_proveedor`");
$sentencia->execute();
$lista_tbl_proveedor = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    }


    if ($_POST) {
        // print_r($_POST);
       //recolectamos los datos del metodo post
       $txtID=(isset($_POST["txtID"])?$_POST["txtID"]:"");
       $factura=(isset($_POST["factura"])?$_POST["factura"]:"");
       $fecha=(isset($_POST["fecha"])?$_POST["fecha"]:"");
       $monto=(isset($_POST["monto"])?$_POST["monto"]:"");
       $estado=(isset($_POST["estado"])?$_POST["estado"]:"");
       $id_proveedor=(isset($_POST["id_proveedor"])?$_POST["id_proveedor"]:"");
       
       //Prepar la insercion de los datos 
       $sentencia = $conexion->prepare("UPDATE tbl_facturas SET
       factura = :factura,
       fecha = :fecha,
       monto = :monto,
       estado = :estado,
       id_proveedor = :id_proveedor      
       WHERE id = :id
        ");
       
       //asignadno los valores que vienen del metodo POST(vienen del formulario)
       $sentencia-> bindParam(":factura",$factura);
       $sentencia-> bindParam(":fecha",$fecha);
       $sentencia-> bindParam(":monto",$monto);
       $sentencia-> bindParam(":estado",$estado);
       $sentencia-> bindParam(":id_proveedor",$id_proveedor);       
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
        Datos de Factura
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
      <label for="factura" class="form-label">Numero de Factura:</label>
      <input type="text"
      value="<?php echo $factura;?>"
      class="form-control" name="factura" id="factura" aria-describedby="helpId" placeholder="Numero de factura">
    </div>
    
    <div class="mb-3">
    <label for="fecha" class="form-label">Fecha:</label>
    <input type="date"
    value="<?php echo $fecha;?>"
      class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha">
    </div>


    <div class="mb-3">
        <label for="monto" class="form-label">Monto:</label>
        <input type="text"
        value="<?php echo $monto;?>"
          class="form-control" name="monto" id="monto" aria-describedby="helpId" placeholder="Ingrese el monto de la factura">
        </div>
        
        <div class="mb-3">
          <label for="estado" class="form-label">Estado:</label>
          <input type="tel"
          value="<?php echo $estado;?>"
            class="form-control" name="estado" id="estado" aria-describedby="helpId" placeholder="Ingrese el estado de la factura">
          </div>

           <div class="mb-3">
                <label for="id_proveedor" class="form-label">Proveedor:</label>
               
                <select class="form-select form-select-sm" name="id_proveedor" id="id_proveedor">
                    <?php foreach ($lista_tbl_proveedor as $registro) {   ?>

                    <option <?php echo($id_proveedor ==$registro['id'])?"selected":"";?> value="<?php echo $registro['id'] ?>">
                        <?php echo $registro['nombre'] ?>
                    </option>
                    <?php } ?>
                </select>
            </div>



  

    

<button type="submit" class="btn btn-success">Actualizar</button>
<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


    </form>


    </div>
    <div class="card-footer text-muted bg-dark"></div>
</div>


<?php include("../../templates/footer.php"); ?>