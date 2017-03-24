/**
 * Created by tatan on 23-02-2017.
 */
$(document).ready(function () {
    obtenerCuenta();
    $("#btAceptar").click(function (e) {
        // alert("1")
        if (document.getElementById("password").value == "") {
            document.getElementById("errorUsuario").style.display = "inherit";
            document.getElementById("errorUsuario").innerHTML = "Debe ingresar su contraseña actual para poder ingresar una nueva"
            return;
        };
        // alert("2")
        if (document.getElementById("password").value == ""
            || document.getElementById("nuevaPassword").value == ""
            || document.getElementById("nuevaConfirmarPassword").value == "") {
            document.getElementById("errorUsuario").style.display = "inherit";
            document.getElementById("errorUsuario").innerHTML = "Debe llenar todos los campos para continuar"
            return;
        };
        // alert("3")
        if (document.getElementById("nuevaPassword").value != document.getElementById("nuevaConfirmarPassword").value) {
            document.getElementById("errorUsuario").style.display = "inherit";
            document.getElementById("errorUsuario").innerHTML = "Las contraseñas ingresadas no coinciden"
            return;
        };
        // alert("4")
        validarUsuario()
    });
});
function validarUsuario() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-usuario.php",
        data: {
            tipo: "validar",
            Correo: document.getElementById("correo").value,
            Password: document.getElementById("password").value
        }
    }).done(function (data) {
        if (data == "validado") {
            modificarContraseña()
        }else {
            document.getElementById("errorUsuario").style.display = "inherit";
            document.getElementById("errorUsuario").innerHTML = "Recuerde ingresar su contraseña actual en el campo 'Contraseña'";
        }
    });
}
function modificarContraseña() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-usuario.php",
        data: {
            tipo: "modificar",
            Correo: document.getElementById("correo").value,
            Password: document.getElementById("nuevaPassword").value
        }
    }).done(function (data) {
        if (data == "modificado") {
            $('#modalMensaje').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#modalMensaje').modal('show');
            // location.href = "index.php"
        }
    });
}

function obtenerCuenta() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-usuario.php",
        data: {
            tipo: "obtener"
        }
    }).done(function (data) {
        var opts = $.parseJSON(data);
        document.getElementById("correo").value = opts[0][0];
    });
}