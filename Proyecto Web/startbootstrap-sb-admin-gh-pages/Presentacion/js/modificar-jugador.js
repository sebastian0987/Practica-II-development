/**
 * Created by tatan on 14-02-2017.
 */
$(document).ready(function () {
    solicitarRut();
    $("#tbNombre").keypress(function (e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8)
            return true;
        patron = /[A-Za-z\s]/;
        te = String.fromCharCode(tecla);
        return patron.test(te);
    });
    $("#btAceptar").click(function () {
        if (document.getElementById("tbNombre").value == ""
            || document.getElementById("dropdownCategoria").value == ""
            || document.getElementById("dropdownClub").value == ""
            || document.getElementById("tbFechaInscripcion").value == ""
            || document.getElementById("tbFechaNacimiento").value == "") {
            document.getElementById("pError").innerHTML = "Debe completar todos los campos para continuar.";
            $('#modalMensaje').modal('show');
            return;
        }
        $("#modalConfirmacion").modal('show');

    });
    $("#btConfirmar").click(function () {
        obtenerCodigoEquipo(
            document.getElementById("dropdownCategoria").value,
            document.getElementById("dropdownClub").value
        );
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
            $('#dropdownCategoria').append('<option disabled selected value="' + opts[0][6] + '">' + opts[0][7] + " (Categoria Actual)" + '</option>');
            $('#dropdownClub').append('<option disabled selected value="' + opts[0][8] + '">' + opts[0][9] + " (Club Deportivo Actual)" + '</option>');
            primerListaClubes(opts[0][6]);
            $('#modalSolicitar').modal('hide');
            obtenerSancion(rut);
            obtenerListaCategorias();
        }
    });
}

function obtenerCodigoEquipo(categoria, club) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-jugador.php",
        data: {
            tipo: "obtenerEquipo",
            Categoria: categoria,
            Club: club,
        }
    })
        .done(function (data) {
            modificarJugador(
                document.getElementById("tbRut").value,
                document.getElementById("tbNombre").value,
                data,
                document.getElementById("tbFechaNacimiento").value,
                document.getElementById("tbFechaInscripcion").value,
                document.getElementById("tbFechaSancion").value
            );
        });
}

function modificarJugador(rut, nombre, codigoEquipo, fechaNacimiento, fechaInscripcion, fechaSancion) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-jugador.php",
        data: {
            tipo: "modificar",
            Rut: rut,
            Nombre: nombre,
            Equipo: codigoEquipo,
            FechaNacimiento: fechaNacimiento,
            FechaInscripcion: fechaInscripcion,
            FechaSancion: fechaSancion
        }
    })
        .done(function (data) {
            if (data == "modificado") {
                document.getElementById("encabezadoModalSolicitar").style.backgroundColor = "#DFF2BF";
                document.getElementById("tituloModalSolicitud").innerHTML = "Éxito";
                document.getElementById("mensajeModalSolicitud").innerHTML = "Las modificaciones del jugador fueron ingresadas exitosamente.";
                document.getElementById("btAceptarModalSolicitud").innerHTML = "Modificar otro jugador"
                document.getElementById("tbBuscarJugador").value = "";
                document.getElementById("tbBuscarJugador").style.display = 'none';
                document.getElementById("errorModalSolicitar").innerHTML = "";
                $('#modalSolicitar').modal('show');
                return;
            } else {
                document.getElementById("h4Error").innerHTML = "Error";
                document.getElementById("pError").innerHTML = "Han surgido problemas al intentar ingresar el jugador, por favor vuelva a intentarlo mas tarde.";
                $('#modalMensaje').modal('show');
                return;
            }
        });
}

function obtenerListaClubes(categoria) {
    $('#dropdownClub').empty();
    $('#dropdownClub').append('<option disabled selected value> -- seleccione una opción -- </option>');
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-jugador.php",
        data: {
            tipo: "obtenerClubes",
            codigo: categoria
        }
    }).done(function (data) {
        var opts = $.parseJSON(data);
        $.each(opts, function (i, d) {
            $('#dropdownClub').append('<option value="' + d.rutClubDeportivo + '">' + d.nombreClubDeportivo + '</option>');
        });
    });
}

function primerListaClubes(categoria) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-jugador.php",
        data: {
            tipo: "obtenerClubes",
            codigo: categoria
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            $.each(opts, function (i, d) {
                $('#dropdownClub').append('<option value="' + d.rutClubDeportivo + '">' + d.nombreClubDeportivo + '</option>');
            });
        });
}

function obtenerListaCategorias() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-jugador.php",
        data: {
            tipo: "obtenerCategorias"
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            $.each(opts, function (i, d) {
                $('#dropdownCategoria').append('<option value="' + d.codigoCategoria + '">' + d.nombreCategoria + '</option>');
            });
        });
}

function obtenerSancion(rut) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-jugador.php",
        data: {
            tipo: "obtenerSancion",
            Rut: rut
        }
    }).done(function (data) {
        document.getElementById("tbFechaSancion").value = data;
    });
}