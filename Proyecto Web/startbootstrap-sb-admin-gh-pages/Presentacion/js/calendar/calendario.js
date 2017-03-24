/**
 * Created by Andrés on 29-01-2017.
 */


$(document).ready(function() {
    var partido;
    $('#calendar').fullCalendar({

        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'listDay,listWeek,month'

        },
        // customize the button names,
        // otherwise they'd all just say "list"
        views: {
            listDay: { buttonText: 'Día' },
            listWeek: { buttonText: 'Semana' }
        },
        locale: 'es',
        defaultView: 'listWeek',
        //defaultDate: '2016-12-12' // default today
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        events: '../Logica/obtener-partidos-calendario.php',

        eventClick: function(calEvent, jsEvent, view) {
            partido = calEvent.id;
            getPartido(partido);
            $('#detallePartido').modal('show');


            // alert('Event: ' + calEvent.title);
            // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
            // alert('View: ' + view.name);
            // calEvent.title = "CLICKED!";
            // change the border color just for fun
            //$(this).css('border-color', 'red');



            //$('#detallePartido').modal('show');


            // $('#calendar').fullCalendar('updateEvent', calEvent);

        }

    });


});
function getPartido(id){
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
            var nomTorneo = opts[0][15];


            // document.getElementById("dropdownTorneo").selectedIndex = codTorneo;
            // document.getElementById("dropdownCategoria").selectedIndex = categoria;
            // document.getElementById("fecha").value = fecha;

            // obtenerListaClubes(categoria);
            //
            // var options = document.getElementById('dropdownClub1').options;
            // for(var i = 0; i < options.length; i++) {
            //     if(options[i].value === codClub1) {
            //         options[i].selected = true;
            //         break;
            //     }
            // }
            // options = document.getElementById('dropdownClub2').options;
            // for(var i = 0; i < options.length; i++) {
            //     if(options[i].value === codClub2) {
            //         options[i].selected = true;
            //         break;
            //     }
            // }
            //
            var horaSpliteada = horaIni.split(":");
            var horaIni = horaSpliteada[0]+":"+horaSpliteada[1];

            var horaSpliteada = horaFin.split(":");
            var horaFin = horaSpliteada[0]+":"+horaSpliteada[1];

            $("#fecha").html("Fecha: "+fecha);
            $("#hora").html("De: "+horaIni +"<br> Hasta: "+horaFin);
            $("#cancha").html("Cancha: "+cancha);
            $("#golesEquipo1").html(goles1);
            $("#golesEquipo2").html(goles2);
            $("#torneo").html("Torneo: "+nomTorneo);

            desplegarImagenClub1(codClub1);
            desplegarImagenClub2(codClub2);
            $("#tituloPartido").html(nomClub1+" vs "+nomClub2);


        }

    });
}
function desplegarImagenClub1(rutClub){
    $("#fotoEquipo1").attr("src","image/escudos/"+getImagenClub(rutClub));
}
function desplegarImagenClub2(rutClub){
    $("#fotoEquipo2").attr("src","image/escudos/"+getImagenClub(rutClub));
}
function getImagenClub(rutClub){
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
            if(imagen == "" || imagen == null){
                imagen = "none.png";
            }
        });
    return imagen;
}

