/**
 * Created by Andrés on 26-02-2017.
 */
$(document).ready(function() {

    $.ajax({
        type: "POST",
        url: "../Logica/generar-partidos.php",
        async: false,
        data: {
            categoria: "3"
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
});