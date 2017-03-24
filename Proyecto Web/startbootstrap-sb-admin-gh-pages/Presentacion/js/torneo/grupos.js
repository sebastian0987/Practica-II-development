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
// 7 grupo

var datosGrupo = [];
var codCategoriasGrupo = [];
var grupos = [];

$(document).ready(function () {
    obtenerListaCategoriasGrupos();
    // getDatosClubesGrupo();

    // for (var i = 0; i < codCategoriasGrupo.length; i++) {
    //     // getDatosClubesGrupo(codCategoriasGrupo[i]);
    //     getGruposPorCategoria(codCategoriasGrupo[i]);
    // }
});
function getGruposPorCategoria(posicionCategoria) {
    if (posicionCategoria == codCategoriasGrupo.length){
        return;
    }
    var categoria = codCategoriasGrupo[posicionCategoria];
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-torneo.php",
        data: {
            tipo: "obtenerGruposPorCategoria",
            categoria: categoria
        }
    }).done(function (data) {
            // alert(categoria)
            var opts = $.parseJSON(data);
            var a = 0;
            var letras = ['Grupo A', 'Grupo B', 'Grupo C', 'Grupo D', 'Grupo E', 'Grupo F', 'Grupo G', 'Grupo H'];
            // getDatosClubesGrupo(categoria);
            $.each(opts, function (i, d) {
                if (a == 0) {
                    $('#ulGrupos' + categoria).append('<li class="active"> <a data-toggle="tab" href="#menuGrupo' + d.codigoGrupo + '"  >' + letras[a] + '</a></li>');
                } else {
                    $('#ulGrupos' + categoria).append('<li> <a data-toggle="tab" href="#menuGrupo' + d.codigoGrupo + '" >' + letras[a] + '</a></li>');
                }
                // rellenarTablaGrupo(categoria, d.codigoGrupo);
                a++;
            });
            a = 0;
            $.each(opts, function (i, d) {
                if (a == 0) {
                    // alert(d.codigoCategoria)
                    $('#tabs' + categoria).append(
                        '<div id="menuGrupo' + d.codigoGrupo + '" class="tab-pane fade in active">' +
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
                        '<tbody id="tbodyGrupo' + d.codigoGrupo + '">' +
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
                    $('#tabs' + categoria).append(
                        '<div id="menuGrupo' + d.codigoGrupo + '" class="tab-pane fade">' +
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
                        '<tbody id="tbodyGrupo' + d.codigoGrupo + '">' +
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
                a++;
                $('#menuGrupo' + d.codigoGrupo).append('<button id="btCargando' + d.codigoGrupo + '" class="btn btn-primary btn-lg" disabled><i class="fa fa-spinner fa-spin"></i> Cargando Tabla de Posiciones</button>');
            });
        // $('#tabs' + categoria).append('<button id="btCargando' + categoria + '" class="btn btn-primary btn-lg" disabled><i class="fa fa-spinner fa-spin"></i> Cargando Tabla de Posiciones</button>');
            getDatosClubesPorGrupo(posicionCategoria,opts,0);
            // $.each(opts, function (i, d) {
            //     $('#ulGrupos' + categoria).append('<li class="active"> <a data-toggle="tab" href="#' + d.codigoGrupo + '" onclick="rellenarTablaGrupo(' + categoria + ',' + d.codigoGrupo + ');" >' + letras[a] + '</a></li>');
            //     rellenarTablaGrupo(categoria, d.codigoGrupo);
            //     a++;
            // });
        });
}

function getDatosClubesPorGrupo(posicionCategoria,grupos,posicionGrupo) {
    if (posicionGrupo == grupos.length){
        getGruposPorCategoria(posicionCategoria+1);
        return;
    }
    var grupo = grupos[posicionGrupo][0];
    var categoria = codCategoriasGrupo[posicionCategoria]
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        data: {
            tipo: "obtenerClubPorGrupo",
            Grupo: grupo
        }
    }).done(function (data) {
            var opts = $.parseJSON(data);
            for (var i = 0; i < opts.length; i++) {
                datosGrupo.push([categoria,
                    0,
                    "",
                    "",
                    "",
                    "",
                    ""
                ]);
            }
        getPartidosGanadosGrupos(0, opts,posicionCategoria,grupos,posicionGrupo);
    });
}
function getDatosClubesGrupo(categoria) {
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
                datosGrupo.push([categoria,
                    0,
                    d.nombreClubDeportivo,
                    getPartidosGanadosGrupos(d.rutClubDeportivo, categoria),
                    getPartidosEmpatadosGrupos(d.rutClubDeportivo, categoria),
                    getPartidosPerdidosGrupos(d.rutClubDeportivo, categoria),
                    (parseInt(getPartidosGanadosGrupos(d.rutClubDeportivo, categoria)) * 3 +
                    parseInt(getPartidosEmpatadosGrupos(d.rutClubDeportivo, categoria))),
                    d.codigoGrupo
                ]);
                // alert($.inArray(d.codigoGrupo,grupos));
                if ($.inArray(d.codigoGrupo, grupos) == -1) {
                    grupos.push(d.codigoGrupo);
                }
                datosGrupo.sort(function (a, b) {
                    if (a[6] < b[6]) return 1;
                    if (a[6] > b[6]) return -1;
                    return 0;
                });
                //
                // posiciones.push([i+1,categoria]);
                // rutClubes.push([d.rutClubDeportivo,categoria]);
                // nomClubes.push([d.nombreClubDeportivo,categoria]);
                // PG.push(getPartidosGanadosGrupos(d.rutClubDeportivo,categoria));
                // PE.push(getPartidosEmpatadosGrupos(d.rutClubDeportivo,categoria));
                // PP.push(getPartidosPerdidosGrupos(d.rutClubDeportivo,categoria));
            })

        });
    // printArray(datosGrupo);
}

function rellenarTablaGrupo(codigoGrupo) {
    // alert(codigoGrupo)
    // por cada grupo de la categoria...
    // $('#tbody' + categoria).empty();
    var k = 1;
    for (var i = 0; i < datosGrupo.length; i++) {
        // if (datosGrupo[i][7] == grupo && datosGrupo[i][0] == categoria) {
            datosGrupo[i][1] = k;
            k++;
            $('#tbodyGrupo' + codigoGrupo).append(
                "<tr>" +
                "<td>" + datosGrupo[i][1] + "</td>" +
                "<td>" + datosGrupo[i][2] + "</td>" +
                "<td>" + datosGrupo[i][3][0][0] + "</td>" +
                "<td>" + datosGrupo[i][4][0][0] + "</td>" +
                "<td>" + datosGrupo[i][5][0][0] + "</td>" +
                "<td>" + datosGrupo[i][6] + "</td>" +
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


function obtenerListaCategoriasGrupos() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-torneo.php",
        data: {
            tipo: "obtenerCategoriasQueSiEstenJugandoUnTorneoPorTipo",
            tipoTorneo: "grupos"
        }
    }).done(function (data) {
        var opts = $.parseJSON(data);
        $.each(opts, function (i, d) {
            codCategoriasGrupo.push(d.codigoCategoria);
            $('#divCategorias').append(
                '<div class="panel panel-green" style="background: none">' +
                '<div class="panel-heading">' +
                '<h3 class="panel-title">' + d.nombreCategoria + '</h3>' +
                '</div>' +
                '<div class="panel-body">' +
                '<ul class="nav nav-tabs" id="ulGrupos' + d.codigoCategoria + '"  >' +
                '</ul> ' +
                '<div id="tabs' + d.codigoCategoria + '" class="tab-content"  >' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>');
        });
        getGruposPorCategoria(0);
        // $.each(opts, function (i, d) {
        //     codCategoriasGrupo.push(d.codigoCategoria);
        //         $('#divCategorias').append(
        //             '<div class="panel panel-green">' +
        //                 '<div class="panel-heading">' +
        //                     '<h3 class="panel-title">'+ d.nombreCategoria +'</h3>' +
        //                 '</div>' +
        //                 '<div class="panel-body">' +
        //                     '<ul class="nav nav-tabs" id="ulGrupos'+ d.codigoCategoria +'"  >' +
        //                     '</ul> '+
        //                     '<div id="tabs'+ d.codigoCategoria +'" class="tab-content"  >' +
        //                     '</div>' +
        //                     '<div class="tab-pane fade in active">' +
        //                         '<div class="table-responsive">' +
        //                             '<table class="table table-bordered table-hover">' +
        //                             '<thread>' +
        //                                 '<tr>' +
        //                                 '<th>Posición</th>' +
        //                                 '<th>Club</th>'     +
        //                                 '<th>PG</th>'       +
        //                                 '<th>PE</th>'       +
        //                                 '<th>PP</th>'       +
        //                                 '<th>Pts</th>'      +
        //                                 '</tr>' +
        //                             '</thread>' +
        //                                 '<tbody id="tbody'+ d.codigoCategoria +'"> ' +
        //                                 '</tbody>' +
        //                            '</table>' +
        //                         '</div>' +
        //                     '</div>' +
        //                 '</div>' +
        //             '</div>'
        //         );
        //         // $('#liga').append(
        //         //     '<div id="home'+ d.codigoCategoria +'" class="tab-pane fade in active">' +
        //         //         '<div class="table-responsive">' +
        //         //             '<table class="table table-bordered table-hover">' +
        //         //                 '<thread>' +
        //         //                     '<tr>' +
        //         //                     '<th>Posición</th>' +
        //         //                     '<th>Club</th>'     +
        //         //                     '<th>PG</th>'       +
        //         //                     '<th>PE</th>'       +
        //         //                     '<th>PP</th>'       +
        //         //                     '<th>Pts</th>'      +
        //         //                     '</tr>' +
        //         //                 '</thread>' +
        //         //                 // '<tbody id="tbody'+ d.codigoCategoria +'">' +
        //         //                 // '<tr>' +
        //         //                 // '<td> ' + posiciones[0] +' </td>' +
        //         //                 // '<td> ' + nomClubes[0] +' </td>' +
        //         //                 // '<td> ' + PG[0] +' </td>' +
        //         //                 // '<td> ' + PE[0] +' </td>' +
        //         //                 // '<td> ' + PP[0] +' </td>' +
        //         //                 // '<td> ' + puntos[0] +' </td>' +
        //         //                 // '</tr>' +
        //         //                 '</tbody>' +
        //         //             '</table>' +
        //         //         '</div>' +
        //         //     '</div>');
        // });

    });
}
function getPartidosGanadosGrupos(fila, clubes,posicionCategoria,codigoGrupos,posicionGrupo) {
    var categoria = codCategoriasGrupo[posicionCategoria]
    // alert(fila)
    if (fila == clubes.length) {
        document.getElementById("btCargando"+codigoGrupos[posicionGrupo][0]).style.display = 'none';
        rellenarTablaGrupo(codigoGrupos[posicionGrupo][0])
        datosGrupo.length = 0;
        getDatosClubesPorGrupo(posicionCategoria,codigoGrupos,posicionGrupo+1)
        // getDatosLiga(posicionCategoria+1)
        return
    }
    var club = clubes[fila][0];
    datosGrupo[fila][0] = categoria;
    datosGrupo[fila][1] = 0;
    datosGrupo[fila][2] = clubes[fila][1];
    // var partidosGanados = [];
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        data: {
            tipo: "obtenerPartidosGanadosPorClub",
            categoria: categoria,
            rutClub: club,
            tipoTorneo: 'grupos'
        }
    }).done(function (data) {
            var opts = $.parseJSON(data);
            $.each(opts, function (i, d) {
                // var temp = [opts[0][0], categoria];
                datosGrupo[fila][3] = opts[0][0];
                datosGrupo[fila][6] = parseInt(opts[0][0]) * 3;
                getPartidosEmpatadosGrupos(fila, clubes,posicionCategoria,codigoGrupos,posicionGrupo)
                // partidosGanados.push(temp);
            });
        });
    // return partidosGanados;
}
function getPartidosEmpatadosGrupos(fila, clubes,posicionCategoria,codigoGrupos,posicionGrupo) {
    var categoria = codCategoriasGrupo[posicionCategoria]
    var club = clubes[fila][0];
    // var partidosEmpatados = [];
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        data: {
            tipo: "obtenerPartidosEmpatadosPorClub",
            categoria: categoria,
            rutClub: club,
            tipoTorneo: 'grupos'
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            datosGrupo[fila][4] = opts[0][0];
            datosGrupo[fila][6] = parseInt(datosGrupo[fila][6]) + parseInt(opts[0][0]);
            getPartidosPerdidosGrupos(fila, clubes,posicionCategoria,codigoGrupos,posicionGrupo);
            // $.each(opts, function (i, d) {
            //     var temp = [d.partidosEmpatados, categoria];
            //     partidosEmpatados.push(temp);
            // });
        });
    // return partidosEmpatados;
}

function getPartidosPerdidosGrupos(fila, clubes,posicionCategoria,codigoGrupos,posicionGrupo) {

    var categoria = codCategoriasGrupo[posicionCategoria]
    var club = clubes[fila][0];
    // var partidosPerdidos = [];
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        data: {
            tipo: "obtenerPartidosPerdidosPorClub",
            categoria: categoria,
            rutClub: club,
            tipoTorneo: 'grupos'
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            datosGrupo[fila][5] = opts[0][0];
            getPartidosGanadosGrupos(fila+1, clubes,posicionCategoria,codigoGrupos,posicionGrupo);
            // $.each(opts, function (i, d) {
            //     var temp = [d.partidosPerdidos, categoria];
            //     partidosPerdidos.push(temp);
            // });
        });
    // return partidosPerdidos;
}