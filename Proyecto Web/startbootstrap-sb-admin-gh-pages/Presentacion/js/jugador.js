/**
 * Created by tatan on 20-02-2017.
 */
$(document).ready(function () {
    solicitarRut();
    $('#btAceptarModalSolicitud').click(function () {
        if (document.getElementById("tbBuscarJugador").value == "") {
            document.getElementById("errorModalSolicitar").innerHTML = "Debe ingresar el RUT de un jugador para continuar.";
            return;
        }
        obtenerSancion(document.getElementById("tbBuscarJugador").value);
        // obtenerDatosJugador(document.getElementById("tbBuscarJugador").value);
    });
});

function solicitarRut() {
    $('#modalSolicitar').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#modalSolicitar').modal('show');
}

function obtenerDatosJugador(rut, sancion) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-jugador.php",
        data: {
            tipo: "obtenerJugador",
            Rut:rut
        }
    }).done(function (data) {
        if (data == "vacio"){
            document.getElementById("errorModalSolicitar").innerHTML = "No existe ningun jugador en el sistema con el RUT ingresado.";
        }else {
            var opts = $.parseJSON(data);
            document.getElementById("encabezadoJugador").innerHTML = opts[0][1];
            $.each(opts, function (i, d) {
                $('#cuerpoTablaJugador').append(
                    '<tr>' +
                    '<td>' + d.rutPersona + '</td>' +
                    '<td>' + d.nombrePersona + '</td>' +
                    '<td>' + opts[0][9] + '</td>' +
                    '<td>' + opts[0][7] + '</td>' +
                    '<td>' + d.fechaNacimiento + '</td>' +
                    '<td>' + d.fechaInscripcion + '</td>' +
                    '<td>' + d.rolJugador + '</td>' +
                    '<td>' + d.rolANDABA + '</td>' +
                    '<td>' + sancion + '</td>' +
                    '</tr>'
                );
            });
            $('#modalSolicitar').modal('hide');
        }
    });
}

function  obtenerSancion(rut) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-jugador.php",
        data: {
            tipo: "obtenerSancion",
            Rut:rut
        }
    }).done(function (data) {
        if (data==""){
            obtenerDatosJugador(rut,"Sin Sanción");
        }else {
            obtenerDatosJugador(rut,data);
        }
    });
}
