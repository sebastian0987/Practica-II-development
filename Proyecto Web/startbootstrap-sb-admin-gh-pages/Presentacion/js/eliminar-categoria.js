/**
 * Created by tatan on 17-02-2017.
 */
$(document).ready(function () {
    obtenerListaCategorias();
    $("#btAceptar").click(function () {
        if (document.getElementById("dropdownCategoria").value == "") {
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
            document.getElementById("h4Error").innerHTML = "Error";
            document.getElementById("pError").innerHTML = "Debe seleccionar una categoría para continuar.";
            $('#modalMensaje').modal('show');
            return
        }
        $("#modalConfirmacion").modal('show');
    });
    $('#btConfirmar').click(function () {
        eliminarCategoria(document.getElementById("dropdownCategoria").value)
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

function eliminarCategoria(codigo) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-categoria.php",
        data: {
            tipo: "eliminar",
            Codigo: codigo
        }
    }).done(function (data) {
        if(data=="eliminado"){
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#DFF2BF";
            document.getElementById("h4Error").innerHTML = "Éxito";
            document.getElementById("pError").innerHTML = "Se ha eliminado la categoría del sistema exitosamente.";
            $('#modalMensaje').modal('show');
            limpiarCampos();
            return
        }else{
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
            document.getElementById("h4Error").innerHTML = "Error";
            document.getElementById("pError").innerHTML = "Han surgido problemas al intentar eliminar la categoria, por favor vuelva a intentarlo mas tarde.";
            $('#modalMensaje').modal('show');
            return;
        }
    });
}

function limpiarCampos() {
    $('#dropdownCategoria').empty();
    $('#dropdownCategoria').append('<option disabled selected value> -- seleccione una opcion -- </option>');
    obtenerListaCategorias();
}