/**
 * Created by Andrés on 05-03-2017.
 */
// datosGrupo:
// 0 categoria
// 1 posicion
// 2 nombreclub
// 3 pg
// 4 pe
// 5 pp
// 6 pts
var datos = [];
var codCategorias = [];
var finGetDatos = false;

$(document).ready(function () {
    obtenerListaCategorias();
    // getDatosLiga();
    // rellenarTablaGrupo(codCategoriasGrupo[0]);
});

function getDatosLiga(posicionCategoria) {
    // for (var i = 0; i < 1; i++) {
    // alert(posicionCategoria);
    if (posicionCategoria == codCategorias.length){
        // alert("fin")
        return;
    }
    var categoria = codCategorias[posicionCategoria];
    // alert(categoria)
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
            for (var i = 0; i < opts.length; i++) {
                datos.push([categoria,
                    0,
                    "",
                    "",
                    "",
                    "",
                    ""
                ]);
            }
            getPartidosGanados(0, opts, categoria,posicionCategoria);
            // $.each(opts, function (i, d) {
            //     datosGrupo.push([categoria,
            //         0,
            //         "",
            //         "",
            //         "",
            //         "",
            //         ""
            //     ]);
            //     datosGrupo[i][1]=0;
            //     datosGrupo[i][2]=d.nombreClubDeportivo;
            //     getPartidosGanadosGrupos(0,d.rutClubDeportivo, categoria);
            //     // datosGrupo.push([categoria,
            //     //     0,
            //     //     d.nombreClubDeportivo,
            //     //     getPartidosGanadosGrupos(d.rutClubDeportivo, categoria),
            //     //     getPartidosEmpatadosGrupos(d.rutClubDeportivo, categoria),
            //     //     getPartidosPerdidosGrupos(d.rutClubDeportivo, categoria),
            //     //     (parseInt(getPartidosGanadosGrupos(d.rutClubDeportivo, categoria)) * 3 +
            //     //     parseInt(getPartidosEmpatadosGrupos(d.rutClubDeportivo, categoria)))
            //     // ]);
            //     // datosGrupo.sort(function (a, b) {
            //     //     if (a[6] < b[6]) return 1;
            //     //     if (a[6] > b[6]) return -1;
            //     //     return 0;
            //     // });
            //     //
            //     // posiciones.push([i+1,categoria]);
            //     // rutClubes.push([d.rutClubDeportivo,categoria]);
            //     // nomClubes.push([d.nombreClubDeportivo,categoria]);
            //     // PG.push(getPartidosGanadosGrupos(d.rutClubDeportivo,categoria));
            //     // PE.push(getPartidosEmpatadosGrupos(d.rutClubDeportivo,categoria));
            //     // PP.push(getPartidosPerdidosGrupos(d.rutClubDeportivo,categoria));
            // });
            // finGetDatos = true;
            // posicion++;
            // alert(categoria);
            // rellenarTablaGrupo(codCategoriasGrupo[categoria]);
        });
    // }
    // rellenarTablaGrupo(codCategoriasGrupo[0]);
    // printArray(datosGrupo);
}

function rellenarTabla(categoria) {
    // $('#tbody1').empty();
    $('#tbody' + categoria).empty();
    var k = 1;
    for (var i = 0; i < datos.length; i++) {
        if (datos[i][0] != categoria)
            continue;
        datos[i][1] = k;
        k++;
        // if (categoria=='3'){
        //     alert(datosGrupo[i][2]);
        $('#tbody' + categoria).append(
            "<tr>" +
            "<td>" + datos[i][1] + "</td>" +
            "<td>" + datos[i][2] + "</td>" +
            "<td>" + datos[i][3][0][0] + "</td>" +
            "<td>" + datos[i][4][0][0] + "</td>" +
            "<td>" + datos[i][5][0][0] + "</td>" +
            "<td>" + datos[i][6] + "</td>" +
            "</tr>"
        );
        // }
    }
}

function getIndex(array, target) {
    for (var i = 0; i < array.length; i++) {
        if (array[i].toString() === target.toString()) {
            return i;
        }
    }
    return -1;
}

function printArray(array) {
    for (var i = 0; i < array.length; i++) {
        alert(array[i]);
        // alert("rutClub: "+array[i] + " PG: " + PG[i] + " PE: " + PE[i] + " PP: " + PP[i]);
    }
}


function obtenerListaCategorias() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-torneo.php",
        data: {
            tipo: "obtenerCategoriasQueSiEstenJugandoUnTorneoPorTipo",
            tipoTorneo: "liga"
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            if(opts == ""){
                document.getElementById("ulCategorias").style.display = 'none'
                return;
            }
            var j = 0;
            $.each(opts, function (i, d) {
                codCategorias.push(d.codigoCategoria);
                if (j == 0) {
                    $('#ulCategorias').append('<li class="active"> <a data-toggle="tab" href="#menu' + d.codigoCategoria + '"  >' + d.nombreCategoria + '</a></li>');
                } else {
                    $('#ulCategorias').append('<li> <a data-toggle="tab" href="#menu' + d.codigoCategoria + '"  >' + d.nombreCategoria + '</a></li>');
                }
                j++;
            });
            j = 0;
            $.each(opts, function (i, d) {
                if (j == 0) {
                    // alert(d.codigoCategoria)
                    $('#liga').append(
                        '<div id="menu' + d.codigoCategoria + '" class="tab-pane fade in active">' +
                        '<div class="table-responsive">' +
                        '<table class="table table-bordered table-hover table-striped">' +
                        '<thread>' +
                        '<tr>' +
                        '<th>Posición</th>' +
                        '<th>Club</th>' +
                        '<th>PG</th>' +
                        '<th>PE</th>' +
                        '<th>PP</th>' +
                        '<th>Pts</th>' +
                        '</tr>' +
                        '</thread>' +
                        '<tbody id="tbody' + d.codigoCategoria + '">' +
                        // '<tr>' +
                        // '<td> ' + posiciones[0] +' </td>' +
                        // '<td> ' + nomClubes[0] +' </td>' +
                        // '<td> ' + PG[0] +' </td>' +
                        // '<td> ' + PE[0] +' </td>' +
                        // '<td> ' + PP[0] +' </td>' +
                        // '<td> ' + puntos[0] +' </td>' +
                        // '</tr>' +
                        '</tbody>' +
                        '</table>' +
                        '</div>' +
                        '</div>');
                } else {
                    // alert(d.codigoCategoria)
                    $('#liga').append(
                        '<div id="menu' + d.codigoCategoria + '" class="tab-pane fade">' +
                        '<div class="table-responsive">' +
                        '<table class="table table-bordered table-hover table-striped">' +
                        '<thread>' +
                        '<tr>' +
                        '<th>Posición</th>' +
                        '<th>Club</th>' +
                        '<th>PG</th>' +
                        '<th>PE</th>' +
                        '<th>PP</th>' +
                        '<th>Pts</th>' +
                        '</tr>' +
                        '</thread>' +
                        '<tbody id="tbody' + d.codigoCategoria + '">' +
                        // '<tr>' +
                        // '<td> ' + posiciones[0] +' </td>' +
                        // '<td> ' + nomClubes[0] +' </td>' +
                        // '<td> ' + PG[0] +' </td>' +
                        // '<td> ' + PE[0] +' </td>' +
                        // '<td> ' + PP[0] +' </td>' +
                        // '<td> ' + puntos[0] +' </td>' +
                        // '</tr>' +
                        '</tbody>' +
                        '</table>' +
                        '</div>' +
                        '</div>');
                }
                j++;
                $('#menu'+d.codigoCategoria).append('<button id="btCargando' + d.codigoCategoria + '" class="btn btn-primary btn-lg" disabled><i class="fa fa-spinner fa-spin"></i> Cargando Tabla de Posiciones</button>');
            });
            // alert("s")

            // $.each(opts, function (i, d) {
            //     codCategoriasGrupo.push(d.codigoCategoria);
            //     // alert(j);
            //     if(j==0){
            //         // href="#home"
            //         $('#ulCategorias').append('<li class="active"> <a data-toggle="tab" href="home'+ d.codigoCategoria +'" onclick="rellenarTablaGrupo('+ d.codigoCategoria +');" >' + d.nombreCategoria + '</a></li>');
            //         $('#liga').append(
            //             '<div id="home'+ d.codigoCategoria +'" class="tab-pane fade in active">' +
            //                 '<div class="table-responsive">' +
            //                     '<table class="table table-bordered table-hover">' +
            //                         '<thread>' +
            //                             '<tr>' +
            //                                  '<th>Posición</th>' +
            //                                  '<th>Club</th>' +
            //                                  '<th>PG</th>' +
            //                                  '<th>PE</th>' +
            //                                  '<th>PP</th>' +
            //                                  '<th>Pts</th>' +
            //                               '</tr>' +
            //                         '</thread>' +
            //                             '<tbody id="tbody'+ d.codigoCategoria +'">' +
            //                                 // '<tr>' +
            //                                     // '<td> ' + posiciones[0] +' </td>' +
            //                                     // '<td> ' + nomClubes[0] +' </td>' +
            //                                     // '<td> ' + PG[0] +' </td>' +
            //                                     // '<td> ' + PE[0] +' </td>' +
            //                                     // '<td> ' + PP[0] +' </td>' +
            //                                     // '<td> ' + puntos[0] +' </td>' +
            //                                 // '</tr>' +
            //                             '</tbody>' +
            //                     '</table>' +
            //                 '</div>' +
            //             '</div>');
            //     }else{
            //         alert("s")
            //         $('#ulCategorias').append('<li> <a data-toggle="tab" href="home'+ d.codigoCategoria +'" onclick="rellenarTablaGrupo('+ d.codigoCategoria +');" >' + d.nombreCategoria + '</a></li>');
            //         $('#liga').append(
            //             '<div id="home'+ d.codigoCategoria +'" class="tab-pane fade">' +
            //                 '<div class="table-responsive">' +
            //                     '<table class="table table-bordered table-hover">' +
            //                         '<thread>' +
            //                             '<tr>' +
            //                             '<th>Posición</th>' +
            //                             '<th>Club</th>' +
            //                             '<th>PG</th>' +
            //                             '<th>PE</th>' +
            //                             '<th>PP</th>' +
            //                             '<th>Pts</th>' +
            //                             '</tr>' +
            //                         '</thread>' +
            //                         '<tbody id="tbody'+ d.codigoCategoria +'">' +
            //                         // '<tr>' +
            //                         // '<td> ' + posiciones[0] +' </td>' +
            //                         // '<td> ' + nomClubes[0] +' </td>' +
            //                         // '<td> ' + PG[0] +' </td>' +
            //                         // '<td> ' + PE[0] +' </td>' +
            //                         // '<td> ' + PP[0] +' </td>' +
            //                         // '<td> ' + puntos[0] +' </td>' +
            //                         // '</tr>' +
            //                         '</tbody>' +
            //                     '</table>' +
            //                 '</div>' +
            //             '</div>');
            //     }
            //     j++;
            //
            // });
            getDatosLiga(0);
        });
}
function getPartidosGanados(fila, clubes, categoria,posicionCategoria) {
    // alert(clubes.length)
    // alert(fila)
    if (fila == clubes.length) {
        document.getElementById("btCargando"+categoria).style.display = 'none';
        rellenarTabla(categoria)
        datos.length = 0;
        getDatosLiga(posicionCategoria+1)
        return
    }
    var club = clubes[fila][0];
    datos[fila][0] = categoria;
    datos[fila][1] = 0;
    datos[fila][2] = clubes[fila][1];
    var partidosGanados = [];
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        data: {
            tipo: "obtenerPartidosGanadosPorClub",
            categoria: categoria,
            rutClub: club,
            tipoTorneo: 'liga'
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            $.each(opts, function (i, d) {
                var temp = [opts[0][0], categoria];
                datos[fila][3] = opts[0][0];
                datos[fila][6] = parseInt(opts[0][0]) * 3;
                getPartidosEmpatados(fila, clubes, categoria,posicionCategoria)
                // partidosGanados.push(temp);
            });
        });
    // return partidosGanados;
}
function getPartidosEmpatados(fila, clubes, categoria,posicionCategoria) {
    var club = clubes[fila][0];
    var partidosEmpatados = [];
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        data: {
            tipo: "obtenerPartidosEmpatadosPorClub",
            categoria: categoria,
            rutClub: club,
            tipoTorneo: 'liga'
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            $.each(opts, function (i, d) {
                var temp = [d.partidosEmpatados, categoria];
                datos[fila][4] = opts[0][0];
                datos[fila][6] = parseInt(datos[fila][6]) + parseInt(opts[0][0]);
                getPartidosPerdidos(fila, clubes, categoria,posicionCategoria);
                // partidosEmpatados.push(temp);
            });
        });
    // return partidosEmpatados;
}

function getPartidosPerdidos(fila, clubes, categoria,posicionCategoria) {
    var club = clubes[fila][0];
    var partidosPerdidos = [];
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        data: {
            tipo: "obtenerPartidosPerdidosPorClub",
            categoria: categoria,
            rutClub: club,
            tipoTorneo: 'liga'
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            $.each(opts, function (i, d) {
                var temp = [d.partidosPerdidos, categoria];
                datos[fila][5] = opts[0][0];
                // partidosPerdidos.push(temp);
            });
            getPartidosGanados(fila + 1, clubes, categoria,posicionCategoria);
        });

    // return partidosPerdidos;
}