


<!doctype html>
<html lang="es">

<head>
    <title>Taller Zaid</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- hoja de mis estilos  -->

    <!-- <link rel="stylesheet" href="../css/styles.css"> -->

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- libreria jqry -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <!-- librerias para el datatable con jqry-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>

    <!-- librerias para el Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

    <!-- libreria para el animate css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- liberia para el icon bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">




</head>

<body">
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
                            <a class="nav-link active" href="<?php echo $url_base; ?>inicio.php" aria-current="page">Taller Zaid<span class="visually-hidden">(current)</span></a>
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
    </header>


    <main class="container">

        <!-- esto es para mostrar el mensaje luego de borrado  -->
        <?php if (isset($_GET['mensaje'])) { ?>
            <script>
                Swal.fire({
                    icon: "success",
                    title: "<?php echo $_GET['mensaje']; ?>"
                });
            </script>
        <?php } ?>