/**
 * Created by Andrés on 26-02-2017.
 */
$(document).ready(function() {
    obtenerListaCategorias();
    // obtenerListaTorneos(document.getElementById("dropdownCategoria").value.toString());
    $('#horaIni').combodate({
        firstItem: 'none', //show 'hour' and 'minute' string at first item of dropdown
        minuteStep: 5,
        value: '00:00'
    });
    $('#horaFin').combodate({
        firstItem: 'none', //show 'hour' and 'minute' string at first item of dropdown
        minuteStep: 5,
        value: '00:00'
    });
    $("#aceptar").click(function () {
        if (document.getElementById("dropdownCategoria").value == ""
            || document.getElementById("dropdownClub1").value.toString() === ""
            || document.getElementById("dropdownClub2").value.toString()  === ""
            || document.getElementById("tbFechaInscripcion").value == ""
            || document.getElementById("horaIni").value == ""
            || document.getElementById("horaFin").value == ""
            || document.getElementById("dropdownTorneo").value.toString()  === "")
        {
            document.getElementById("pError").innerHTML = "Debe completar los campos marcados para continuar.";
            $('#modalMensaje').modal('show');
            document.getElementById("advertencia1").style.color = "#FF0000";
            document.getElementById("advertencia2").style.color = "#FF0000";
            document.getElementById("advertencia3").style.color = "#FF0000";
            document.getElementById("advertencia4").style.color = "#FF0000";
            document.getElementById("advertencia5").style.color = "#FF0000";
            document.getElementById("advertencia6").style.color = "#FF0000";
            document.getElementById("advertencia9").style.color = "#FF0000";
            return;

        } else {
            if ((document.getElementById("dropdownClub1").value.toString().localeCompare(document.getElementById("dropdownClub2").value.toString())==0)) {
                document.getElementById("pError").innerHTML = "Asegúrese de que los clubes deportivos sean distintos";
                $('#modalMensaje').modal('show');
                return;
            }
            if(document.getElementById("horaIni").value > document.getElementById("horaFin").value ){
                document.getElementById("pError").innerHTML = "La hora de inicio no puede ser antes de la hora de término";
                $('#modalMensaje').modal('show');
                return;
            }
        }
        $('#modalConfirmacion').modal('show');
    });

    $('#confirmar').click(function () {
        var categoria =  document.getElementById("dropdownCategoria").value.toString();
        var club1 = document.getElementById("dropdownClub1").value.toString();
        var club2 = document.getElementById("dropdownClub2").value.toString();
        var fecha = document.getElementById("tbFechaInscripcion").value;
        var horaIni = document.getElementById("horaIni").value;
        var horaFin = document.getElementById("horaFin").value;
        var cancha = document.getElementById("cancha").value;
        var torneo = document.getElementById("dropdownTorneo").value.toString();
        insertarPartido(categoria, club1, club2, fecha, horaIni, horaFin, cancha, torneo);
    });
});

function obtenerListaTorneos(categoria) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-torneo.php",
        async: false,
        data: {
            // tipo: "obtenerListaTorneos",
            tipo: "obtenerTorneosPorCategoria",
            categoria: categoria
        }
    })
        .done(function (data) {
            // alert(data);
            var opts = $.parseJSON(data);
            torneos = [];
            $('#dropdownTorneo').empty().append('<option value="' + 1 + '">' + "Amistoso" + '</option>');
            $.each(opts, function (i, d) {
                torneos = d.codigoTorneo;
                $('#dropdownTorneo').append('<option value="' + d.codigoTorneo + '">' + d.nombreTorneo + '</option>');
            });
        });
}
function insertarPartido(categoria, club1,  club2, fecha, horaIni, horaFin, cancha, torneo) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        data: {
            tipo: 'crear',
            categoria: categoria,
            club1: club1,
            club2: club2,
            fecha: fecha,
            horaIni: horaIni,
            horaFin: horaFin,
            cancha: cancha,
            torneo: torneo
        }
    })
        .done(function (data) {
            if (data == "ingresado") {
                document.getElementById("pError").innerHTML = "El partido fue ingresado exitosamente.";
                document.getElementById("h4Error").innerHTML = "Éxito";
                $('#modalMensaje').modal('show');
                return;
            } else {
                if (data == "repetido") {
                    document.getElementById("pError").innerHTML = "Ya existe un Jugador con el mismo rut en el sistema.";
                    $('#modalMensaje').modal('show');
                    return;
                } else {
                    document.getElementById("h4Error").innerHTML = "Error";
                    document.getElementById("pError").innerHTML = "Han surgido problemas al intentar ingresar el jugador, vuelva a intentarlo mas tarde.";
                    $('#modalMensaje').modal('show');
                    return;
                }
            }
        });
}

function obtenerListaClubes(categoria) {
    $('#dropdownClub1').empty().append('<option disabled selected value> -- Seleccione una opción -- </option>');
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        data: {
            tipo: "obtenerClubes",
            categoria: categoria
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            $.each(opts, function (i, d) {
                // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                $('#dropdownClub1').append('<option value="' + d.rutClubDeportivo + '">' + d.nombreClubDeportivo + '</option>');
            });
        });

    $('#dropdownClub2').empty().append('<option disabled selected value> -- Seleccione una opción -- </option>');
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        data: {
            tipo: "obtenerClubes",
            categoria: categoria
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            $.each(opts, function (i, d) {
                // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                $('#dropdownClub2').append('<option value="' + d.rutClubDeportivo + '">' + d.nombreClubDeportivo + '</option>');
            });
        });
}

function obtenerListaCategorias() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        data: {
            tipo: "obtenerCategorias"
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);

            $.each(opts, function (i, d) {
                // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                $('#dropdownCategoria').append('<option value="' + d.codigoCategoria + '">' + d.nombreCategoria + '</option>');
            });
        });
}