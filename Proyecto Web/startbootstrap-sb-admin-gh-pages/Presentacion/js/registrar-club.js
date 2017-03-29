/**
 * Created by tatan on 21-01-2017.
 */
$(document).ready(function () {
    // $(':file').on('change', function() {
    //     var file = this.files[0];
    //     if (file.size > 1024) {
    //         alert('max upload size is 1k')
    //         document.getElementById("escudoClub").value = "";
    //     }
    //     alert(file.name);
    //     // Also see .name, .type
    // });
    obtenerCategoria()
    $("#tbNombre").keypress(function (e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8)
            return true;
        patron = /[A-Za-z\s]/;
        te = String.fromCharCode(tecla);
        return patron.test(te);
    });
    $(':file').on('change', function() {
        var file = this.files[0];
        if (file.size > 3000000) {
            alert('No se puede ingresar la imagen deseada por que supera el tamaño máximo permitido(3 MB)');
            document.getElementById("escudoClub").value = "";
        }
        //     alert(file.name);
        //     // Also see .name, .type
    });
    var listaCategoria = [];
    var listaRut = [];
    var listaNombre = [];
    var listaCorreo = [];
    var listaContacto = [];
    $("#btAceptar").click(function () {
        listaCategoria.length = 0;
        listaRut.length = 0;
        listaNombre.length = 0;
        listaCorreo.length = 0;
        listaContacto.length = 0;
        if (document.getElementById("tbNombre").value == ""
            || document.getElementById("tbRut").value == ""
            || document.getElementById("tbFechaFundacion").value == ""
            || document.getElementById("tbPersonalidadJuridica").value == "") {
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
            document.getElementById("h4Error").innerHTML = "Error";
            document.getElementById("pError").innerHTML = "Debe completar los campos marcados para continuar.";
            $('#modalMensaje').modal('show');
            document.getElementById("advertencia1").style.color = "#FF0000";
            document.getElementById("advertencia2").style.color = "#FF0000";
            document.getElementById("advertencia3").style.color = "#FF0000";
            document.getElementById("advertencia4").style.color = "#FF0000";
            document.getElementById("advertencia5").style.color = "#FF0000";
            document.getElementById("advertencia6").style.color = "#FF0000";
            return;
        }
        if ($(":checkbox:checked").length < 1) {
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
            document.getElementById("h4Error").innerHTML = "Error";
            document.getElementById("pError").innerHTML = "Debe seleccionar al menos una categoría para continuar.";
            $('#modalMensaje').modal('show');
            return
        }
        if (document.getElementById("tbDirigenteRut").value == ""
            || document.getElementById("tbDirigenteNombre").value == ""
            || document.getElementById("tbDirigenteCorreo").value == ""
            || document.getElementById("tbDirigenteContacto").value == "") {
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
            document.getElementById("h4Error").innerHTML = "Error";
            document.getElementById("pError").innerHTML = "Debe completar los campos de al menos un dirigente para continuar.";
            $('#modalMensaje').modal('show');
            document.getElementById("advertencia5").style.color = "#FF0000";
            return;
        }

        $(':checkbox:checked').each(function (i) {
            listaCategoria[i] = $(this).val();
        });
        var j = 0;
        for (i = 0; i < document.getElementsByName("dirigentesRut").length; i++) {
            if (document.getElementsByName("dirigentesRut")[i].value !== "") {
                listaRut [j] = document.getElementsByName("dirigentesRut")[i].value;
                listaNombre [j] = document.getElementsByName("dirigentesNombre")[i].value;
                listaCorreo [j] = document.getElementsByName("dirigentesCorreo")[i].value;
                listaContacto [j] = document.getElementsByName("dirigentesContacto")[i].value;
                j++;
            }
        }
        if (document.getElementById("escudoClub").value == "") {
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
            document.getElementById("h4Error").innerHTML = "Error";
            document.getElementById("pError").innerHTML = "Debe ingresar una imagen con el escudo del club para continuar.";
            $('#modalMensaje').modal('show');
            document.getElementById("advertencia6").style.color = "#FF0000";
            return;
        }
        if (!validarRut(document.getElementById("tbRut").value)) {
            document.getElementById("pError").innerHTML = "El RUT del Club ingresado no es valido.";
            $('#modalMensaje').modal('show');
            return;
        }

        for(i=0;i<listaRut.length;i++){
            if(!validarRut(listaRut[i])){
                document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
                document.getElementById("pError").innerHTML = "El RUT de uno de los dirigentes ingresados no es valido.";
                $('#modalMensaje').modal('show');
                return;
            }
        }
        $("#modalConfirmacion").modal('show');

    });
    $('#btConfirmar').click(function () {
        var filename = $('input[type=file]').val().split('\\').pop();
        ingresarClub(
            document.getElementById("tbNombre").value,
            document.getElementById("tbRut").value,
            document.getElementById("tbFechaFundacion").value,
            document.getElementById("tbPersonalidadJuridica").value,
            listaCategoria,
            listaRut,
            listaNombre,
            listaCorreo,
            listaContacto,
            filename
        );
    });
});
function ingresarFoto(nombreImagen) {
    var file_data = $('#escudoClub').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('nombreImagen', nombreImagen);
    $.ajax({
        url: '../Logica/guardarImagen.php',
        type: 'POST',
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
    });
    // $.ajax({
    //     // Your server script to process the upload
    //     url: '../Logica/guardarImagen.php',
    //     type: 'POST',
    //
    //     // Form data
    //
    //     data: new FormData($('form')[0]),
    //
    //     // Tell jQuery not to process data or worry about content-type
    //     // You *must* include these options!
    //     cache: false,
    //     contentType: false,
    //     processData: false,
    //
    //     // Custom XMLHttpRequest
    //     xhr: function() {
    //         var myXhr = $.ajaxSettings.xhr();
    //         if (myXhr.upload) {
    //             // For handling the progress of the upload
    //             myXhr.upload.addEventListener('progress', function(e) {
    //                 if (e.lengthComputable) {
    //                     $('progress').attr({
    //                         value: e.loaded,
    //                         max: e.total,
    //                     });
    //                 }
    //             } , false);
    //         }
    //         return myXhr;
    //     },
    // });
}
function validarRut(rutCompleto) {
    cantRut = rutCompleto.length - 1;
    rut = rutCompleto.substr(0, cantRut);
    digv = rutCompleto.substr(cantRut, rutCompleto.length);
    if (digv == 'K')
        digv = 'k';
    var M = 0, S = 1, T = rut;
    for (; T; T = Math.floor(T / 10))
        S = (S + T % 10 * (9 - M++ % 6)) % 11;
    if (S) {
        return (S - 1 == digv);
    } else {
        return ('k' == digv);
    }
}

function obtenerCategoria() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "obtenerCategorias"
        }
    }).done(function (data) {
        var opts = $.parseJSON(data);
        $.each(opts, function (i, d) {
            $('#checkboxCategoria').append('<div class="checkbox"></div>').append('<label></label>').append('<input type="checkbox" value="' + d.codigoCategoria + '">' + d.nombreCategoria + '');
        });
    });
}

function ingresarClub(nombre, rut, fecha, personalidad, categoria, rutDirigente, nombreDirigente, correoDirigente, contactoDirigente, foto) {
    var date = new Date();
    var nombreImagen = date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear()+"-"+date.getHours()+"-"+date.getMinutes()+"-"+date.getSeconds();
    var extension = document.getElementById("escudoClub").value.split('.').pop();
    var nombreCompletoImagen = nombreImagen+"."+extension;
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "registrar",
            Nombre: nombre,
            Rut: rut,
            Fecha: fecha,
            Personalidad: personalidad,
            Categoria: categoria,
            RutDirigente: rutDirigente,
            NombreDirigente: nombreDirigente,
            CorreoDirigente: correoDirigente,
            ContactoDirigente: contactoDirigente,
            Foto: nombreCompletoImagen
        }
    }).done(function (data) {
        if (data == "ingresado") {
            ingresarFoto(nombreImagen);
            document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#DFF2BF";
            document.getElementById("h4Error").innerHTML = "Éxito";
            document.getElementById("pError").innerHTML = "El Club Deportivo fue ingresado exitosamente.";
            $('#modalMensaje').modal('show');
            limpiarCampos();
            return;
        } else {
            if (data == "repetido") {
                document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
                document.getElementById("h4Error").innerHTML = "Error";
                document.getElementById("pError").innerHTML = "Ya existe un Club deportivo con el mismo rut en el sistema.";
                $('#modalMensaje').modal('show');
                return;
            } else {
                if (data == "dirigenteRepetido") {
                    document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
                    document.getElementById("h4Error").innerHTML = "Error";
                    document.getElementById("pError").innerHTML = "Uno de los dirigentes ingresados ya es dirigente de un Club Deportivo.";
                    $('#modalMensaje').modal('show');
                    return;
                } else {
                    if (data=="imagenRepetida"){
                        document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
                        document.getElementById("h4Error").innerHTML = "Error";
                        document.getElementById("pError").innerHTML = "Ya existe una imagen en el sistema con mismo nombre de la  imagen que desea ingresar.";
                        $('#modalMensaje').modal('show');
                        return;
                    }else {
                        document.getElementById("encabezadoModalMensaje").style.backgroundColor = "#FFBABA";
                        document.getElementById("h4Error").innerHTML = "Error";
                        document.getElementById("pError").innerHTML = "Han surgido problemas al intentar ingresar el Club Deportivo, por favor vuelva a intentarlo mas tarde.";
                        $('#modalMensaje').modal('show');
                        return;
                    }
                }
            }
        }
    });
}

function limpiarCampos() {
    document.getElementById("tbNombre").value = "";
    document.getElementById("tbRut").value = "";
    document.getElementById("tbFechaFundacion").value = ""
    document.getElementById("tbPersonalidadJuridica").value = "";
    $('input:checkbox').removeAttr('checked');
    for (i = 0; i < document.getElementsByName("dirigentesRut").length; i++) {
        document.getElementsByName("dirigentesRut")[i].value = "";
        document.getElementsByName("dirigentesNombre")[i].value = "";
        document.getElementsByName("dirigentesCorreo")[i].value = "";
        document.getElementsByName("dirigentesContacto")[i].value = "";
        document.getElementById("escudoClub").value = "";
    }
}