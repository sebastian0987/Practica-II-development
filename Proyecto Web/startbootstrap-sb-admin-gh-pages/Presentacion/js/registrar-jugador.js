/**
 * Created by tatan on 20-01-2017.
 */
$(document).ready(function () {
    obtenerListaCategorias();
    $("#tbNombre").keypress(function (e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8)
            return true;
        patron = /[A-Za-zÑñáéíóúÁÉÍÓÚ\s]/;
        te = String.fromCharCode(tecla);
        return patron.test(te);
    });
    $("#tbRolJugador").keypress(function (e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8)
            return true;
        patron = /^\d+$/;
        te = String.fromCharCode(tecla);
        return patron.test(te);
    });
    $("#tbRolAndaba").keypress(function (e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8)
            return true;
        patron = /^\d+$/;
        te = String.fromCharCode(tecla);
        return patron.test(te);
    });
    // $("#tbApellidos").keypress(function (e) {
    //     tecla = (document.all) ? e.keyCode : e.which;
    //     if (tecla == 8)
    //         return true;
    //     patron = /[A-Za-z\s]/;
    //     te = String.fromCharCode(tecla);
    //     return patron.test(te);
    // });
    $("#btAceptar").click(function () {
        if (document.getElementById("tbNombre").value == ""
            // || document.getElementById("tbApellidos").value == ""
            || document.getElementById("tbRut").value == ""
            || document.getElementById("dropdownCategoria").value == ""
            || document.getElementById("dropdownClub").value == ""
            || document.getElementById("tbFechaInscripcion").value == ""
            || document.getElementById("tbFechaNacimiento").value == ""
            || document.getElementById("tbRolJugador").value == ""
            || document.getElementById("tbRolAndaba").value == "") {
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
            document.getElementById("h4Error").innerHTML = "Error";
            document.getElementById("pError").innerHTML = "Debe completar los campos marcados para continuar.";
            $('#modalMensaje').modal('show');
            document.getElementById("advertencia1").style.color = "#FF0000";
            document.getElementById("advertencia2").style.color = "#FF0000";
            document.getElementById("advertencia3").style.color = "#FF0000";
            document.getElementById("advertencia4").style.color = "#FF0000";
            document.getElementById("advertencia5").style.color = "#FF0000";
            document.getElementById("advertencia6").style.color = "#FF0000";
            document.getElementById("advertencia7").style.color = "#FF0000";
            document.getElementById("advertencia8").style.color = "#FF0000";
            // document.getElementById("advertencia9").style.color = "#FF0000";
            return;
        }


        if (!validarRut(document.getElementById("tbRut").value)) {
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
            document.getElementById("h4Error").innerHTML = "Error";
            document.getElementById("pError").innerHTML = "El RUT ingresado no es valido.";
            $('#modalMensaje').modal('show');
            return;
        }

        // document.getElementById("pError").innerHTML = "El jugador fue ingresado exitosamente.";
        $('#modalConfirmacion').modal('show');

        // // Confirmar el envio de datosGrupo
        // if (confirm('¿Estas seguro de enviar este formulario?')) {
        //     // var e = document.getElementById("dropdownCategoria");
        //     // var categoria = e.options[e.selectedIndex].text;
        //     // e = document.getElementById("dropdownClub");
        //     // var club = e.options[e.selectedIndex].text;
        //
        //     obtenerCodigoEquipo(
        //         document.getElementById("dropdownCategoria").value,
        //         document.getElementById("dropdownClub").value
        //     );
        //
        // };
    });
    $('#btConfirmar').click(function () {
        obtenerCodigoEquipo(
            document.getElementById("dropdownCategoria").value,
            document.getElementById("dropdownClub").value
        );
    });
});

function validarRut(rutCompleto) {
    cantRut = rutCompleto.length - 1;
    rut = rutCompleto.substr(0, cantRut);
    digv = rutCompleto.substr(cantRut, rutCompleto.length);
    if (digv == 'K')
        digv = 'k';
    var M = 0, S = 1, T = rut;
    for (; T; T = Math.floor(T / 10))
        S = (S + T % 10 * (9 - M++ % 6)) % 11;
    if (S) {
        return (S - 1 == digv);
    } else {
        return ('k' == digv);
    }
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
    }).done(function (data) {
        ingresarJugador(
            document.getElementById("btAceptar").value,
            document.getElementById("tbRut").value,
            document.getElementById("tbNombre").value,
            // document.getElementById("tbApellidos").value,
            data,
            document.getElementById("tbFechaNacimiento").value,
            document.getElementById("tbFechaInscripcion").value,
            document.getElementById("tbRolJugador").value,
            document.getElementById("tbRolAndaba").value
            // document.getElementById("fotoJugador").value
        );
    });
}

function ingresarJugador(accion, rut, nombre, codigoEquipo, fechaNacimiento, fechaInscripcion, rolJugador, rolANDABA) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-jugador.php",
        data: {
            tipo: accion,
            Rut: rut,
            Nombre: nombre,
            // Apellidos: apellidos,
            Equipo: codigoEquipo,
            FechaNacimiento: fechaNacimiento,
            FechaInscripcion: fechaInscripcion,
            RolJugador: rolJugador,
            RolAndaba: rolANDABA
        }
    }).done(function (data) {
        if (data == "ingresado") {
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#DFF2BF";
            document.getElementById("h4Error").innerHTML = "Éxito";
            document.getElementById("pError").innerHTML = "El jugador fue ingresado exitosamente.";
            $('#modalMensaje').modal('show');
            limpiarCampos();
            return;
        } else {
            if (data == "repetido") {
                document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
                document.getElementById("h4Error").innerHTML = "Error";
                document.getElementById("pError").innerHTML = "Ya existe un Jugador con el mismo rut en el sistema.";
                $('#modalMensaje').modal('show');
                return;
            } else {
                document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
                document.getElementById("h4Error").innerHTML = "Error";
                document.getElementById("pError").innerHTML = "Han surgido problemas al intentar ingresar el jugador, vuelva a intentarlo mas tarde.";
                $('#modalMensaje').modal('show');
                return;
            }
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
            // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
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
    }).done(function (data) {
        var opts = $.parseJSON(data);

        $.each(opts, function (i, d) {
            // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
            $('#dropdownCategoria').append('<option value="' + d.codigoCategoria + '">' + d.nombreCategoria + '</option>');
        });
    });
}

function limpiarCampos() {
    document.getElementById("tbRut").value = "";
    document.getElementById("tbNombre").value = "";
    // document.getElementById("tbApellidos").value = "";
    document.getElementById("tbFechaNacimiento").value = "";
    document.getElementById("tbFechaInscripcion").value = "";
    document.getElementById("tbRolJugador").value = "";
    document.getElementById("tbRolAndaba").value = "";
    $('#dropdownCategoria').empty();
    $('#dropdownCategoria').append('<option disabled selected value> -- seleccione una opción -- </option>');
    obtenerListaCategorias();
    $('#dropdownClub').empty();
    $('#dropdownClub').append('<option disabled selected value> -- seleccione una opción -- </option>');
    // document.getElementById("fotoJugador").value = "";
}