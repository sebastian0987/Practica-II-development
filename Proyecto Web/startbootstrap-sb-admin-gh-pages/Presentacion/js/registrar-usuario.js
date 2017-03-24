/**
 * Created by tatan on 22-02-2017.
 */
$(document).ready(function () {
    $("#btAceptar").click(function (e) {
        if (document.getElementById("correo").value == ""
            || document.getElementById("password").value == ""
            || document.getElementById("confirmarPassword").value == "") {
            document.getElementById("errorUsuario").style.display = "inherit";
            document.getElementById("errorUsuario").innerHTML = "Debe ingresar un correo y una contraseña para continuar"
            return;
        };
        if (document.getElementById("password").value != document.getElementById("confirmarPassword").value) {
            document.getElementById("errorUsuario").style.display = "inherit";
            document.getElementById("errorUsuario").innerHTML = "Las contraseñas ingresadas no coinciden"
            return;
        };
        $.ajax({
            type: "POST",
            url: "../Logica/controlador-gestionar-usuario.php",
            data: {
                tipo: "registrar",
                Correo: document.getElementById("correo").value,
                Password: document.getElementById("password").value
            }
        }).done(function (data) {
            if (data == "registrado") {
                document.getElementById("errorUsuario").style.display = "none";
                document.getElementById("correo").value = "";
                document.getElementById("password").value = "";
                document.getElementById("confirmarPassword").value = "";
                $('#modalMensaje').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#modalMensaje').modal('show');
            } else {
                if (data == "denegado") {
                    document.getElementById("errorUsuario").style.display = "inherit";
                    document.getElementById("errorUsuario").innerHTML = "Ya existe un usuario con el correo ingresado."
                }
            }
        });
    });
});