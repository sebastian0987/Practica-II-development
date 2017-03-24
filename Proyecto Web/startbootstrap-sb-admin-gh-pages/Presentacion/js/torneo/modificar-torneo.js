/**
 * Created by Andrés on 10-03-2017.
 */

var torneos = [];
var finalizado = 'n';
var noExistenTorneos = false;
$(document).ready(function () {
    obtenerListaTorneos();
    $('#bModificar').click(function () {
        finalizado = 'n';
        if(noExistenTorneos){
            return;
        }
        $('#mensajeConfirmacion').html("¿Está seguro que desea modificar esta información?");
        $('#confirmarModificar').modal('show');
    });
    $('#bFinalizar').click(function () {
        finalizado = 's';
        if(noExistenTorneos){
            return;
        }
        $('#mensajeConfirmacion').html("Dar por finalizado este torneo le permitirá comenzar un nuevo torneo de este tipo. ¿Está seguro que desea hacerlo?");
        $('#confirmarModificar').modal('show');
    });
    $('#confirmar').click(function () {
         updateTorneo(document.getElementById("dropdownTorneo").value,document.getElementById("nombreTorneo").value,finalizado);
    });
});

function updateTorneo(torneo, nombre, finalizadoS_N){
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-torneo.php",
        async: false,
        data: {
            tipo: "modificar",
            codigoTorneo: torneo,
            nombreTorneo:  nombre,
            finalizadoS_N: finalizadoS_N

        }
    })
        .done(function (data) {
            if(data=="modificado"){
                document.getElementById("h4Error").innerHTML = "Éxito";
                document.getElementById("pError").innerHTML = "Se ha actualizado el torneo exitosamente.";
                $('#modalMensaje').modal('show');
            }else{
                document.getElementById("h4Error").innerHTML = "Error";
                document.getElementById("pError").innerHTML = "Han surgido problemas al intentar modificar el torneo. Por favor, vuelva a intentarlo más tarde.";
                $('#modalMensaje').modal('show');
            }
            $('#dropdownTorneo').empty();
            obtenerListaTorneos();
        });

}
function actualizarDatosTorneo(torneo){
    document.getElementById("nombreTorneo").value = torneos[getIndex(torneos,torneo)][1];
}
function getIndex(array, target){

    for(var i = 0;i<array.length;i++){
        if(array[i][0].toString()===target.toString()){
            return i;
        }
    }
    return -1;
}
function obtenerListaTorneos() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-partido.php",
        async: false,
        data: {
            tipo: "obtenerListaTorneos"
        }
    })
        .done(function (data) {
            torneos = [];
            var opts = $.parseJSON(data);
            $.each(opts, function (i, d) {
                torneos.push([d.codigoTorneo, d.nombreTorneo]);
                // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                $('#dropdownTorneo').append('<option value="' + d.codigoTorneo + '">' + d.nombreTorneo+ '</option>');
            });
            if(torneos.length != 0){
                actualizarDatosTorneo(torneos[0][0]);
                noExistenTorneos = false;
            }else{
                document.getElementById("nombreTorneo").value = "No existen torneos.";
                noExistenTorneos = true;
            }
        });
}