<?php
ob_start();
session_start();
$url_base = "http://localhost:8080/final_app_tallerzaid/";
if (!isset($_SESSION['usuario'])) {
    header("Location:" . $url_base . "index.php");
}

?>


<?php
include("../../bd/bd.php");


//esto es para mostrar los datos en la tabla 
$sentencia = $conexion ->prepare("SELECT * FROM `tbl_usuarios`");
$sentencia-> execute();
$lista_tbl_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);


//con esto estoy recepcionando el ID del boton eliminar
//ESTO ES PARA ELIMINAR LOS DATOS 
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("DELETE FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

      // esto es para que muestre el contenido del mensaje luego de eliminado
    $mensaje="Registro Eliminado";
    header("Location:index.php?mensaje=".$mensaje);
}

?>


<?php include("../../templates/header.php"); ?>

<br>
<h4>Usuarios</h4>
<div class="card">
    <div class="card-header bg-dark">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar usuarios</a>
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
    <table class="table" id="tabla_id">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Primer Apellido</th>
                <th scope="col">Segundo Apellido</th>
                <th scope="col">usuario</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Correo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
             <!-- aqui leo registros para ingresar en la tabla  -->

           <?php  foreach ($lista_tbl_usuarios as $registro) { ?> 
           
            <tr class="">
                <td scope="row"><?php echo $registro['id'] ?></td>
                <td><?php echo $registro['nombre'] ?></td>
                <td><?php echo $registro['primerapellido'] ?></td>
                <td><?php echo $registro['segundoapellido'] ?></td>
                <td><?php echo $registro['usuario'] ?></td>
                <td><?php echo $registro['password'] ?></td>
                <td><?php echo $registro['correo'] ?></td>
                <td>
                <a class="btn btn-outline-primary bi-pencil-square" href="editar.php?txtID=<?php echo $registro['id'] ?>" role="button"></a>
                       
            <a class="btn btn-outline-warning bi-trash-fill" href="javascript:borrar(<?php echo $registro['id'] ?>);" role="button"></a>
            
                </td>
            </tr>

          <?php }?>           
            


        </tbody>
    </table>
</div>

    </div>
    
</div>




<?php include("../../templates/footer.php"); ?>