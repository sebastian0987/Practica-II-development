/**
 * Created by Andrés on 29-01-2017.
 */
var torneos = [];
var categorias = [];

$(document).ready(function () {
    obtenerListaCategorias();
    var partido;
    $('#golesEquipo1').on('change keyup', function () {
        var sanitized = $(this).val().replace(/[^0-9]]/g, '');
        $(this).val(sanitized);
    });
    $('#golesEquipo2').on('change keyup', function () {
        var sanitized = $(this).val().replace(/[^0-9]/g, '');
        $(this).val(sanitized);
    });

    $('#calendar').fullCalendar({

        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'listDay,listWeek,month'

        },

        // customize the button names,
        // otherwise they'd all just say "list"
        views: {
            listDay: {buttonText: 'Día'},
            listWeek: {buttonText: 'Semana'}
        },
        locale: 'es',
        defaultView: 'listWeek', // 'listWeek'
        //defaultDate: '2016-12-12' // default today
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        events: '../Logica/obtener-partidos-calendario.php',

        eventClick: function (calEvent, jsEvent, view) {
            // alert(calEvent.id);

            // $('#detallePartido').modal('show');
            partido = calEvent.id;
            getPartido(partido);
            $('#detallePartido').modal('show');
        },
        // eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
        //
        //     alert(
        //         event.title + " was moved " +
        //         dayDelta + " days and " +
        //         minuteDelta + " minutes."
        //     );
        //     if (allDay) {
        //         // alert("Event is now all-day");
        //     }else{
        //         // alert("Event has a time-of-day");
        //     }
        //
        //     if (!confirm("Are you sure about this change?")) {
        //         revertFunc();
        //
        //     }
        //     $('#calendar').fullCalendar('updateEvent', calEvent);
        //
        // }

    });

    $("#eliminar").click(function () {
        $('#modalConfirmacionEliminar').modal('show');
    });
    $("#confirmarEliminar").click(function () {
        eliminarPartido(partido);
    });

    $("#guardar").click(function () {
        if (document.getElementById("dropdownCategoria").value == ""
            || document.getElementById("dropdownClub1").value.toString() === ""
            || document.getElementById("dropdownClub2").value.toString() === ""
            || document.getElementById("dropdownTorneo").value.toString() === ""
            || document.getElementById("fecha").value == ""
            || document.getElementById("horaIni").value == ""
            || document.getElementById("horaFin").value == "") {
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
            document.getElementById("advertencia9").style.color = "#FF0000";
            return;

        } else {
            if ((document.getElementById("dropdownClub1").value.toString().localeCompare(document.getElementById("dropdownClub2").value.toString()) == 0)) {
                document.getElementById("pError").innerHTML = "Asegúrese de que los clubes deportivos sean distintos";
                $('#modalMensaje').modal('show');
                return;
            }
            if (document.getElementById("horaIni").value > document.getElementById("horaFin").value) {
                document.getElementById("pError").innerHTML = "La hora de inicio no puede ser antes de la hora de término";
                $('#modalMensaje').modal('show');
                return;
            }
        }
        $('#modalConfirmacion').modal('show');
    });

    $('#confirmar').click(function () {
        var categoria = document.getElementById("dropdownCategoria").value.toString();
        var club1 = document.getElementById("dropdownClub1").value.toString();
        var club2 = document.getElementById("dropdownClub2").value.toString();
        var fecha = document.getElementById("fecha").value;
        var horaIni = document.getElementById("horaIni").value;
        var horaFin = document.getElementById("horaFin").value;
        var cancha = document.getElementById("cancha").value;
        var goles1 = document.getElementById("golesEquipo1").value;
        var goles2 = document.getElementById("golesEquipo2").value;
        var torneo = document.getElementById("dropdownTorneo").value.toString();

        // alert(categoria + " " + club1 + " " + club2 + " " + fecha + " " + horaIni + " " + horaFin + " " + cancha + " " + goles1 + " " + goles2);
        modificarPartido(partido, categoria, club1, club2, goles1, goles2, fecha, horaIni, horaFin, cancha, torneo);
        $('#calendar').fullCalendar('refetchEvents')
        // obtenerListaCategoriasGrupos();
        // obtenerListaTorneos();
    });


});

function eliminarPartido(partido) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        async: false,
        data: {
            tipo: 'eliminar',
            codigoPartido: partido
        }
    })
        .done(function (data) {
            if (data == "eliminado") {
                document.getElementById("pError").innerHTML = "El partido fue eliminado exitosamente.";
                document.getElementById("h4Error").innerHTML = "Éxito";
                $('#modalMensaje').modal('show');
                // limpiarCampos();
                location.reload();
                return;

            }
        });
    return imagen;
}
function desplegarImagenClub1(rutClub) {
    if (rutClub == -1) {
        $("#fotoEquipo1").attr("src", "image/escudos/none.png");
        return;
    }
    $("#fotoEquipo1").attr("src", "image/escudos/" + getImagenClub(rutClub));
}
function desplegarImagenClub2(rutClub) {
    if (rutClub == -1) {
        $("#fotoEquipo2").attr("src", "image/escudos/none.png");
        return;
    }
    $("#fotoEquipo2").attr("src", "image/escudos/" + getImagenClub(rutClub));
}
function getImagenClub(rutClub) {
    var imagen;
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        async: false,
        data: {
            tipo: 'obtenerImagenClub',
            rutClub: rutClub
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            imagen = opts[0][0];
            if (imagen == "" || imagen == null) {
                imagen = "none.png";
            }
        });
    return imagen;
}
function getPartido(id) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        async: false,
        data: {
            tipo: 'obtenerPartido',
            codigoPartido: id
        }
    }).done(function (data) {
        if (data == "vacio") {
            return;
        } else {

            var opts = $.parseJSON(data);
            //  0   cd1.nombreclubdeportivo,
            //  1   cd2.nombreClubDeportivo,
            //  2   e1.codigoEquipo,
            //  3   e2.codigoEquipo,
            //  4   p.golesEquipo1,
            //  5   p.golesEquipo2,
            //  6   p.fecha,
            //  7   p.horaInicio,
            //  8   p.horaFin,
            //  9   p.cancha,
            //  10  p.codigoPartido,
            //  11  e1.categoria
            //  12  cd1.codigoCD1
            //  13  cd2.codigoCD2
            //  14  t.codigoTorneo
            //  15  t.nombreTorneo

            var categoria = opts[0][11];
            var nomClub1 = opts[0][0];
            var nomClub2 = opts[0][1];
            var codClub1 = opts[0][12];
            var codClub2 = opts[0][13];
            var fecha = opts[0][6];
            var horaIni = opts[0][7];
            var horaFin = opts[0][8];
            var cancha = opts[0][9];
            var goles1 = opts[0][4];
            var goles2 = opts[0][5];
            var codTorneo = opts[0][14];


            options = document.getElementById('dropdownCategoria').options;
            for (var i = 0; i < options.length; i++) {
                if (options[i].value === categoria) {
                    options[i].selected = true;
                    break;
                }
            }
            obtenerListaTorneos(document.getElementById("dropdownCategoria").value.toString());

            options = document.getElementById('dropdownTorneo').options;
            for (var i = 0; i < options.length; i++) {
                if (options[i].value === codTorneo) {
                    options[i].selected = true;
                    break;
                }
            }
            document.getElementById("fecha").value = fecha;

            obtenerListaClubes(categoria);

            var options = document.getElementById('dropdownClub1').options;
            for (var i = 0; i < options.length; i++) {
                if (options[i].value === codClub1) {
                    options[i].selected = true;
                    break;
                }
            }
            options = document.getElementById('dropdownClub2').options;
            for (var i = 0; i < options.length; i++) {
                if (options[i].value === codClub2) {
                    options[i].selected = true;
                    break;
                }
            }

            var horaSpliteada = horaIni.split(":");
            horaIni = horaSpliteada[0] + ":" + horaSpliteada[1];
            $('#horaIni').combodate('setValue', horaIni);

            horaSpliteada = horaFin.split(":");
            horaFin = horaSpliteada[0] + ":" + horaSpliteada[1];
            $('#horaFin').combodate('setValue', horaFin);

            document.getElementById("cancha").value = cancha;
            document.getElementById("golesEquipo1").value = goles1;
            document.getElementById("golesEquipo2").value = goles2;

            desplegarImagenClub1(codClub1);
            desplegarImagenClub2(codClub2);
            $("#tituloPartido").html(nomClub1 + " vs " + nomClub2);


        }

    });
}
function getIndex(array, target) {

    for (var i = 0; i < array.length; i++) {
        // alert(array[i].toString());
        if (array[i].toString() === target.toString()) {
            return i;
        }
    }
    return -1;
}
function modificarPartido(partido, categoria, club1, club2, goles1, goles2, fecha, horaIni, horaFin, cancha, torneo) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        async: false,
        data: {
            tipo: 'modificar',
            partido: partido,
            categoria: categoria,
            club1: club1,
            club2: club2,
            fecha: fecha,
            horaIni: horaIni,
            horaFin: horaFin,
            cancha: cancha,
            torneo: torneo,
            goles1: goles1,
            goles2: goles2
        }
    })
        .done(function (data) {
            if (data == "modificado") {
                document.getElementById("pError").innerHTML = "El partido fue modificado exitosamente.";
                document.getElementById("h4Error").innerHTML = "Éxito";
                $('#modalMensaje').modal('show');
                // limpiarCampos();
                return;
            } else {
                document.getElementById("pError").innerHTML = "Han surgido problemas al intentar ingresar el partido, vuelva a intentarlo mas tarde.";
                $('#modalMensaje').modal('show');
                return;
            }
        });
}


function obtenerListaClubes(categoria) {
    $('#dropdownClub1').empty().append('<option disabled selected value> -- Seleccione una opción -- </option>');
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        async: false,
        data: {
            tipo: "obtenerClubes",
            categoria: categoria
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            $.each(opts, function (i, d) {
                $('#dropdownClub1').append('<option value="' + d.rutClubDeportivo + '">' + d.nombreClubDeportivo + '</option>');
            });
        });

    $('#dropdownClub2').empty().append('<option disabled selected value> -- Seleccione una opción -- </option>');
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        async: false,
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
            var opts = $.parseJSON(data);
            torneos = [];
            $('#dropdownTorneo').empty().append('<option value="' + 1 + '">' + "Amistoso" + '</option>');
            $.each(opts, function (i, d) {
                torneos = d.codigoTorneo;
                $('#dropdownTorneo').append('<option value="' + d.codigoTorneo + '">' + d.nombreTorneo + '</option>');
            });
        });
}

function obtenerListaCategorias() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        async: false,
        data: {
            tipo: "obtenerCategorias"
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            categorias = [];
            $.each(opts, function (i, d) {
                categorias = d.codigoCategoria;
                // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                $('#dropdownCategoria').append('<option value="' + d.codigoCategoria + '">' + d.nombreCategoria + '</option>');
            });
        });
}

function countArray(obj) {
    var count = 0;
    // iterate over properties, increment if a non-prototype property
    for (var key in obj) if (obj.hasOwnProperty(key)) count++;
    return count;
}