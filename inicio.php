<?php   
session_start();
$url_base="http://localhost:8080/final_app_tallerzaid/";
if (!isset($_SESSION['usuario'])) {
    header("Location:".$url_base."index.php");
}

?>
<!doctype html>
<html lang="en">

<head>
  <title>Taller Zaid</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

<!-- libreria para el animate css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<!-- liberia para el icon bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">


<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

<style>
      
      .alto{
        height: 91.5vh;
       
background-image: radial-gradient(circle at -7.93% 39.79%, #6c8dea 0, #1f3259 50%, #000000 100%);
      }

 
    </style>

</head>

<body>
  <header>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container-fluid">

                <!-- boton del menu -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- elementos del menu colapsable  -->
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo $url_base; ?>" aria-current="page">Taller Zaid<span class="visually-hidden">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $url_base; ?>secciones/clientes/">Clientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $url_base; ?>secciones/vehiculos">Vehiculos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $url_base; ?>secciones/proveedor">Proveedores</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $url_base; ?>secciones/reparaciones">Reparaciones</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $url_base; ?>secciones/facturas">Facturas</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $url_base; ?>secciones/presupuestos">Presupuestos</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $url_base; ?>secciones/inventario">Inventario</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $url_base; ?>secciones/usuarios">Usuarios</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $url_base; ?>cerrar.php">Cerrar Sesion</a>
                        </li>
                    </ul>


                </div>


            </div>

        </nav>









    <!-- place navbar here -->
  </header>
  <div class="container-fluid fondo">
  <div class="row alto align-items-center justify-content-center text-center text-dark">
    <div class="col-md-8">
      <div class=" text-light display-1 animate__animated animate__backInDown animate__delay-2s">
        <i class="fas fa-cog fa-spin"></i>
      </div>
      
        <h1 class="display-3 text-light animate__animated animate__backInLeft animate__delay-1s">Taller Zaid S.A</h1>
        <h2 class="text-light animate__animated animate__backInLeft animate__delay-1s">Usuario iniciado: <?php echo $_SESSION['nombre']; ?><?php echo " " ?><?php echo $_SESSION['primerapellido']; ?></h2>
    </div>
  </div>
  <main>

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