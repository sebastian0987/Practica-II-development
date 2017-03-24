/**
 * Created by tatan on 15-02-2017.
 */
$(document).ready(function () {
    solicitarRut();
    $("#btAceptar").click(function () {
        $("#modalConfirmacion").modal('show');
    });
    $("#btConfirmar").click(function () {
        eliminarJugador(document.getElementById("tbRut").value);
    });
    $('#btAceptarModalSolicitud').click(function () {
        if (document.getElementById("btAceptarModalSolicitud").innerHTML == "Buscar") {
            if (document.getElementById("tbBuscarJugador").value == "") {
                document.getElementById("errorModalSolicitar").innerHTML = "Debe ingresar un RUT para continuar.";
                return;
            }
            obtenerJugador(document.getElementById("tbBuscarJugador").value);
        } else {
            document.getElementById("encabezadoModalSolicitar").style.backgroundColor = "#BDE5F8";
            document.getElementById("tituloModalSolicitud").innerHTML = "Buscar Jugador";
            document.getElementById("mensajeModalSolicitud").innerHTML = "Ingrese RUT del jugador:";
            document.getElementById("btAceptarModalSolicitud").innerHTML = "Buscar"
            document.getElementById("tbBuscarJugador").style.display = 'initial';
            solicitarRut();
        }
    });
});

function solicitarRut() {
    $('#modalSolicitar').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#modalSolicitar').modal('show');

}

function obtenerJugador(rut) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-jugador.php",
        data: {
            tipo: "obtenerJugador",
            Rut: rut
        }
    }).done(function (data) {
        if (data == "vacio") {
            document.getElementById("errorModalSolicitar").innerHTML = "No existe ningun jugador en el sistema con el RUT ingresado.";
            return;
        } else {
            var opts = $.parseJSON(data);
            document.getElementById("tbRut").value = opts[0][0];
            document.getElementById("tbNombre").value = opts[0][1];
            document.getElementById("tbFechaNacimiento").value = opts[0][2];
            document.getElementById("tbFechaInscripcion").value = opts[0][3];
            document.getElementById("tbRolJugador").value = opts[0][4];
            document.getElementById("tbRolAndaba").value = opts[0][5];
            $('#dropdownCategoria').append('<option value="' + opts[0][6] + '">' + opts[0][7] + '</option>');
            $('#dropdownClub').append('<option value="' + opts[0][8] + '">' + opts[0][9] + '</option>');
            $('#modalSolicitar').modal('hide');
        }
    });
}

function eliminarJugador(rut) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-jugador.php",
        data: {
            tipo: "eliminar",
            Rut: rut
        }
    })
        .done(function (data) {
            if (data == "eliminado") {
                document.getElementById("encabezadoModalSolicitar").style.backgroundColor = "#DFF2BF";
                document.getElementById("tituloModalSolicitud").innerHTML = "Éxito";
                document.getElementById("mensajeModalSolicitud").innerHTML = "Se ha eliminado al jugador del sistema exitosamente.";
                document.getElementById("btAceptarModalSolicitud").innerHTML = "Eliminar otro jugador"
                document.getElementById("tbBuscarJugador").value = "";
                document.getElementById("tbBuscarJugador").style.display='none';
                document.getElementById("errorModalSolicitar").innerHTML = "";
                $('#modalSolicitar').modal('show');
                return;
            } else {
                document.getElementById("pError").innerHTML = "Han surgido problemas al intentar ingresar el jugador, por favor vuelva a intentarlo mas tarde.";
                $('#modalMensaje').modal('show');
                return;
            }
        });
}