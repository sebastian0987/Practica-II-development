/**
 * Created by tatan on 17-02-2017.
 */
$(document).ready(function () {
    // $("#tbMinutos").keypress(function (e) {
    //     tecla = (document.all) ? e.keyCode : e.which;
    //     if (tecla == 8)
    //         return true;
    //     patron = /^\d+$/;
    //     te = String.fromCharCode(tecla);
    //     return patron.test(te);
    // });
    obtenerClubes();
    var listaClub = [];
    $("#btAceptar").click(function () {
        listaClub.length = 0;
        if (document.getElementById("tbNombre").value == "") {
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
            document.getElementById("h4Error").innerHTML = "Error";
            document.getElementById("pError").innerHTML = "Debe ingresar un nombre de la categoría para continuar.";
            $('#modalMensaje').modal('show');
            return
        }
        $(':checkbox:checked').each(function (i) {
            listaClub[i] = $(this).val();
        });
        $("#modalConfirmacion").modal('show');
    });
    $('#btConfirmar').click(function () {
        ingresarCategoria(document.getElementById("tbNombre").value, listaClub);
    });
});

function obtenerClubes() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-categoria.php",
        data: {
            tipo: "obtenerListaClub"
        }
    }).done(function (data) {
        var opts = $.parseJSON(data);
        $.each(opts, function (i, d) {
            $('#checkboxCategoria').append('<div class="checkbox"></div>').append('<label></label>').append('<input type="checkbox" value="' + d.rutClubDeportivo + '">' + d.nombreClubDeportivo + '');
        });
    });
}

function ingresarCategoria(nombre, listaClub) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-categoria.php",
        data: {
            tipo: "ingresar",
            Nombre: nombre,
            ListaClub: listaClub
        }
    }).done(function (data) {
        if (data == "ingresado") {
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#DFF2BF";
            document.getElementById("h4Error").innerHTML = "Éxito";
            document.getElementById("pError").innerHTML = "La categoría fue ingresada exitosamente.";
            $('#modalMensaje').modal('show');
            limpiarCampos();
            return;
        } else {
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
            document.getElementById("h4Error").innerHTML = "Error";
            document.getElementById("pError").innerHTML = "Han surgido problemas al intentar ingresar la nueva categoría, por favor vuelva a intentarlo mas tarde.";
            $('#modalMensaje').modal('show');
            return;
        }
    });
}

function limpiarCampos() {
    document.getElementById("tbNombre").value = "";
    $('input:checkbox').removeAttr('checked');
}
