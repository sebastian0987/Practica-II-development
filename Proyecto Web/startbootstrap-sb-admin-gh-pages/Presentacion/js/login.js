/**
 * Created by tatan on 22-02-2017.
 */
$(document).ready(function () {
    $("#btIngresar").click(function (e) {
        $.ajax({
            type: "POST",
            url: "../Logica/controlador-gestionar-usuario.php",
            data: {
                tipo: "conectar",
                Correo: document.getElementById("correo").value,
                Password: document.getElementById("password").value
            }
        }).done(function (data) {
            if (data=="correcto") {
                location.href = "index.php"
            } else {
                if (data == "incorrecto") {
                    document.getElementById("errorUsuario").innerHTML = "Correo electrónico o contraseña incorrecta"
                } else {
                    //Problemas de conexion
                }
            }
        });
    });
});