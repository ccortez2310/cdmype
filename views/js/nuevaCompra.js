
$(document).ready(function () {

    /*=============================================
    BUSCAR PROVEEDOR
    =============================================*/

    $('#txtBuscarProveedor').autocomplete({
        delay:1,
        autofocus:true,
        dataType: 'JSON',
        source: function (request, response) {
            $.ajax({
                url: "ajax/compras.ajax.php",
                method: "POST",
                data: { valorBusquedaProveedor: request.term },
                dataType: "json",
                success: function(data) {

                    response($.map(data, function (item) {

                        return {
                            id: item.id,
                            proveedor: item.proveedor,
                            municipio: item.municipio
                        }

                    }))

                }

            })

        },
        select: function (e, ui) {
            $("#idProveedor").val(ui.item.id);
            $("#txtProveedor").val(ui.item.proveedor);
        },
        change: function() {
            $("#txtBuscarProveedor").val('');
            $("#txtBuscarProveedor").focus();
        },
        create: function () {
            $(this).data('ui-autocomplete')._renderItem = function (ul, item) {
                return $('<li>')
                    .append(item.proveedor + ' - (' + item.municipio + ')')
                    .appendTo( ul );
            };
        }

    });


    /*=============================================
    BUSCAR INSUMOS
    =============================================*/

    $('#txtBusquedaInsumo').autocomplete({
        delay:1,
        autofocus:true,
        dataType: 'JSON',
        source: function (request, response) {
            $.ajax({
                url: "ajax/nuevaCompra.ajax.php",
                method: "POST",
                data: { valorBusquedaInsumo: request.term },
                dataType: "json",
                success: function(data) {

                    response($.map(data, function (item) {

                        return {
                            id: item.id,
                            codigo: item.codigo,
                            insumo: item.descripcion,
                            umInsumo: item.unidad_medida,
                            value: '[' + item.codigo + '] ' + item.descripcion,
                            mostrar: '<span class="badge badge-success">' + item.codigo + '</span> ' + item.descripcion

                        }

                    }))

                }

            })

        },
        select: function (e, ui) {
            $("#idInsumo").val(ui.item.id);
            $("#txtBusquedaInsumo").val(ui.item.value);
            $("#umInsumo").html(ui.item.umInsumo);
            $("#cantidadInsumo").focus();
        },
        create: function () {
            $(this).data('ui-autocomplete')._renderItem = function (ul, item) {
                return $('<li>')
                    .append(item.mostrar)
                    .appendTo( ul );
            };
        }

    });


    //Datepicker
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy'
    });

    /* Limpiar datos del proveedor */
    $('#btnLimpiarProveedor').click(function() {
        $("#idProveedor").val('0');
        $("#txtBuscarProveedor").val('');
        $("#txtProveedor").val('');
    });


});

//declaramos un objeto el cual nos servira para hacer las operaciones

var compra = {

    detalle: {
        idProveedor: 0,
        idUsuario: 0,
        fechaCompra: 0,
        tipoDocumento: 0,
        serieDocumento: '',
        numDocumento: '',
        tipoCompra: 0,
        montoTotal: 0,
        descuentoCompra: 0,
        numCuotas: 0,
        montoInteres: 0,
        montoCuota: [],
        interesCuota: [],
        fechaCuota: [],
        observaciones: 0,
        iva:      0,
        total:    0,
        subtotal: 0,
        items: []
    },
    /* Encargado de agregar un producto a nuestra colección */
    registrar: function(item) {

        item.total = (item.cantidadInsumo * item.precioInsumo);

        var existe = false;
        this.detalle.items.forEach(function(x) {
            if(x.codigoInsumo === item.codigoInsumo) {
                x.cantidadInsumo += item.cantidadInsumo;
                //x.precio_ins += item.precio_ins;
                x.total += item.total;
                existe = true;
            }
        });

        if(!existe) this.detalle.items.push(item);

        this.refrescar();

    },
    /* Encargado de actualizar el precio/cantidad de un producto */
    actualizar: function(id, row) {
        /* Capturamos la fila actual para buscar los controles por sus nombres */

        row = $(row).closest('.warning-element');

        /* Buscamos la columna que queremos actualizar */
        $(this.detalle.items).each(function(indice, fila) {

            if(indice == id) {
                /* Agregamos un nuevo objeto para reemplazar al anterior */
                compra.detalle.items[indice] = {
                    codigoInsumo: row.find("input[name='codigoInsumo']").val(),
                    insumo: row.find("label[name='insumo']").text(),
                    umInsumo: row.find("input[name='umInsumo']").val(),
                    cantidadInsumo: row.find("input[name='cantidadInsumo']").val(),
                    precioInsumo: row.find("input[name='precioInsumo']").val(),
                };

                compra.detalle.items[indice].total = compra.detalle.items[indice].precioInsumo * compra.detalle.items[indice].cantidadInsumo;
                return false;
            }

        });

        this.refrescar();
    },

    /* Encargado de retirar el producto seleccionado */
    retirar: function(id) {
        /* Declaramos un ID para cada fila */
        $(this.detalle.items).each(function(indice, fila){
            if(indice == id)
            {
                compra.detalle.items.splice(id, 1);
                return false;
            }
        });

        this.refrescar();
    },

    /* Refresca todos los productos elegidos */
    refrescar: function()  {

        this.detalle.total = 0;

        /* Declaramos un id y calculamos el total */
        $(this.detalle.items).each(function(indice, fila) {
            compra.detalle.items[indice].id = indice;
            compra.detalle.total += fila.total;
        });

        /* Calculamos el subtotal e Iva */
        this.detalle.iva      = (this.detalle.total * 0.13).toFixed(2); // 13 % El IVA y damos formato a 2 deciamles
        this.detalle.subtotal = (this.detalle.total - this.detalle.iva).toFixed(2); // Total - IVA y formato a 2 decimales
        this.detalle.total    = (this.detalle.total).toFixed(2);

        var template   = $.templates("#detalleCompraTemplate");
        var htmlOutput = template.render(this.detalle);
        var da = this.detalle.total;

        $("#detalleCompra").html(htmlOutput);
        $("#montoTotalContado").val(da);
        //$("#monto_cre").val(da);
        montoTotal();
    }
};

/* Total de la compra */
var montoTotal = function() {
    var moneda = '$';
    var montoTotal = $("#montoTotalContado").val(),
        descuento = $("#totalDescuento").val(),
        total = (montoTotal - descuento).toFixed(2),
        iva = (total * parseFloat(0.13)).toFixed(2),
        subt = (total - iva).toFixed(2);
    $("#totalIva").text(moneda + ' ' + iva);
    $("#subTotalCompra").text(moneda + ' ' + subt);

};


$(".dec input").keypress(function(event) {
    var valueKey=String.fromCharCode(event.which);
    var keycode=event.which;
    if(valueKey.search('[0-9.]')!=0 && keycode!=8){
        return false;
    }
});

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

/*=============================================
AGREGAR INSUMOS AL DETALLE DE COMPRA
=============================================*/

$("#btnAgregar").click(function () {

    if($('#idInsumo').val() == ''){

        $("#txtBusquedaInsumo").focus();
        toastr["warning"]("Debe buscar y seleccionar un insumo");
        return false;

    } else if ($('#cantidadInsumo').val() == '') {

        $("#cantidadInsumo").focus();
        toastr["warning"]("Debes Agregar una Cantidad");
        return false;

    } else if ($('#precioInsumo').val() == '') {

        $("#precioInsumo").focus();
        toastr["warning"]("Debes agregar el precio del insumo");
        return false;

    } else {

        toastr["success"]("Producto Agregado");

        $("#detalleVacio").css('display','none');

        compra.registrar({
            codigoInsumo: parseInt($("#idInsumo").val()),
            insumo: $("#txtBusquedaInsumo").val(),
            umInsumo: $("#umInsumo").text(),
            cantidadInsumo: parseFloat($("#cantidadInsumo").val()),
            precioInsumo: parseFloat($("#precioInsumo").val()),
        });
        $("#idInsumo").val('');
        $("#txtBusquedaInsumo").val('');
        $("#cantidadInsumo").val('');
        $("#precioInsumo").val('');
        $("#txtBusquedaInsumo").focus();

        montoTotal();

    }

});

$('#montoTotalContado, #totalDescuento').on('keyup', function(){
    montoTotal();
});


// Funcion para guardar la compra

function guardarCompra() {

    compra.detalle.idProveedor = $("#idProveedor").val();
    compra.detalle.idUsuario = $("#idUsuario").val();
    compra.detalle.tipoCompra = "Contado";
    compra.detalle.fechaCompra = $("#fechaCompra").val();
    compra.detalle.tipoDocumento = $("#tipoDocumento").val();
    compra.detalle.serieDocumento = $("#serieDocumento").val();
    compra.detalle.numDocumento = $("#numDocumento").val();
    compra.detalle.montoTotal = $("#montoTotalContado").val();
    compra.detalle.descuentoCompra = $("#totalDescuento").val();
    compra.detalle.observaciones = $("#observaciones").val();

    $.ajax({
        url: 'ajax/nuevaCompra.Ajax.php',
        type: 'POST',
        data: compra.detalle,
        success: function (respuesta) {

            console.log(respuesta);

            if(respuesta === "ok"){

                swal({
                    type: "success",
                    title: "La compra ha sido guardada correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {

                        window.location = "compras";

                    }
                })
            }

        }
    })



}

$("#btnGuardarCompra").on('click', function () {

    if(compra.detalle.items.length === 0) {

        $("#txtBusquedaInsumo").focus();
        toastr["warning"]("¡Debes agregar al menos un producto al detalle!");
        return false;

    } else if($("#fechaCompra").val() == "") {

        $("#fechaCompra").focus();
        toastr["warning"]("¡Debes indicar la fecha de la compra!");
        return false;

    } else {
        guardarCompra();
    }

});


