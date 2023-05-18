<?php

session_start();

if ($_POST) {
    include("bd/bd.php");

//esto es para mostrar los datos en la tabla 
$sentencia = $conexion ->prepare("SELECT *,count(*)as n_usuarios
 FROM `tbl_usuarios` 
 WHERE usuario=:usuario 
 AND password=:password");

$usuario = $_POST["usuario"];
$password = md5($_POST["password"]);

$sentencia->bindParam(":usuario", $usuario);
$sentencia->bindParam(":password", $password);

$sentencia-> execute();
$registro = $sentencia->fetch(PDO::FETCH_LAZY);
if ($registro["n_usuarios"]>0) {
   $_SESSION['usuario']=$registro["usuario"]; 
   $_SESSION['nombre'] = $registro["nombre"];
   $_SESSION['primerapellido'] = $registro["primerapellido"];
   $_SESSION['logueado']=true;
   header("Location:inicio.php");
}else{
    $mensaje="Error: El usuario o contraseña son incorrectos";
}

}



?>


<!doctype html>
<html lang="en">

<head>
  <title>Taller Zaid S.A</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <style>
      
      .alto{
        height: 100vh;
       
background-image: radial-gradient(circle at -7.93% 39.79%, #6c8dea 0, #1f3259 50%, #000000 100%);
      }

 
    </style>

</head>

<body class="alto">
  <header>
    <!-- place navbar here -->
  </header>
  <main class="container">

<br>
<br>

  <div class="row">
  <div class="col-md-4">
    
    </div>
    
    <div class="col-md-4">
        <br><br><br>
    <div class="card">
        <div class="card-header text-center bg-dark text-light">
            Inicio de Sesion
        </div>
        <div class="card-body">

    <?php if (isset($mensaje)) { ?>
        <div class="alert alert-danger" role="alert">
            <strong><?php echo $mensaje;?></strong> 
        </div>
        
    <?php }?>

        
            
<form action="" method="post">

<div class="mb-3">
  <label for="usuario" class="form-label text-center">Usuario:</label>
  <input type="text"
    class="form-control" name="usuario" id="usuario"  placeholder="Escriba su usuario">
 </div>

<div class="mb-3">
  <label for="password" class="form-label text-center">Contraseña:</label>
  <input type="password"
    class="form-control" name="password" id="password"  placeholder="Escriba su contraseña">
 </div>

 <button type="submit" class="btn btn-primary">Entrar al sistema</button>


</form>
        </div>
        
    </div>






    </div>
  </div>










  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>