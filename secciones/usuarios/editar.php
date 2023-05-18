<?php  
include("../../bd/bd.php");

//esto es para validar que este recibiendo el ID a editar 
if (isset($_GET['txtID'])) {    
    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";
    
    $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
    $sentencia-> bindParam(":id",$txtID);
    $sentencia-> execute();

    $registro = $sentencia-> fetch(PDO::FETCH_LAZY);

    $nombre = $registro["nombre"];
    $primerapellido = $registro["primerapellido"];
    $segundoapellido = $registro["segundoapellido"];
    $usuario = $registro["usuario"];
    $password = $registro["password"];
    $correo = $registro["correo"];

    }


    if ($_POST) {
        // print_r($_POST);
       //recolectamos los datos del metodo post
       $txtID=(isset($_POST["txtID"])?$_POST["txtID"]:"");
       $nombre=(isset($_POST["nombre"])?$_POST["nombre"]:"");
       $primerapellido=(isset($_POST["primerapellido"])?$_POST["primerapellido"]:"");
       $segundoapellido=(isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:"");
       $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
       $password=md5(isset($_POST["password"])?$_POST["password"]:"");
       $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
       //Prepar la insercion de los datos 
       $sentencia = $conexion->prepare("UPDATE tbl_usuarios SET
       nombre = :nombre,
       primerapellido = :primerapellido,
       segundoapellido = :segundoapellido,
       usuario = :usuario,
       password = :password,
       correo = :correo
       WHERE id = :id
        ");
       
       //asignadno los valores que vienen del metodo POST(vienen del formulario)
       $sentencia-> bindParam(":nombre",$nombre);
       $sentencia-> bindParam(":primerapellido",$primerapellido);
       $sentencia-> bindParam(":segundoapellido",$segundoapellido);
       $sentencia-> bindParam(":usuario",$usuario);
       $sentencia-> bindParam(":password",$password);
       $sentencia-> bindParam(":correo",$correo);
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
        Datos del usuario
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
      <label for="nombre" class="form-label">Nombre del usuario:</label>
      <input type="text"
      value="<?php echo $nombre;?>"
        class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre del usuario">
      </div>
      
      <div class="mb-3">
        <label for="primerapellido" class="form-label">Primer Apellido:</label>
        <input type="text"
        value="<?php echo $primerapellido;?>"
          class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Ingre el primer apellido">
        </div>
        
        <div class="mb-3">
          <label for="segundoapellido" class="form-label">Segundo Apellido:</label>
          <input type="text"
          value="<?php echo $segundoapellido;?>"
            class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Ingrse el segundo apellido">
          </div>

    <div class="mb-3">
      <label for="usuario" class="form-label">Usuario:</label>
      <input type="text"
      value="<?php echo $usuario;?>"
        class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
      </div>

      <div class="mb-3">
      <label for="password" class="form-label">Password:</label>
      <input type="password"
      value="<?php echo $password;?>"
        class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
      </div>


    <div class="mb-3">
      <label for="correo" class="form-label">Correo:</label>
      <input type="email"
      value="<?php echo $correo;?>"
        class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
      </div>

    

<button type="submit" class="btn btn-success">Actualizar</button>
<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


    </form>


    </div>
    <div class="card-footer text-muted bg-dark"></div>
</div>


<?php include("../../templates/footer.php"); ?>