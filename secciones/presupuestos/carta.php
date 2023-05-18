<?php
include("../../bd/bd.php");





if (isset($_GET['txtID']) || ($_GET['txtPre'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $txtPre = (isset($_GET['txtPre'])) ? $_GET['txtPre'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM tbl_clientes WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);




    $nombre = $registro["nombre"];
    $primerapellido = $registro["primerapellido"];
    $segundoapellido = $registro["segundoapellido"];
    $cedula = $registro["cedula"];
    $direccion = $registro["direccion"];
    $telefono = $registro["telefono"];
    $correo = $registro["correo"];

    $nombrecompleto = $nombre . " " . $primerapellido . " " . $segundoapellido;


    $sentencia = $conexion->prepare("SELECT * FROM tbl_presupuestos WHERE id=:id2");
    $sentencia->bindParam(":id2", $txtPre);
    $sentencia->execute();
    $registro2 = $sentencia->fetch(PDO::FETCH_LAZY);



    $fecha = $registro2["fecha"];
    $presupuesto = $registro2["id"]; 

  


    $sentencia = $conexion ->prepare("SELECT * FROM `tbl_servicios_cot` WHERE idpresupuesto=:id3");
    $sentencia->bindParam(":id3", $txtPre);
$sentencia-> execute();
$lista_tbl_servicios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

   





$sentencia = $conexion->prepare("SELECT SUM(costo) as total_cantidad FROM tbl_servicios_cot WHERE idpresupuesto = :id3");
$sentencia-> bindParam(":id3",$txtPre);
$sentencia-> execute();
$total = $sentencia->fetch(PDO::FETCH_ASSOC);  

}
?>
<?php

 ob_start(); 
 
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presupuesto Taller Zaid S.A</title>
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

    <h1>Presupuesto Taller Zaid S.A</h1>  
    
    <img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/img/logo.PNG" alt="logo taller Zaid" width="110">

    <p style="clear: both">Coronado San Jose, Costa Rica </p>
    <p>Fecha del prespuesto: <strong><?php echo $fecha ?></strong></p>
    <p>Cliente: <strong><?php echo $nombrecompleto ?></strong></p>
    <p>Direccion: <strong><?php echo $direccion ?></strong></p>
    <p>Telefono: <strong><?php echo $telefono ?></strong></p>
    <p>Correo: <strong><?php echo $correo ?></strong></p>
    <br><br>



    <h2>Presupuesto #<?php echo $presupuesto ?></h2>
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
                <td>¢<?php echo $registro['costo'] ?></td>
            </tr>
           
            
           
            <?php }?> 
        </tbody>
        <td colspan="2"><strong>Total Presupuesto</strong></td>
        <td><strong>¢<?php echo $total['total_cantidad']?></strong></td>
    </table>

    <h5>***Este presupuesto tiene una vigencia de 1 mes.</h5>


    <br>
    <br>
    
    <strong>Atentamente: </strong>
    <br><br>
    <strong>Erick Porras Sanchez</strong>
    <br>
    <strong>Tel: 84429062 </strong>
    <br>
    <strong>correo: Erick@correo.com </strong>



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
$file = 'Presupuesto.pdf';

$dompdf-> stream($file,array("Attachment"=>false));


?>


















