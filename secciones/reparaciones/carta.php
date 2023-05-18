<?php
include("../../bd/bd.php");

ob_start();



if (isset($_GET['txtID']) || ($_GET['txtPre'])) {

   
// aqui muestro los datos del numero de reparacion y la fecha reparaciones

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $txtPre = (isset($_GET['txtPre'])) ? $_GET['txtPre'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM tbl_reparaciones WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);


    $numero = $registro["id"];
    $fecha = $registro["fecha"];



    // aqui me muestra la placa del vehiculo que fue reparado

    $sentencia = $conexion->prepare("SELECT *,
(SELECT placa FROM tbl_vehiculos 
WHERE tbl_vehiculos.id = tbl_reparaciones.idvehiculo limit 1) as vehiculo

FROM `tbl_reparaciones`");
$sentencia->execute();
$lista_tbl_vehiculos = $sentencia->fetch(PDO::FETCH_ASSOC);
$Placa = $lista_tbl_vehiculos["vehiculo"];



// aqui me muestra el nombre del propietario del vehiculo 
//ESTO ES PARA MOSTRAR LOS DATOS 
$sentencia = $conexion->prepare("SELECT *,
(SELECT cedula FROM tbl_clientes 
WHERE tbl_clientes.id = tbl_vehiculos.idcliente limit 1) as cliente
FROM `tbl_vehiculos`");
$sentencia->execute();
$lista_tbl_clientes = $sentencia->fetchALL(PDO::FETCH_ASSOC);
// $cliente = $lista_tbl_clientes["cliente"];


// $nombre = $registro["nombre"];
// $primerapellido = $registro["primerapellido"];
// $segundoapellido = $registro["segundoapellido"];
// $cedula = $registro["cedula"];
// $direccion = $registro["direccion"];
// $telefono = $registro["telefono"];
// $correo = $registro["correo"];

// $nombrecompleto = $nombre . " " . $primerapellido . " " . $segundoapellido;

var_dump($lista_tbl_clientes);


// aqui me muestra la tabla de los servicios que fueron realizados 
    $sentencia = $conexion ->prepare("SELECT * FROM `tbl_servicios_mant` WHERE idreparacion=:id");
        $sentencia->bindParam(":id", $txtID);
     $sentencia-> execute();
     $lista_tbl_servicios = $sentencia->fetchAll(PDO::FETCH_ASSOC);


    // aqui me muestra la tabla de los repuestos utilizados 

     $sentencia = $conexion ->prepare("SELECT * FROM `tbl_repuestos_mant` WHERE idreparacion=:id");
     $sentencia->bindParam(":id", $txtID);
  $sentencia-> execute();
  $lista_tbl_repuestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
 

// aqui me hace la suma de los costos de los servicios realizados 
$sentencia = $conexion->prepare("SELECT SUM(costo) as total_cantidad FROM tbl_servicios_mant WHERE idreparacion = :id");
$sentencia-> bindParam(":id",$txtID);
$sentencia-> execute();
$total = $sentencia->fetch(PDO::FETCH_ASSOC);  

// aqui me muestra la suma de los costos de los repuestos utilizados 

$sentencia = $conexion->prepare("SELECT SUM(costo) as total_cantidad FROM tbl_repuestos_mant WHERE idreparacion = :id");
$sentencia-> bindParam(":id",$txtID);
$sentencia-> execute();
$total2 = $sentencia->fetch(PDO::FETCH_ASSOC);  


}
?>



<!-- a partir de esta linea es que se recolecta la informacion para mostrar en el pdf -->
 ob_start(); 

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reparacion Taller Zaid S.A</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #322826 ;
            color: white;
        }

        .total {
            font-weight: bold;
        }

        h1 {
            float: left;
        vertical-align: middle;
      }
      
      img {
        float: right;
        vertical-align: middle;
      }
    </style>
</head>

<body>

    <h1>Reparacion Realizada en Taller Zaid S.A</h1>  
    
    <img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/app_taller/img/logo.PNG" alt="logo taller Zaid" width="110">

    <p style="clear: both">Coronado San Jose, Costa Rica </p>
    <p>#Reparación: <strong><?php echo $numero ?></strong></p>
    <p>Fecha de entrega de vehiculo: <strong><?php echo $fecha ?></strong></p>  

   
    <p>Placa del Vehiculo: <strong><?php echo $Placa?></strong></p>
   

    <!-- <p>Direccion: <strong><?php echo $direccion ?></strong></p>
    <p>Telefono: <strong><?php echo $telefono ?></strong></p>
    <p>Correo: <strong><?php echo $correo ?></strong></p> -->
    <br><br>



   <h2>Reparacion #<?php echo $numero ?></h2>
    <table >
        <thead >
            <tr>
                <th>Concepto</th>               
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>

        <?php  foreach ($lista_tbl_servicios as $registro) { ?> 

              
            <tr>
                <td><?php echo $registro['servicio'] ?></td>
                              <td>¢<?php echo $registro['costo'] ?></td>
                <td>¢<?php echo $registro['costo']?></td>
            </tr>
           
            
           
            <?php }?> 
        </tbody>

        <td colspan="2"><strong>Total Reparacion</strong></td>
        <td><strong>¢<?php echo $total['total_cantidad']?></strong></td>

    </table>

    <br>
<!-- AQUI INICIA LOS REPUESTOS  -->

    <table >
        <thead >
            <tr>
                <th>Repuestos</th>               
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>

        <?php  foreach ($lista_tbl_repuestos as $registro) { ?> 

              
            <tr>
                <td><?php echo $registro['repuesto'] ?></td>
                              <td>¢<?php echo $registro['costo'] ?></td>
                <td>¢<?php echo $registro['costo']?></td>
            </tr>
                      
           
            <?php }?> 
        </tbody>

        <td colspan="2"><strong>Total Repuestos</strong></td>
        <td><strong>¢<?php echo $total2['total_cantidad']?></strong></td>

    </table>
<br>
    <h5>***Se cuenta con 1 mes de garantia sobre las reparaciones descritas anteriormente.</h5>


    <br>
   
    
    <strong>Atentamente: </strong>
    <br><br>
    <strong>Erick Porras Sanchez</strong>
    <br>
    <strong>Tel: 84429062 </strong>
    <br>
    <strong>correo: Erick@correo.com </strong>


    <br>
    <br>
    <p>Recibido Conforme:  ________________________________________</p> 

</body>

</html>

<?php
// hasta aqui es que se muetra la informacion de pdf y la guarda en la variable 
$HTML=ob_get_clean();

require_once("../../libs/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$opciones = $dompdf->getOptions();
$opciones-> set(array("isRemoteEnabled"=>true));
$dompdf ->setOptions($opciones);

$dompdf ->loadHtml($HTML);

$dompdf->setPaper('letter');
$dompdf->render();
$file = 'Reparacion.pdf';
$dompdf-> stream($file,array("Attachment"=>false));


?> 

