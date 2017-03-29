// var torneo;

var nomCampeon = "";
var idCampeon = "";
var codigosPartidos = new Array();

var codigoEquipo1 = new Array();
var nombreEquipo1 = new Array();
var golesEquipo1 = new Array();

var codigoEquipo2 = new Array();
var nombreEquipo2 = new Array();
var golesEquipo2 = new Array();

function actualizarBracket(value){
    // alert(value);

    codigosPartidos = [];

    codigoEquipo1 = [];
    nombreEquipo1 = [];
    golesEquipo1 = [];

    codigoEquipo2 = [];
    nombreEquipo2 = [];
    golesEquipo2 = [];
    $("#bracket").empty();
    $(".my_gracket").gracket({
        // src : win.TestData2
        src : eliminacion(value)
    });
}
function countArray(obj) {
    var count = 0;
    // iterate over properties, increment if a non-prototype property
    for(var key in obj) if(obj.hasOwnProperty(key)) count++;
    return count;
}
function obtenerListaTorneos() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-torneo.php",
        async: false,
        data: {
            tipo: "obtenerTorneos",
            tipoTorneo: "eliminacion"
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            $.each(opts, function (i, d) {
                // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                $('#dropdownTorneo').append('<option value="' + d.codigoTorneo + '">' + d.nombreTorneo+ '</option>');
            });
        });
}
$(document).ready(function () {
    obtenerListaTorneos();
    actualizarBracket(document.getElementById("dropdownTorneo").value.toString());
    // torneo = document.getElementById("dropdownTorneo").value;
    // $('.g_team').click(function(){
    //     var id = $(this).attr('seed');
    //     // alert(id);
    // });
    // $(".my_gracket").gracket({
    //     canvasLineWidth : 1,      // adjusts the thickness of a line
    //     canvasLineGap : 2,        // adjusts the gap between element and line
    //     cornerRadius : 3,         // adjusts edges of line
    //     canvasLineCap : "round",  // or "square"
    //     canvasLineColor : "white" // or #HEX
    // });

});
function eliminacion16(value) {

    // for (i = 1; i<=16; i++){
    //
    // }

    // Como stackear arrays y jsonificarlos
    // var arr = new Array();
    // var record1 = {'a':'1','b':'2','c':'3'};
    // var record2 = {'d':'4','e':'5','f':'6'};
    // arr.push(record1);
    // arr.push(record2);
    // var jsonString = JSON.stringify(arr);


    // alert(countArray(actualizarBracket));
    $.ajax({
        type: "POST",
        url: "../Logica/obtener-partidos-eliminacion.php",
        async: false,
        data: {
            torneo: '1',
            categoria: '1'
        }
    }).done(function (data) {
        if (data == "vacio") {

            return;
        } else {
            var opts = $.parseJSON(data);
            for(var i = 0; i < countArray(opts); i++){

                nombreEquipo1.push(opts[i][0]);
                nombreEquipo2.push(opts[i][1]);
                codigoEquipo1.push(opts[i][2]);
                codigoEquipo2.push(opts[i][3]);
                golesEquipo1.push(opts[i][4]);
                golesEquipo2.push(opts[i][5]);
            }
        }

    });

    partidos =        [
        [
            [ {"name" : nombreEquipo1[0], "id" :codigoEquipo1[0],"seed" :   golesEquipo1[0]}, {"name" :  nombreEquipo2[0], "id" :  codigoEquipo2[0], "seed" :   golesEquipo2[0]}],
            [ {"name" : nombreEquipo1[1], "id" :codigoEquipo1[1],"seed" :   golesEquipo1[1]}, {"name" :  nombreEquipo2[1], "id" :  codigoEquipo2[1], "seed" :   golesEquipo2[1]}],
            [ {"name" : nombreEquipo1[2], "id" :codigoEquipo1[2],"seed" :   golesEquipo1[2]}, {"name" :  nombreEquipo2[2], "id" :  codigoEquipo2[2], "seed" :   golesEquipo2[2]}],
            [ {"name" : nombreEquipo1[3], "id" :codigoEquipo1[3],"seed" :   golesEquipo1[3]}, {"name" :  nombreEquipo2[3], "id" :  codigoEquipo2[3], "seed" :   golesEquipo2[3]}],
            [ {"name" : nombreEquipo1[4], "id" :codigoEquipo1[4],"seed" :   golesEquipo1[4]}, {"name" :  nombreEquipo2[4], "id" :  codigoEquipo2[4], "seed" :   golesEquipo2[4]}],
            [ {"name" : nombreEquipo1[5], "id" :codigoEquipo1[5],"seed" :   golesEquipo1[5]}, {"name" :  nombreEquipo2[5], "id" :  codigoEquipo2[5], "seed" :   golesEquipo2[5]}],
            [ {"name" : nombreEquipo1[6], "id" :codigoEquipo1[6],"seed" :   golesEquipo1[6]}, {"name" :  nombreEquipo2[6], "id" :  codigoEquipo2[6], "seed" :   golesEquipo2[6]}],
            [ {"name" : nombreEquipo1[7], "id" :codigoEquipo1[7],"seed" :   golesEquipo1[7]}, {"name" :  nombreEquipo2[7], "id" :  codigoEquipo2[7], "seed" :   golesEquipo2[7]}]
        ],
        [
            [ {"name" : nombreEquipo1[8], "id" : codigoEquipo1[8],"seed" :  golesEquipo1[8]}, {"name" :  nombreEquipo2[8], "id" :  codigoEquipo2[8], "seed" :   golesEquipo2[8]}],
            [ {"name" : nombreEquipo1[9], "id" : codigoEquipo1[9],"seed" :  golesEquipo1[9]}, {"name" :  nombreEquipo2[9], "id" :  codigoEquipo2[9], "seed" :   golesEquipo2[9]}],
            [ {"name" : nombreEquipo1[10], "id" :codigoEquipo1[10],"seed" : golesEquipo1[10]}, {"name" : nombreEquipo2[10], "id" : codigoEquipo2[10], "seed" :  golesEquipo2[10]}],
            [ {"name" : nombreEquipo1[11], "id" :codigoEquipo1[11],"seed" : golesEquipo1[11]}, {"name" : nombreEquipo2[11], "id" : codigoEquipo2[11], "seed" :  golesEquipo2[11]}]
        ],
        [
            [ {"name" : nombreEquipo1[12], "id" :codigoEquipo1[12],"seed" : golesEquipo1[12]}, {"name" : nombreEquipo2[12], "id" : codigoEquipo2[12], "seed" :  golesEquipo2[12]}],
            [ {"name" : nombreEquipo1[13], "id" :codigoEquipo1[13],"seed" : golesEquipo1[13]}, {"name" : nombreEquipo2[13], "id" : codigoEquipo2[13], "seed" :  golesEquipo2[13]}]
        ],
        [
            [ {"name" : nombreEquipo1[14], "id" :codigoEquipo1[14],"seed" : golesEquipo1[14]}, {"name" : nombreEquipo2[14], "id" : codigoEquipo2[14], "seed" :  golesEquipo2[14]} ]
        ],
        [
            [ {"name" : "Campeon", "id" :        "campeon","seed" : 1} ]
        ]
    ];
    return partidos;
}
function eliminacion(value) {



    $.ajax({
        type: "POST",
        url: "../Logica/obtener-partidos-eliminacion.php",
        async: false,
        data: {
            // torneo: 55
            torneo: document.getElementById("dropdownTorneo").value.toString()
        }
    }).done(function (data) {
        if (data == "vacio") {

            return;
        } else {
            var opts = $.parseJSON(data);
            // i < countArray(opts)
            for(var i = 0; i < countArray(opts); i++){
                if(opts[i][0]!=null){
                    nombreEquipo1.push(opts[i][0]);
                }else{
                    nombreEquipo1.push("Por determinar");
                }
                if(opts[i][1]!=null){
                    nombreEquipo2.push(opts[i][1]);
                }else{
                    nombreEquipo2.push("Por determinar");
                }
                if(opts[i][2]!=null){
                    codigoEquipo1.push(opts[i][2]);
                }else{
                    codigoEquipo1.push("pd");
                }
                if(opts[i][3]!=null){
                    codigoEquipo2.push(opts[i][3]);
                }else{
                    codigoEquipo2.push("pd");
                }
                if(opts[i][4]!=null){
                    golesEquipo1.push(opts[i][4]);
                }else{
                    golesEquipo1.push("0");
                }
                if(opts[i][5]!=null){
                    golesEquipo2.push(opts[i][5]);
                }else{
                    golesEquipo2.push("0");
                }
                codigosPartidos.push(opts[i][6]);
            }
            // *******************8**********************
            // OCTAVOS

            if(golesEquipo1.length>=4){
                if(golesEquipo1[0]>golesEquipo2[0]){
                    nombreEquipo1[4] = nombreEquipo1[0];
                    codigoEquipo1[4] = codigoEquipo1[0];
                }
                if(golesEquipo1[0]<golesEquipo2[0]){
                    nombreEquipo1[4] = nombreEquipo2[0];
                    codigoEquipo1[4] = codigoEquipo2[0];
                }
                if(golesEquipo1[1]>golesEquipo2[1]){
                    nombreEquipo2[4] = nombreEquipo1[1];
                    codigoEquipo2[4] = codigoEquipo1[1];
                }
                if(golesEquipo1[1]<golesEquipo2[1]){
                    nombreEquipo2[4] = nombreEquipo2[1];
                    codigoEquipo2[4] = codigoEquipo2[1];
                }

                if(golesEquipo1[2]>golesEquipo2[2]){
                    nombreEquipo1[5] = nombreEquipo1[2];
                    codigoEquipo1[5] = codigoEquipo1[2];
                }
                if(golesEquipo1[2]<golesEquipo2[2]){
                    nombreEquipo1[5] = nombreEquipo2[2];
                    codigoEquipo1[5] = codigoEquipo2[2];
                }
                if(golesEquipo1[3]>golesEquipo2[3]){
                    nombreEquipo2[5] = nombreEquipo1[3];
                    codigoEquipo2[5] = codigoEquipo1[3];
                }
                if(golesEquipo1[3]<golesEquipo2[3]){
                    nombreEquipo2[5] = nombreEquipo2[3];
                    codigoEquipo2[5] = codigoEquipo2[3];
                }
            }

            // SEMI-FINAL
            if(golesEquipo1.length>=5){
                if(golesEquipo1[4]>golesEquipo2[4]){
                    nombreEquipo1[6] = nombreEquipo1[4];
                    codigoEquipo1[6] = codigoEquipo1[4];
                }
                if(golesEquipo1[4]<golesEquipo2[4]){
                    nombreEquipo1[6] = nombreEquipo2[4];
                    codigoEquipo1[6] = codigoEquipo2[4];
                }
                if(golesEquipo1[5]>golesEquipo2[5]){
                    nombreEquipo2[6] = nombreEquipo1[5];
                    codigoEquipo2[6] = codigoEquipo1[5];
                }
                if(golesEquipo1[5]<golesEquipo2[5]){
                    nombreEquipo2[6] = nombreEquipo2[5];
                    codigoEquipo2[6] = codigoEquipo2[5];
                }
            }
            // FINAL
            if(golesEquipo1.length>=7){
                if(golesEquipo1[6]>golesEquipo2[6]){
                    nomCampeon = nombreEquipo1[6];
                    idCampeon = codigoEquipo1[6];
                }
                if(golesEquipo1[6]<golesEquipo2[6]){
                    nomCampeon = nombreEquipo2[6];
                    idCampeon = codigoEquipo2[6];
                }
            }
        }

    });

    partidos =        [
        [
            [ {"name" : nombreEquipo1[0], "id" :codigoEquipo1[0],"seed" :   golesEquipo1[0]}, {"name" :  nombreEquipo2[0], "id" :  codigoEquipo2[0], "seed" :   golesEquipo2[0]}],
            [ {"name" : nombreEquipo1[1], "id" :codigoEquipo1[1],"seed" :   golesEquipo1[1]}, {"name" :  nombreEquipo2[1], "id" :  codigoEquipo2[1], "seed" :   golesEquipo2[1]}],
            [ {"name" : nombreEquipo1[2], "id" :codigoEquipo1[2],"seed" :   golesEquipo1[2]}, {"name" :  nombreEquipo2[2], "id" :  codigoEquipo2[2], "seed" :   golesEquipo2[2]}],
            [ {"name" : nombreEquipo1[3], "id" :codigoEquipo1[3],"seed" :   golesEquipo1[3]}, {"name" :  nombreEquipo2[3], "id" :  codigoEquipo2[3], "seed" :   golesEquipo2[3]}]
        ],
        [
            [ {"name" : nombreEquipo1[4], "id" :codigoEquipo1[4],"seed" : golesEquipo1[4]}, {"name" : nombreEquipo2[4], "id" : codigoEquipo2[4], "seed" :  golesEquipo2[4]}],
            [ {"name" : nombreEquipo1[5], "id" :codigoEquipo1[5],"seed" : golesEquipo1[5]}, {"name" : nombreEquipo2[5], "id" : codigoEquipo2[5], "seed" :  golesEquipo2[5]}]
        ],
        [
            [ {"name" : nombreEquipo1[6], "id" :codigoEquipo1[6],"seed" : golesEquipo1[6]}, {"name" : nombreEquipo2[6], "id" : codigoEquipo2[6], "seed" :  golesEquipo2[6]}]
        ],
        [
            [ {"name" : nomCampeon,   "id" :idCampeon} ]
        ]
    ];
    return partidos;
}
// (function(win, doc, $){
//
//     var equipos;
//     // console.warn("Make sure the min-width of the .gracket_h3 element is set to width of the largest name/player. Gracket needs to build its canvas based on the width of the largest element. We do this my giving it a min width. I'd like to change that!");
//     // Fake Data
//     win.TestData = eliminacion16(equipos);
//     win.TestData2 = eliminacion(equipos);
//
//
//     // initializer
//     // $(".my_gracket").gracket({
//     //     // src : win.TestData2
//     //     src : eliminacion(55)
//     // });
//
//
// })(window, document, jQuery);
