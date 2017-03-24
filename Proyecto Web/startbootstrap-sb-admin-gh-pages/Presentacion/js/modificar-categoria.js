/**
 * Created by tatan on 17-02-2017.
 */
$(document).ready(function () {
    obtenerListaCategorias();
    // $("#tbMinutos").keypress(function (e) {
    //     tecla = (document.all) ? e.keyCode : e.which;
    //     if (tecla == 8)
    //         return true;
    //     patron = /^\d+$/;
    //     te = String.fromCharCode(tecla);
    //     return patron.test(te);
    // });
    $("#btAceptar").click(function () {
        if (document.getElementById("dropdownCategoria").value == "") {
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
            document.getElementById("h4Error").innerHTML = "Error";
            document.getElementById("pError").innerHTML = "Debe seleccionar una categoría para continuar.";
            $('#modalMensaje').modal('show');
            return
        }
        if (document.getElementById("tbNombre").value == "") {
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
            document.getElementById("h4Error").innerHTML = "Error";
            document.getElementById("pError").innerHTML = "Debe ingresar un nombre a la categoría para continuar.";
            $('#modalMensaje').modal('show');
            return
        }
        $("#modalConfirmacion").modal('show');
    });
    $('#btConfirmar').click(function () {
        modificarCategoria(document.getElementById("dropdownCategoria").value, document.getElementById("tbNombre").value);
    });
});

function obtenerListaCategorias() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-categoria.php",
        data: {
            tipo: "obtenerCategorias"
        }
    }).done(function (data) {
        var opts = $.parseJSON(data);
        $.each(opts, function (i, d) {
            $('#dropdownCategoria').append('<option value="' + d.codigoCategoria + '">' + d.nombreCategoria + '</option>');
        });
    });
}

function obtenerNombre() {
    var e = document.getElementById("dropdownCategoria");
    var nombre = e.options[e.selectedIndex].text;
    //var minutos = e.options[e.selectedIndex].id;
    document.getElementById("tbNombre").value = nombre;
    //document.getElementById("tbMinutos").value = minutos;
}

function modificarCategoria(codigo, nuevoNombre) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-categoria.php",
        data: {
            tipo: "modificar",
            Codigo: codigo,
            Nombre: nuevoNombre
        }
    }).done(function (data) {
        if(data=="modificado"){
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#DFF2BF";
            document.getElementById("h4Error").innerHTML = "Éxito";
            document.getElementById("pError").innerHTML = "Las modificaciones de la categoría fueron ingresadas exitosamente.";
            $('#modalMensaje').modal('show');
            limpiarCampos();
            return
        }else {
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
            document.getElementById("h4Error").innerHTML = "Error";
            document.getElementById("pError").innerHTML = "Han surgido problemas al intentar modificar la categoria, por favor vuelva a intentarlo mas tarde.";
            $('#modalMensaje').modal('show');
            return;
        }
    });
}

function limpiarCampos() {
    $('#dropdownCategoria').empty();
    $('#dropdownCategoria').append('<option disabled selected value> -- seleccione una opcion -- </option>');
    obtenerListaCategorias();
    document.getElementById("tbNombre").value = "";
    //document.getElementById("tbMinutos").value = "";
}