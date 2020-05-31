
/*=============================================
REVISAR SI EXISTE UN INSUMO CON ESE CODIGO
=============================================*/

$(".validarCodigo").change(function(){

    $(".invalid-feedback").remove();

    let codigoInsumo = $(".validarCodigo").val();


    let datos = new FormData();
    datos.append("validarCodigo", codigoInsumo);

    $.ajax({
        url:"ajax/insumos.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){

            // console.log("respuesta", respuesta);

            if(respuesta){
                $(".validarCodigo").addClass('is-invalid');
                $(".validarCodigo").parent().append('<div class="invalid-feedback">¡Ya existe un insumo con ese código!</div>');
                $(".validarCodigo").val("");
            }
            else{
                $(".validarCodigo").removeClass('is-invalid');
                $(".validarCodigo").addClass('is-valid');

            }

        }

    })

});


/*=============================================
CAMBIAR ESTADO
=============================================*/
$(".tablaInsumos").on("click", ".btnActivar", function() {
    let idInsumo = $(this).attr("idInsumo");
    let estadoInsumo = $(this).attr("estadoInsumo");
    let datos = new FormData();
    datos.append("activarId", idInsumo);
    datos.append("activarInsumo", estadoInsumo);
    $.ajax({
        url: "ajax/insumos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            console.log("respuesta", respuesta);
        }
    });
    if (estadoInsumo == 0) {
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoInsumo', 1);
    } else {
        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoInsumo', 0);
    }
});


/*=============================================
EDITAR INSUMO
=============================================*/
$(".tablaInsumos").on("click", ".btnEditarInsumo", function() {
    let idInsumo = $(this).attr("idInsumo");
    let datos = new FormData();
    datos.append("idInsumo", idInsumo);

    $.ajax({
        url: "ajax/insumos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $("#editarCodigoInsumo").val(respuesta["codigo"]);
            $("#idInsumo").val(respuesta["id"]);
            $("#editarDescripcionInsumo").val(respuesta["descripcion"]);
            $("#editarCategoriaInsumo").val(respuesta["id_categoria"]);
            $("#editarUmInsumo").val(respuesta["unidad_medida"]);
            $("#editarStockInsumo").val(respuesta["stock"]);

        }
    })
});

/*=============================================
ELIMINAR INSUMO
=============================================*/
$(".tablaInsumos").on("click", ".btnEliminarInsumo", function() {

    let idInsumo = $(this).attr("idInsumo");

    swal({
        title: '¿Está seguro de borrar el Insumo?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, borrar insumo!'
    }).then(function(result){
        if (result.value) {

            window.location = "index.php?ruta=insumos&idInsumo="+idInsumo;
        }

    })

});

/*=============================================
EDITAR CATEGORIA INSUMO
=============================================*/
$(".tablaCategoriasInsumos").on("click", ".btnEditarCategoriaInsumo", function(){

    let idCategoriaInsumo = $(this).attr("idCategoriaInsumo");

    let datos = new FormData();
    datos.append("idCategoria", idCategoriaInsumo);

    $.ajax({
        url: "ajax/insumos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){

            $("#editarCatInsumo").val(respuesta["descripcion"]);
            $("#idCatInsumo").val(respuesta["id"]);

        }

    })

});

/*=============================================
ELIMINAR CATEGORIA INSUMO
=============================================*/
$(".tablaCategoriasInsumos").on("click", ".btnEliminarCategoriaInsumo", function(){

    let idCategoriaInsumo = $(this).attr("idCategoriaInsumo");

    swal({
        title: '¿Está seguro de borrar la categoría?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar categoría!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?ruta=categorias&idCategoria="+idCategoriaInsumo;

        }

    })

});