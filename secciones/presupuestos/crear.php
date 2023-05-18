<?php
include("../../bd/bd.php");


//ESTO ES PARA MOSTRAR LOS DATOS 
$sentencia = $conexion->prepare("SELECT * FROM `tbl_presupuestos`");
$sentencia->execute();
$lista_tbl_presupuesto = $sentencia->fetchAll(PDO::FETCH_ASSOC);

foreach ($lista_tbl_presupuesto as $registro) {
 $numero=  $registro['factura'];

 
}



//ESTO ES PARA MOSTRAR LOS DATOS 
$sentencia = $conexion->prepare("SELECT * FROM `tbl_clientes`");
$sentencia->execute();
$lista_tbl_clientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include("../../templates/header.php"); ?>

<br>



<div class="row my-4">
    <div class="col-lg-12 mx-auto">
        <div class="card shadow">
            <div class="card-header bg-dark text-light">
                <h4>Agregar Presupuesto #<label for=""></label></h4>
              

            </div>
            <div class="card-body p-4">

                <div id="show_alert"></div>
                <form action="#" method="post" id="add_form">


                    <div class="col-lg-5">
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input required type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="fecha">

                        </div>
                        <div class="mb-3">
                            <label for="idcliente" class="form-label">Cliente:</label>
                            <select class="form-select form-select-sm" name="idcliente" id="idcliente">
                                <?php foreach ($lista_tbl_clientes as $registro) {   ?>
                                    <option value="<?php echo $registro['id'] ?>">
                                        <?php echo $registro['nombre'] ?> <?php echo $registro['primerapellido'] ?> <?php echo $registro['segundoapellido'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>



                    <div id="show_item">

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <input type="text" name="servicio[]" class="form-control" placeholder="Servicio" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <input type="number" name="costo[]" class="form-control" placeholder="Costo" required>
                            </div>

                           

                            <!-- <div class="col-md-2 mb-3">
                                    <input readonly type="text" name="product_total[]" class="form-control" placeholder="Total" required>
                                </div> -->

                            <div class="col-md-2 mb-3 d-grid">
                                <button class="btn btn-success add_item_btn"><i class="bi bi-plus-circle"></i></button>
                            </div>
                        </div>
                    </div>

                    <div>
                        <input type="submit" value="Agregar" class="btn btn-success w-25" id="add_btn">
                        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $(".add_item_btn").click(function(e) {
            e.preventDefault();
            $("#show_item").prepend(` <div class="row append_item">
                                <div class="col-md-4 mb-3">
                                    <input type="text" name="servicio[]" class="form-control" placeholder="Item Name" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <input type="number" name="costo[]" class="form-control" placeholder="Item Price" required>
                                </div>

                               

                                
                                <div class="col-md-2 mb-3 d-grid">
                                    <button class="btn btn-danger remove_item_btn"><i class="bi bi-trash3"></i></button>
                                </div>
                            </div>`);
        });

        $(document).on('click', '.remove_item_btn', function(e) {
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();

        });

        //ajax request para insertar todos los datos del formulari0
        $("#add_form").submit(function(e) {
            e.preventDefault();
            $("#add_btn").val('Adding...');
            $.ajax({
                url: 'datos.php',
                method: 'post',
                data: $(this).serialize(),
                success: function(response) {
                    // sumar();
                    $("#add_btn").val('Add');
                    $("#add_form")[0].reset();
                    $(".append_item").remove();
                    $("#show_alert").html(`<div class="alert alert-success" role="alert">${response}</div>`);
                 

                }
            });
        });


    });

//     function sumar(){
// var tot =0;

// for(x of data ){
//     tot = tot+x.total;
// }
// document.getElementById('total').innerHTML="Total "+tot;

// }






</script>




















<?php include("../../templates/footer.php"); ?>