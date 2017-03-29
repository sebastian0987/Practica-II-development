/**
 * Created by tatan on 19-01-2017.
 */
$(document).ready(function () {
    obtenerListaClub();
    solicitarRut();
    $('#btMostrarOcultarJugadores').click(function () {
        if (document.getElementById("btMostrarOcultarJugadores").innerHTML == "Ocultar Lista de Jugadores") {
            $("#listaJugadores").toggle('hide');
            $('#cuerpoTabla').empty();
            document.getElementById("btMostrarOcultarJugadores").innerHTML = "Mostrar Lista de Jugadores";
        } else {
            document.getElementById("btCargando").style.display = 'initial';
            obtenerJugadorSegunClub(document.getElementById("dropdownClub").value);
            document.getElementById("btMostrarOcultarJugadores").innerHTML = "Ocultar Lista de Jugadores"
        }
    });
    $('#btAceptarModalSolicitud').click(function () {
        if (document.getElementById("dropdownClub").value == "") {
            document.getElementById("errorModalSolicitar").innerHTML = "Debe seleccionar un Club Deportivo para continuar.";
            return;
        }
        obtenerClubDeportivo(document.getElementById("dropdownClub").value)
    });
});

function solicitarRut() {
    $('#modalSolicitar').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#modalSolicitar').modal('show');
}

function obtenerListaClub() {
    $('#dropdownClub').append('<option disabled selected value> -- seleccione una opción -- </option>');
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "obtenerListaClub"
        }
    }).done(function (data) {
        var opts = $.parseJSON(data);
        $.each(opts, function (i, d) {
            $('#dropdownClub').append('<option value="' + d.rutClubDeportivo + '">' + d.nombreClubDeportivo + '</option>');
        });
    });
}

function obtenerClubDeportivo(rut) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "obtenerClubDeportivo",
            Rut: rut
        }
    }).done(function (data) {
        var opts = $.parseJSON(data);
        document.getElementById("encabezadoClubDeportivo").innerHTML = opts[0][0];
        $('#datosClub').append('<label>Nombre: ' + opts[0][0] + '</label><br>');
        $('#datosClub').append('<label>RUT: ' + opts[0][1] + '</label><br>');
        $('#datosClub').append('<label>Fecha de Fundación: ' + opts[0][2] + '</label><br>');
        $('#datosClub').append('<label>Personalidad Juridica: ' + opts[0][3] + '</label><br>');
        document.getElementById("escudoClubDeportivo").src = "image/escudos/"+opts[0][4];
        obtenerDirigenteSegunClub(rut);
        $('#modalSolicitar').modal('hide');
    });
}

function obtenerDirigenteSegunClub(rut) {
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
            $('#datosDirigentes').append('<label>Nombre: ' + opts[i][1] + '</label><label>,  Correo: ' + opts[i][2] + '</label><label>,  Telefono: ' + opts[i][3] + '</label><br>');
        });
    });
}

function obtenerJugadorSegunClub(rut) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "obtenerJugadorSegunClub",
            Rut: rut
        }
    }).done(function (data) {
        var opts = $.parseJSON(data);
        $.each(opts, function (i, d) {
            $('#cuerpoTabla').append(
                '<tr>' +
                '<td>' + d.rutPersona + '</td>' +
                '<td>' + d.nombrePersona + '</td>' +
                '<td>' + d.nombreCategoria + '</td>' +
                '<td>' + d.fechaNacimiento + '</td>' +
                '<td>' + d.fechaInscripcion + '</td>' +
                '<td>' + d.rolJugador + '</td>' +
                '</tr>'
            );
        });
        document.getElementById("btCargando").style.display = 'none';
        $("#listaJugadores").toggle('show');
    });
}