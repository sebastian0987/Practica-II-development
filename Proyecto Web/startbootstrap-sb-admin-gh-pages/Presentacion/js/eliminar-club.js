/**
 * Created by tatan on 16-02-2017.
 */

$(document).ready(function () {
    solicitarRut();
    obtenerCategoria()
    $("#tbNombre").keypress(function (e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8)
            return true;
        patron = /[A-Za-z\s]/;
        te = String.fromCharCode(tecla);
        return patron.test(te);
    });
    var listaRutDirigente = []
    var listaCategoria = []
    $('#btAceptarModalSolicitud').click(function () {
        listaRutDirigente.length = 0;
        listaCategoria.length = 0;
        if (document.getElementById("btAceptarModalSolicitud").innerHTML == "Buscar") {
            if (document.getElementById("tbBuscar").value == "") {
                document.getElementById("errorModalSolicitar").innerHTML = "Debe ingresar un RUT para continuar.";
                return;
            }
            obtenerClubDeportivo(document.getElementById("tbBuscar").value);
        } else {
            document.getElementById("encabezadoModalSolicitar").style.backgroundColor = "#BDE5F8";
            document.getElementById("tituloModalSolicitud").innerHTML = "Buscar Club Deportivo";
            document.getElementById("mensajeModalSolicitud").innerHTML = "Ingrese RUT del Club Deportivo:";
            document.getElementById("btAceptarModalSolicitud").innerHTML = "Buscar"
            document.getElementById("tbBuscar").style.display = 'initial';
            solicitarRut();
        }
    });
    $("#btAceptar").click(function () {
        var j = 0;
        for (i = 0; i < document.getElementsByName("dirigentesRut").length; i++) {
            if (document.getElementsByName("dirigentesRut")[i].value !== "") {
                listaRutDirigente [j] = document.getElementsByName("dirigentesRut")[i].value;
                j++;
            }
        }
        $(':checkbox:checked').each(function (i) {
            listaCategoria[i] = $(this).val();
        });
        $("#modalConfirmacion").modal('show');
    });
    $('#btConfirmar').click(function () {
        var str = document.getElementById("escudoClubDeportivo").src;
        var last = str.substring(str.lastIndexOf("/") + 1, str.length);
        eliminarClub(
            document.getElementById("tbRut").value,
            listaRutDirigente,
            listaCategoria,
            last
        )
    });

});

function solicitarRut() {
    $('#modalSolicitar').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#modalSolicitar').modal('show');
}

function obtenerClubDeportivo(rut) {
    var opts;
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "obtenerClubDeportivo",
            Rut: rut
        }
    }).done(function (data) {
        if (data == "vacio") {
            document.getElementById("errorModalSolicitar").innerHTML = "No existe ningun club deportivo en el sistema con el RUT ingresado.";
            return;
        } else {
            opts = $.parseJSON(data);
            document.getElementById("tbNombre").value = opts[0][0];
            document.getElementById("tbRut").value = opts[0][1];
            document.getElementById("tbFechaFundacion").value = opts[0][2];
            document.getElementById("tbPersonalidadJuridica").value = opts[0][3];
            document.getElementById("escudoClubDeportivo").src = "image/escudos/"+opts[0][4];
            obtenerCategoriasSegunClubDeportivo(opts[0][1]);
            obtenerDirigentesSegunClubDeportivo(opts[0][1]);
        }
    });
}

function obtenerCategoriasSegunClubDeportivo(rut) {
    var listaCategoriaClub = []
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "obtenerCategoriaSegunClub",
            Rut: rut
        }
    }).done(function (data) {
        var opts = $.parseJSON(data);
        $.each(opts, function (i, d) {
            listaCategoriaClub[i] = d.codigoCategoria;
        });
        marcarCategoriaClub(listaCategoriaClub)
    });
}

function marcarCategoriaClub(listaCategoriaClub) {
    $(':checkbox').each(function (i) {
        // alert($(this).val()+"   "+listaCategoriaClub[0])
        for (j = 0; j < listaCategoriaClub.length; j++) {
            // alert($(this).val() +"   "+listaCategoriaClub[j])
            if ($(this).val() == listaCategoriaClub[j]) {
                $(this).prop('checked', true);
            }
        }
    });
}

function obtenerDirigentesSegunClubDeportivo(rut) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "obtenerDirigentesSegunClub",
            Rut: rut
        }
    }).done(function (data) {
        var opts = $.parseJSON(data);
        $.each(opts, function (i, d) {
            document.getElementsByName("dirigentesRut")[i].value = d.rutDirigente;
            document.getElementsByName("dirigentesNombre")[i].value = d.nombrePersona;
            document.getElementsByName("dirigentesCorreo")[i].value = d.correoDirigente;
            document.getElementsByName("dirigentesContacto")[i].value = d.contactoDirigente;
        });
        $('#modalSolicitar').modal('hide');
    });
}

function obtenerCategoria() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "obtenerCategorias"
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            $.each(opts, function (i, d) {
                $('#checkboxCategoria').append('<div class="checkbox"></div>').append('<label></label>').append('<input disabled type="checkbox" value="' + d.codigoCategoria + '">' + d.nombreCategoria + '');
            });
        });
}

function eliminarClub(rut,listaRutDirigente,listaCategoria,imagen) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "eliminar",
            Rut: rut,
            RutDirigente: listaRutDirigente,
            Categoria: listaCategoria,
            Imagen: imagen
        }
    }).done(function (data) {
        if (data == "eliminado") {
            document.getElementById("encabezadoModalSolicitar").style.backgroundColor = "#DFF2BF";
            document.getElementById("tituloModalSolicitud").innerHTML = "Éxito";
            document.getElementById("mensajeModalSolicitud").innerHTML = "Se ha eliminado el Club Deportivo del sistema exitosamente.";
            document.getElementById("btAceptarModalSolicitud").innerHTML = "Eliminar otro Club Deportivo"
            document.getElementById("tbBuscar").value = "";
            document.getElementById("tbBuscar").style.display = 'none';
            document.getElementById("errorModalSolicitar").innerHTML = "";
            $('#modalSolicitar').modal('show');
            return;
        } else {
            document.getElementById("pError").innerHTML = "Han surgido problemas al intentar eliminar el Club Deportivo, por favor vuelva a intentarlo mas tarde.";
            $('#modalMensaje').modal('show');
            return;
        }
    });
}

