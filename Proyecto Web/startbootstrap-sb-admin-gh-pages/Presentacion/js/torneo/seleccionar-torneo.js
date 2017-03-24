/**
 * Created by Andrés on 05-03-2017.
 */
var tipoTorneo;
$(document).ready(function () {
    // obtenerListaTorneos();
    $('#verTorneo').click(function(){
        if(document.getElementById("dropdownTorneo").value==""){
            document.getElementById("pError").innerHTML = "Debe seleccionar un torneo";
            $('#modalMensaje').modal('show');
            return;
        }else{
            var url;
            if(document.getElementById("dropdownTorneo").value=="eliminacion"){
               url = "torneo-eliminacion.php";
            }
            if(document.getElementById("dropdownTorneo").value=="liga"){
                url = "liga.php";
            }
            if(document.getElementById("dropdownTorneo").value=="grupos"){
                url = "grupos.php";
            }
            window.location = url;
        }
    });

});

function obtenerListaTorneos() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-torneo.php",
        async: false,
        data: {
            tipo: "obtenerListaTorneos"
        }
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            $.each(opts, function (i, d) {
                // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                $('#dropdownTorneo').append('<option value="' + d.tipoTorneo + '">' + d.nombreTorneo+ '</option>');
            });
        });
}
function seleccionarTorneo(torneo){
    torneoSeleccionado = torneo;
}