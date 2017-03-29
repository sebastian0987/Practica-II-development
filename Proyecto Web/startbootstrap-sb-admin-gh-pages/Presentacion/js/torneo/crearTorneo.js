var tipoTorneo;
var checkboxesValidas = false;
var clubesSeleccionados = [];
$(document).ready(function () {
    // $('#modalCrearTorneo').modal('show');
    // $("#tituloModalCrearTorneo").html("Elija un tipo de torneo");

    obtenerListaCategorias();

    $('div.product-chooser').not('.disabled').find('div.product-chooser-item').on('click', function(){
        $(this).parent().parent().find('div.product-chooser-item').removeClass('selected');
        $(this).addClass('selected');
        $(this).find('input[type="radio"]').prop("checked", true);
    });

    $("#liga").click(function(){
        tipoTorneo = "liga";
        $('#dropdowncuantospasan').hide();
        $('#dropdownNumEquipos').hide();
        $('#dropdownNumEquiposPorGrupo').hide();
        $('#checkboxClubes').hide();
        $('#dropdownNumGrupos').hide();
        // $('#dropdownCuantosPasan').hide();
        $('#labelNumEquipos').hide();
        $('#labelNumGrupos').hide();
        // $('#labelCuantosPasan').hide();

        $("#tituloModalCrearTorneo").html("Creando una liga");
        $('#modalCrearTorneo').modal('show');
    });

    $("#eliminacion").click(function(){

        tipoTorneo = "eliminacion";
        $('#dropdowncuantospasan').hide();
        $('#dropdownNumEquipos').show();
        $('#dropdownNumEquiposPorGrupo').hide();
        $('#checkboxClubes').show();
        $('#dropdownNumGrupos').hide();
        // $('#dropdownCuantosPasan').hide();
        $('#labelNumEquipos').show();
        $('#labelNumGrupos').hide();
        // $('#labelCuantosPasan').hide();
        $('#opt16').hide();
        document.getElementById("dropdownNumEquipos").value = 8;

        $("#tituloModalCrearTorneo").html("Creando un torneo de eliminación");
        $('#modalCrearTorneo').modal('show');
    });

    $("#grupos").click(function(){
        tipoTorneo = "grupos";
        $('#dropdowncuantospasan').show();
        $('#dropdownNumEquipos').show();
        $('#dropdownNumEquiposPorGrupo').show();
        $('#checkboxClubes').show();
        $('#dropdownNumGrupos').show();
        // $('#dropdownCuantosPasan').show();
        $('#labelNumEquipos').show();
        $('#labelNumGrupos').show();
        $('#opt16').show();
        // $('#labelCuantosPasan').show();

        $("#tituloModalCrearTorneo").html("Creando un torneo por grupos");
        $('#modalCrearTorneo').modal('show');
    });
    $("#crear").click(function(){
        $(':checkbox:checked').each(function (i) {
            clubesSeleccionados[i] = $(this).val();
        });
        if(tipoTorneo == "liga"){
            if (document.getElementById("dropdownCategoria").value == ""
                || document.getElementById("nombreTorneo").value == "")
            {
                document.getElementById("pError").innerHTML = "Debe completar los campos marcados para continuar.";
                $('#modalMensaje').modal('show');
                document.getElementById("advertencia1").style.color = "#FF0000";
                document.getElementById("advertencia2").style.color = "#FF0000";
                return;
            }else{
                $('#modalConfirmacion').modal('show');
            }
        }else{
            if(tipoTorneo == "eliminacion"){
                var numBoxesChecked = $('input:checkbox:checked').length;
                var numEquipos = document.getElementById("dropdownNumEquipos").value;

                if (document.getElementById("dropdownCategoria").value == ""
                    || document.getElementById("nombreTorneo").value == ""
                    || document.getElementById("dropdownNumEquipos").value == "")
                {
                    document.getElementById("pError").innerHTML = "Debe completar los campos marcados para continuar.";
                    $('#modalMensaje').modal('show');
                    document.getElementById("advertencia1").style.color = "#FF0000";
                    document.getElementById("advertencia2").style.color = "#FF0000";
                    document.getElementById("advertencia3").style.color = "#FF0000";
                    return;
                }
                if(numBoxesChecked == numEquipos){
                    $('#modalConfirmacion').modal('show');
                }else{
                    document.getElementById("pError").innerHTML = "La cantidad de equipos de la eliminatoria" +
                        " debe ser igual a 8 o 16";
                    $('#modalMensaje').modal('show');
                    return;
                }
            }else{
                // tipoTorneo: grupos
                var numBoxesChecked = $('input:checkbox:checked').length;
                var numEquipos = document.getElementById("dropdownNumEquipos").value;

                if (document.getElementById("dropdownCategoria").value == ""
                    || document.getElementById("nombreTorneo").value == ""
                    || document.getElementById("dropdownNumEquipos").value == ""
                    || document.getElementById("dropdownNumGrupos").value == "")
                {
                    document.getElementById("pError").innerHTML = "Debe completar los campos marcados para continuar.";
                    $('#modalMensaje').modal('show');
                    document.getElementById("advertencia1").style.color = "#FF0000";
                    document.getElementById("advertencia2").style.color = "#FF0000";
                    document.getElementById("advertencia3").style.color = "#FF0000";
                    document.getElementById("advertencia4").style.color = "#FF0000";
                    // document.getElementById("advertencia5").style.color = "#FF0000";
                    return;
                }
                if(numBoxesChecked == numEquipos){
                    $('#modalConfirmacion').modal('show');
                }else{
                    document.getElementById("pError").innerHTML = "La cantidad de equipos del torneo" +
                        " debe ser igual a 8 o 16";
                    $('#modalMensaje').modal('show');
                    return;
                }
            }
            // alert(numberNotChecked);

        }
        $('#modalCrearTorneo').modal('hide');
    });


    $('#confirmar').click(function () {
        var categoria =  document.getElementById("dropdownCategoria").value.toString();
        var nombre = document.getElementById("nombreTorneo").value.toString();
        if(tipoTorneo=='liga'){
            crearTorneo(categoria, nombre, tipoTorneo, null,null);
        }
        if(tipoTorneo=='eliminacion'){
            var numGrupos = document.getElementById("dropdownNumGrupos").value.toString();
            crearTorneo(categoria, nombre, tipoTorneo, clubesSeleccionados,numGrupos);
        }
        if(tipoTorneo=='grupos'){
            var numGrupos = document.getElementById("dropdownNumGrupos").value.toString();
            crearTorneo(categoria, nombre, tipoTorneo, clubesSeleccionados,numGrupos);
        }
        $('#dropdownCategoria').empty();
        $('#dropdowncuantospasan').hide();
        $('#dropdownNumEquipos').hide();
        $('#dropdownNumEquiposPorGrupo').hide();
        $('#checkboxClubes').hide();
        $('#dropdownNumGrupos').hide();
        // $('#dropdownCuantosPasan').hide();
        $('#labelNumEquipos').hide();
        $('#labelNumGrupos').hide();
        obtenerListaCategorias();

    });

});
function printArray(array){
    for(var i = 0; i<array.length;i++){
        alert(array[i]);
    }
}
function dumpInArray(value){
    $('input:checkbox:checked').each(function() {
        clubesSeleccionados.push(value);
    });
}

// Uncheckea todos los checkboxes, y ademas regula las opciones de numero de grupos
function uncheckAll(value){
    $(":checkbox:checked").prop('checked', false);
    $(":checkbox").prop('disabled', false);

    if(document.getElementById("dropdownNumEquipos").value==8){
        $('#dropdownNumGrupos').empty().append('<option value=2> 2 </option>');
    }
    if(document.getElementById("dropdownNumEquipos").value==16){
        $('#dropdownNumGrupos').empty().append('<option value=2> 2 </option>').append('<option value=4> 4 </option>');
    }

}
function validarCheckboxes(value){
    var numBoxesChecked = $('input:checkbox:checked').length;
    var numEquipos = document.getElementById("dropdownNumEquipos").value;
    if(numBoxesChecked==numEquipos){
        $(":checkbox:not(:checked)").prop('disabled', true)
        checkboxesValidas = true;
    }else{
        $(":checkbox:not(:checked)").prop('disabled', false)
        checkboxesValidas = false;
    }
    // dumpInArray(value);
}
function obtenerClubesPorCategoria(categoria) {
    $('#checkboxClubes').empty().append('<label>Seleccione los clubes que participarán en el torneo</label>');

    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-torneo.php",
        async: false,
        data: {
            tipo: "obtenerClubes",
            codigo: categoria
        }
    }).done(function (data) {
        var opts = $.parseJSON(data);
        $.each(opts, function (i, d) {
            $('#checkboxClubes').append('<div class="checkbox" name="clubes" ></div>').append('<label></label>').append('<input type="checkbox" onclick="validarCheckboxes(this.value);" value="' + d.rutClubDeportivo + '">' + d.nombreClubDeportivo + '');
        });
    });
}

function crearTorneo(categoria, nombre, tipoTorneo, clubes, numGrupos){
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-torneo.php",
        async: false,
        data: {
            tipo: 'crear',
            tipoTorneo: tipoTorneo,
            categoria: categoria,
            nombre: nombre,
            clubes: clubes,
            numGrupos: numGrupos
        }
    })
        .done(function (data) {
            if (data == "ingresado") {
                document.getElementById("pError").innerHTML = "El torneo fue ingresado exitosamente.";
                document.getElementById("h4Error").innerHTML = "Éxito";
                $('#modalMensaje').modal('show');
                return;
            }
            else {
                // alert(data);
                document.getElementById("h4Error").innerHTML = "Error";
                document.getElementById("pError").innerHTML = "Han surgido problemas al intentar crear el torneo, vuelva a intentarlo más tarde.";
                $('#modalMensaje').modal('show');
                return;
            }
        });
}
function crearGrupos(){
    // Envio de todos los datos necesarios para generar partidos (equipos,
    // fechasAutomaticasS_N, categoria.

    // Como stackear arrays y jsonificarlos
    // var arr = new Array();
    // var record1 = {'a':'1','b':'2','c':'3'};
    // var record2 = {'d':'4','e':'5','f':'6'};
    // arr.push(record1);
    // arr.push(record2);
    // var jsonString = JSON.stringify(arr);


    // $.ajax({
    //     type: "POST",
    //     url: "generar-partidos.php",
    //     data: {
    //         data : jsonString
    //     },
    //     cache: false,
    //
    //     success: function(){
    //         alert("OK" + jsonString);
    //     }
    // });

    $.post("../Logica/generar-partidos.php",
        {
            data: jsonString,
            nombre: "asde!"
        },
        function(data, status){
            alert("Data: " + data + "\nStatus: " + status);
        });
}
function obtenerListaCategorias() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-torneo.php",
        async: false,
        data: {
            tipo: "obtenerCategoriasQueNoEstenJugandoUnTorneo"
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