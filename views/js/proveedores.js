/*=============================================
OBTENER LOS MUNICIPIOS SEGUN DEPTO
=============================================*/

$(".depto").change(function(){

    let idDepto = $(this).val();


    let datos = new FormData();
    datos.append("idDepto", idDepto);

    $.ajax({
        url:"ajax/proveedores.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){

            $('.mpio').prop('disabled',false);
            $('.mpio').children('option:not(:first)').remove();
          //console.log("respuesta", respuesta);
            $.each(respuesta, function(k, v) {
                $('.mpio').append('<option value="' + v.id + '">' + v.municipio + '</option>');
            });

        }

    })

});

/*=============================================
EDITAR PROVEEDOR
=============================================*/
$(".tablaProveedores").on("click", ".btnEditarProveedor", function() {
    let idProveedor = $(this).attr("idProveedor");
    let datos = new FormData();
    datos.append("idProveedor", idProveedor);

    $.ajax({
        url: "ajax/proveedores.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $("#editarProveedor").val(respuesta["proveedor"]);
            $("#idProveedor").val(respuesta["id"]);
            $("#editarContacto").val(respuesta["contacto"]);
            $("#editarDireccion").val(respuesta["direccion"]);
            $("#editarDepto").val(respuesta["id_departamento"]);

            let data = new FormData();
            data.append('idDepto', respuesta["id_departamento"]);

            $.ajax({
                url:"ajax/proveedores.ajax.php",
                method:"POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success:function(response){

                    $('.mpio').children('option:not(:first)').remove();
                    //console.log("respuesta", respuesta);
                    $.each(response, function(k, v) {
                        $('#editarMpio').append('<option value="' + v.id + '">' + v.municipio + '</option>');
                    });

                    $("#editarMpio").val(respuesta["id_municipio"]);

                }

            });


            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarEmail").val(respuesta["email"]);

        }
    })
});


/*=============================================
ELIMINAR INSUMO
=============================================*/
$(".tablaProveedores").on("click", ".btnEliminarProveedor", function() {

    let idProveedor = $(this).attr("idProveedor");

    swal({
        title: '¿Está seguro de borrar el Proveedor?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, borrar proveedor!'
    }).then(function(result){
        if (result.value) {

            window.location = "index.php?ruta=proveedores&idProveedor="+idProveedor;
        }

    })

});