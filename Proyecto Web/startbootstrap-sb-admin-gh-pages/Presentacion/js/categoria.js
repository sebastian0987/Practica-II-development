/**
 * Created by tatan on 20-02-2017.
 */
$(document).ready(function () {
    obtenerListaCategoria()
    solicitarCategoria();
    $('#btAceptarModalSolicitud').click(function () {
        if (document.getElementById("dropdownCategoria").value == "") {
            document.getElementById("errorModalSolicitar").innerHTML = "Debe seleccionar una categoría para continuar.";
            return;
        }
        var e = document.getElementById("dropdownCategoria");
        var categoria = e.options[e.selectedIndex].text;
        document.getElementById("encabezadoCategoria").innerHTML = categoria;
        $('#modalSolicitar').modal('hide');
        // obtenerClubSegunCategoria(document.getElementById("dropdownCategoria").value);
    });

    $('#btMostrarOcultarJugadores').click(function () {
        if (document.getElementById("btMostrarOcultarJugadores").innerHTML == "Ocultar Lista de Jugadores") {
            $("#listaJugadores").toggle('hide');
            $('#cuerpoTablaJugador').empty();
            document.getElementById("btMostrarOcultarJugadores").innerHTML = "Mostrar Lista de Jugadores";
        } else {
            document.getElementById("btCargandoJugador").style.display = 'initial';
            obtenerJugadorSegunCategoria(document.getElementById("dropdownCategoria").value);
            document.getElementById("btMostrarOcultarJugadores").innerHTML = "Ocultar Lista de Jugadores"
        }
    });

    $('#btMostrarOcultarClubDeportivo').click(function () {
        if (document.getElementById("btMostrarOcultarClubDeportivo").innerHTML == "Ocultar Lista de Club Deportivos") {
            $("#listaClubDeportivo").toggle('hide');
            $('#cuerpoTablaClub').empty();
            document.getElementById("btMostrarOcultarClubDeportivo").innerHTML = "Mostrar Lista de Club Deportivos";
        } else {
            document.getElementById("btCargandoClub").style.display = 'initial';
            obtenerClubSegunCategoria(document.getElementById("dropdownCategoria").value);
            document.getElementById("btMostrarOcultarClubDeportivo").innerHTML = "Ocultar Lista de Club Deportivos"
        }
    });
});

function solicitarCategoria() {
    $('#modalSolicitar').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#modalSolicitar').modal('show');
}

function obtenerListaCategoria(){
    $('#dropdownCategoria').append('<option disabled selected value> -- seleccione una opción -- </option>');
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
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

function obtenerClubSegunCategoria(codigo) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "obtenerClubDeportivoSegunCategoria",
            Codigo: codigo
        }
    }).done(function (data) {
        var opts = $.parseJSON(data);
        $.each(opts, function (i, d) {
            $('#cuerpoTablaClub').append(
                '<tr>' +
                '<td>' + d.rutClubDeportivo + '</td>' +
                '<td>' + d.nombreClubDeportivo + '</td>' +
                '<td>' + d.fechaFundacion + '</td>' +
                '<td>' + d.personalidadJuridica + '</td>' +
                '</tr>'
            );
        });
        document.getElementById("btCargandoClub").style.display = 'none';
        $("#listaClubDeportivo").toggle('show');
    });
}

function obtenerJugadorSegunCategoria(codigo) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "obtenerJugadorSegunCategoria",
            Codigo: codigo
        }
    }).done(function (data) {
        var opts = $.parseJSON(data);
        $.each(opts, function (i, d) {
            $('#cuerpoTablaJugador').append(
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
        document.getElementById("btCargandoJugador").style.display = 'none';
        $("#listaJugadores").toggle('show');
    });
}