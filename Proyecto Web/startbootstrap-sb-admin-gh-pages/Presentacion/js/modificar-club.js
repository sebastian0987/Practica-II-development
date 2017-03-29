/**
 * Created by tatan on 16-02-2017.
 */

var listaCategoriaOriginal = [];
var listaDirigenteOriginal = [];
$(document).ready(function () {
    solicitarRut();
    obtenerCategoria();
    $("#tbNombre").keypress(function (e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8)
            return true;
        patron = /[A-Za-z\s]/;
        te = String.fromCharCode(tecla);
        return patron.test(te);
    });

    var listaCategoria = [];
    var listaRut = [];
    var listaNombre = [];
    var listaCorreo = [];
    var listaContacto = [];
    $('#btAceptarModalSolicitud').click(function () {
        listaCategoriaOriginal.length = 0;
        listaDirigenteOriginal.length = 0;
        if (document.getElementById("btAceptarModalSolicitud").innerHTML == "Buscar") {
            if (document.getElementById("tbBuscar").value == "") {
                document.getElementById("errorModalSolicitar").innerHTML = "Debe ingresar un RUT para continuar.";
                return;
            }
            obtenerClubDeportivo(document.getElementById("tbBuscar").value);
        } else {
            document.getElementById("encabezadoModalSolicitar").style.backgroundColor = "#BDE5F8";
            document.getElementById("tituloModalSolicitud").innerHTML = "Buscar Club Deportivo";
            document.getElementById("mensajeModalSolicitud").innerHTML = "Ingrese RUT del Club Deportivo:";
            document.getElementById("btAceptarModalSolicitud").innerHTML = "Buscar";
            document.getElementById("tbBuscar").style.display = 'initial';
            solicitarRut();
        }
    });
    $("#btAceptar").click(function () {
        listaCategoria.length = 0;
        listaRut.length = 0;
        listaNombre.length = 0;
        listaCorreo.length = 0;
        listaContacto.length = 0;
        if (document.getElementById("tbNombre").value == ""
            || document.getElementById("tbFechaFundacion").value == ""
            || document.getElementById("tbPersonalidadJuridica").value == "") {
            document.getElementById("pError").innerHTML = "Debe completar todos los campos para continuar.";
            $('#modalMensaje').modal('show');
            return;
        }
        if ($(':checkbox:checked').length < 1) {
            document.getElementById("pError").innerHTML = "Debe seleccionar al menos una categoría para continuar.";
            $('#modalMensaje').modal('show');
            return
        }
        if (document.getElementById("tbDirigenteRut").value == ""
            || document.getElementById("tbDirigenteNombre").value == ""
            || document.getElementById("tbDirigenteCorreo").value == ""
            || document.getElementById("tbDirigenteContacto").value == "") {
            document.getElementById("pError").innerHTML = "Debe completar los campos de al menos un dirigente para continuar.";
            $('#modalMensaje').modal('show');
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

//--------------------Escudo Club----------------------------------------
        // if (document.getElementById("escudoClub").value == "") {
        //     document.getElementById("pError").innerHTML = "Debe ingresar una imagen con el escudo del club para continuar.";
        //     $('#modalMensaje').modal('show');
        //     return;
        // }
//-------------------------------------------------------------------------

        if (!validarRut(document.getElementById("tbRut").value)) {
            document.getElementById("pError").innerHTML = "El RUT del Club Deportivo ingresado no es valido.";
            $('#modalMensaje').modal('show');
            return;
        }
        for (i = 0; i < listaRut.length; i++) {
            if (!validarRut(listaRut[i])) {
                document.getElementById("pError").innerHTML = "El RUT de uno de los dirigentes ingresados no es valido.";
                $('#modalMensaje').modal('show');
                return;
            }
        }

        $("#modalConfirmacion").modal('show');
    });
    $('#btConfirmar').click(function () {
        modificarDirigentes(listaRut, listaNombre, listaCorreo, listaContacto);
        // if (document.getElementById("escudoClub").value == ""){
        //     modificarDirigentes(listaRut, listaNombre, listaCorreo, listaContacto);
        // }else {
        //     verificarFoto(listaRut, listaNombre, listaCorreo, listaContacto);
        // }
        // modificarDirigentes(listaRut, listaNombre, listaCorreo, listaContacto);
        // modificarClub(
        //     document.getElementById("tbNombre").value,
        //     document.getElementById("tbRut").value,
        //     document.getElementById("tbFechaFundacion").value,
        //     document.getElementById("tbPersonalidadJuridica").value,
        //     document.getElementById("escudoClub").value
        // );
        // modificarEquipo(listaCategoria);
    });

});

function solicitarRut() {
    $('#modalSolicitar').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#modalSolicitar').modal('show');
}

function obtenerClubDeportivo(rut) {
    var opts;
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "obtenerClubDeportivo",
            Rut: rut
        }
    }).done(function (data) {
        if (data == "vacio") {
            document.getElementById("errorModalSolicitar").innerHTML = "No existe ningun club deportivo en el sistema con el RUT ingresado.";
            return;
        } else {
            opts = $.parseJSON(data);
            document.getElementById("tbNombre").value = opts[0][0];
            document.getElementById("tbRut").value = opts[0][1];
            document.getElementById("tbFechaFundacion").value = opts[0][2];
            document.getElementById("tbPersonalidadJuridica").value = opts[0][3];
            document.getElementById("escudoClubDeportivo").src = "image/escudos/"+opts[0][4];
            obtenerCategoriasSegunClubDeportivo(opts[0][1]);
            obtenerDirigentesSegunClubDeportivo(opts[0][1]);
        }
    });
}

function obtenerCategoriasSegunClubDeportivo(rut) {
    // var listaCategoriaClub = []
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "obtenerCategoriaSegunClub",
            Rut: rut
        }
    }).done(function (data) {
        var opts = $.parseJSON(data);
        $.each(opts, function (i, d) {
            listaCategoriaOriginal[i] = d.codigoCategoria;
            // listaCategoriaClub[i] = d.codigoCategoria;
        });
        marcarCategoriaClub()
    });
}

function marcarCategoriaClub() {
    $(':checkbox').each(function (i) {
        // alert($(this).val()+"   "+listaCategoriaClub[0])
        for (j = 0; j < listaCategoriaOriginal.length; j++) {
            // alert($(this).val() +"   "+listaCategoriaClub[j])
            if ($(this).val() == listaCategoriaOriginal[j]) {
                $(this).prop('checked', true);
            }
        }
    });
}
function obtenerDirigentesSegunClubDeportivo(rut) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "obtenerDirigentesSegunClub",
            Rut: rut
        }
    }).done(function (data) {
        var opts = $.parseJSON(data);
        $.each(opts, function (i, d) {
            listaDirigenteOriginal[i] = d.rutDirigente
            document.getElementsByName("dirigentesRut")[i].value = d.rutDirigente;
            document.getElementsByName("dirigentesNombre")[i].value = d.nombrePersona;
            document.getElementsByName("dirigentesCorreo")[i].value = d.correoDirigente;
            document.getElementsByName("dirigentesContacto")[i].value = d.contactoDirigente;
        });
        $('#modalSolicitar').modal('hide');
    });
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
    })
        .done(function (data) {
            var opts = $.parseJSON(data);
            $.each(opts, function (i, d) {
                $('#checkboxCategoria').append('<div class="checkbox"></div>').append('<label></label>').append('<input type="checkbox" value="' + d.codigoCategoria + '">' + d.nombreCategoria + '');
            });
        });
}

function modificarClub(nombre, rut, fecha, personalidad) {
    // var filename = $('input[type=file]').val().split('\\').pop();
    if (document.getElementById("escudoClub").value == ""){
        var nombreCompletoImagen = "";
    }else {
        var date = new Date();
        var nombreImagen = date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear()+"-"+date.getHours()+"-"+date.getMinutes()+"-"+date.getSeconds();
        var extension = document.getElementById("escudoClub").value.split('.').pop();
        var nombreCompletoImagen = nombreImagen+"."+extension;
    }
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "modificar",
            Nombre: nombre,
            Rut: rut,
            Fecha: fecha,
            Personalidad: personalidad,
            Foto: nombreCompletoImagen
        }
    }).done(function (data) {
        if (data == "modificado") {
            if (document.getElementById("escudoClub").value != "") {
                ingresarFoto(nombreImagen);
            }
            limpiarCampos()
            document.getElementById("encabezadoModalSolicitar").style.backgroundColor = "#DFF2BF";
            document.getElementById("tituloModalSolicitud").innerHTML = "Éxito";
            document.getElementById("mensajeModalSolicitud").innerHTML = "Las modificaciones del Club Deportivo fueron ingresadas exitosamente.";
            document.getElementById("btAceptarModalSolicitud").innerHTML = "Modificar otro Club Deportivo"
            document.getElementById("tbBuscar").value = "";
            document.getElementById("tbBuscar").style.display = 'none';
            document.getElementById("errorModalSolicitar").innerHTML = "";
            $('#modalSolicitar').modal('show');
            return;
        } else {
            document.getElementById("pError").innerHTML = "Han surgido problemas al intentar modificar el Club Deportivo, por favor vuelva a intentarlo mas tarde.";
            $('#modalMensaje').modal('show');
            return;
        }
    });
}

function modificarEquipo() {
    var listaCategoriaNueva = [];
    $(':checkbox:checked').each(function (i) {
        listaCategoriaNueva[i] = $(this).val();
    });
    var editar = true;
    //-----Insertar Equipo-----------------
    for (i = 0; i < listaCategoriaNueva.length; i++) {
        for (j = 0; j < listaCategoriaOriginal.length; j++) {
            if (listaCategoriaNueva[i] == listaCategoriaOriginal[j]) {
                editar = false;
                break;
            }
        }
        if (editar) {
            modificarEquipoAjax("insertarEquipo", listaCategoriaNueva[i], document.getElementById("tbRut").value)
        }
        editar = true;
    }
    //------Eliminar Equipo-------------------
    for (i = 0; i < listaCategoriaOriginal.length; i++) {
        for (j = 0; j < listaCategoriaNueva.length; j++) {
            if (listaCategoriaOriginal[i] == listaCategoriaNueva[j]) {
                editar = false;
                break;
            }
        }
        if (editar) {
            modificarEquipoAjax("eliminarEquipo", listaCategoriaOriginal[i], document.getElementById("tbRut").value)
        }
        editar = true;
    }
}

function modificarEquipoAjax(accion, categoria, rut) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: accion,
            Categoria: categoria,
            Rut: rut
        }
    }).done(function (data) {
        if (data == "terminado") {
            return;
        } else {
            document.getElementById("pError").innerHTML = "Han surgido problemas al intentar modificar las categorias del Club Deportivo, por favor vuelva a intentarlo mas tarde.";
            $('#modalMensaje').modal('show');
            return;
        }
    });
}

function modificarDirigentes(listaRutDirigenteNueva, listaNombreDirigenteNueva, listaCorreoDirigenteNueva, listaContactoDirigenteNueva) {
    var listaRut = [];
    var listaNombre = [];
    var listaCorreo = [];
    var listaContacto = [];
    var k = 0;
    var editar = true;
    //------Eliminar Dirigente-------------------

    for (i = 0; i < listaDirigenteOriginal.length; i++) {
        for (j = 0; j < listaRutDirigenteNueva.length; j++) {
            if (listaDirigenteOriginal[i] == listaRutDirigenteNueva[j]) {
                editar = false;
                break;
            }
        }
        if (editar) {
            listaRut[k] = listaDirigenteOriginal[i];
            k++;
            // modificarDirigenteAjax("eliminarDirigente", listaDirigenteOriginal[i], "", "", "", "");
        }
        editar = true;
    }
    if (listaRut.length != 0) {
        modificarDirigenteAjax(
            "eliminarDirigente",
            listaRut,
            "",
            "",
            "",
            document.getElementById("tbRut").value
        )
    }
    listaRut.length = 0;
    k = 0;
    //-----Insertar Dirigente-----------------
    for (i = 0; i < listaRutDirigenteNueva.length; i++) {
        for (j = 0; j < listaDirigenteOriginal.length; j++) {
            if (listaRutDirigenteNueva[i] == listaDirigenteOriginal[j]) {
                editar = false;
                break;
            }
        }
        if (editar) {
            listaRut[k] = listaRutDirigenteNueva[i];
            listaNombre[k] = listaNombreDirigenteNueva[i];
            listaCorreo[k] = listaCorreoDirigenteNueva[i];
            listaContacto[k] = listaContactoDirigenteNueva[i];
            k++;
            // modificarDirigenteAjax(
            //     "insertarDirigente",
            //     listaRutDirigenteNueva[i],
            //     listaNombreDirigenteNueva[i],
            //     listaCorreoDirigenteNueva[i],
            //     listaContactoDirigenteNueva[i],
            //     document.getElementById("tbRut").value
            // )
        }
        editar = true;
    }
    if (listaRut.length != 0) {
        modificarDirigenteAjax(
            "insertarDirigente",
            listaRut,
            listaNombre,
            listaCorreo,
            listaContacto,
            document.getElementById("tbRut").value
        )
    } else {
        modificarClub(
            document.getElementById("tbNombre").value,
            document.getElementById("tbRut").value,
            document.getElementById("tbFechaFundacion").value,
            document.getElementById("tbPersonalidadJuridica").value
        );
        updateDirigente(listaRutDirigenteNueva,listaNombreDirigenteNueva,listaCorreoDirigenteNueva,listaContactoDirigenteNueva);
        modificarEquipo();
        // if (document.getElementById("escudoClub").value != "") {
        //     ingresarFoto();
        // }
    }

}

function modificarDirigenteAjax(accion, rutDirigente, nombreDirigente, correoDirigente, contactoDirigente, rut) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: accion,
            Rut: rut,
            RutDirigente: rutDirigente,
            NombreDirigente: nombreDirigente,
            CorreoDirigente: correoDirigente,
            ContactoDirigente: contactoDirigente,
        }
    }).done(function (data) {
        if (data == "terminado") {
            if (accion == "insertarDirigente") {
                modificarClub(
                    document.getElementById("tbNombre").value,
                    document.getElementById("tbRut").value,
                    document.getElementById("tbFechaFundacion").value,
                    document.getElementById("tbPersonalidadJuridica").value
                );
                modificarEquipo();
                // if (document.getElementById("escudoClub").value != "") {
                //     ingresarFoto();
                // }
            }
            return;
        } else {
            if (data == "dirigenteRepetido") {
                document.getElementById("pError").innerHTML = "Uno de los dirigentes ingresados ya es dirigente de un Club Deportivo.";
                $('#modalMensaje').modal('show');
                return;
            } else {
                document.getElementById("pError").innerHTML = "Han surgido problemas al intentar modificar los dirigentes del Club Deportivo, por favor vuelva a intentarlo mas tarde.";
                $('#modalMensaje').modal('show');
                return;
            }
        }
    });
}

function verificarFoto(listaRutDirigenteNueva, listaNombreDirigenteNueva, listaCorreoDirigenteNueva, listaContactoDirigenteNueva) {
    var filename = $('input[type=file]').val().split('\\').pop();
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "verificarImagen",
            NombreImagen: filename
        }
    }).done(function (data) {
        if (data == "imagenLimpia") {
            modificarDirigentes(listaRutDirigenteNueva, listaNombreDirigenteNueva, listaCorreoDirigenteNueva, listaContactoDirigenteNueva);
        } else {
            if (data == "imagenRepetida"){
                document.getElementById("pError").innerHTML = "Ya existe una imagen en el sistema con el mismo nombre de la  imagen que desea ingresar.";
                $('#modalMensaje').modal('show');
                return;
            }else{
                document.getElementById("pError").innerHTML = "Han surgido problemas al intentar modificar las categorias del Club Deportivo, por favor vuelva a intentarlo mas tarde.";
                $('#modalMensaje').modal('show');
                return;
            }
        }
    });

}
function ingresarFoto(nombreImagen) {
    eliminarFoto();
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

function eliminarFoto() {
    var str = document.getElementById("escudoClubDeportivo").src;
    var nombreImagenAnterior = str.substring(str.lastIndexOf("/") + 1, str.length);
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "eliminarImagen",
            NombreImagen: nombreImagenAnterior
        }
    });
}

function updateDirigente(listaRut,listaNombre,listaCorreo,listaContacto) {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-club.php",
        data: {
            tipo: "modificarDirigente",
            RutDirigente:listaRut,
            NombreDirigente:listaNombre,
            CorreoDirigente:listaCorreo,
            ContactoDirigente:listaContacto
        }
    });
}
function limpiarCampos() {
    $('input:checkbox').removeAttr('checked');
    for (i = 0; i < document.getElementsByName("dirigentesRut").length; i++) {
        document.getElementsByName("dirigentesRut")[i].value = "";
        document.getElementsByName("dirigentesNombre")[i].value = "";
        document.getElementsByName("dirigentesCorreo")[i].value = "";
        document.getElementsByName("dirigentesContacto")[i].value = "";
    }
    document.getElementById("escudoClub").value = "";
}