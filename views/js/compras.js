
/*=============================================
OBTENER DETALLE DE COMPRA
=============================================*/
    $(".tablaCompras").on("click", ".btnVerDetalleCompra", function() {

        let idCompra = $(this).attr("idCompra");
        let datos = new FormData();
        datos.append("idCompraDetalle", idCompra);

        $.ajax({
            url: "ajax/compras.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {

                //limpiamos el body de la tabla antes de crear los elementos
                $('#detalleCompra').children().remove();

                //recorremos todos los datos que vienen en el detalle de compra
                $.each(respuesta, function(i,v){

                    let totalImporte = (parseFloat(v.cantidad) * parseFloat(v.precio));

                    $('#detalleCompra').append(
                        '<tr>' +
                        '<td>'+(i + 1) + '</td>'+
                        '<td>'+ v.codigo +'</td>'+
                        '<td>'+ v.insumo +'</td>'+
                        '<td>'+ v.cantidad + ' <span class="badge badge-info">'+ v.unidad_medida + '</span>' + '</td>'+
                        '<td> $'+ v.precio +'</td>'+
                        '<td> $'+ totalImporte.toFixed(2) +'</td>'+
                        '</tr>'
                    );

                });

            }
        })
    });


/*=============================================
ANULAR COMPRA
=============================================*/
$(".tablaCompras").on("click", ".btnAnularCompra", function(){

    let idCompra = $(this).attr("idCompra");

    swal({
        title: '¿Está seguro de anular la compra?',
        text: "¡La cantidad de insumos que compró serán descontados del stock!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, anular compra!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?ruta=compras&idCompra="+idCompra;

        }

    })

});





