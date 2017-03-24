/**
 * Created by tatan on 22-02-2017.
 */
$(document).ready(function () {
    $("#cerrarSesion").click(function (e) {
        $.ajax({
            type: "POST",
            url: "../Logica/controlador-gestionar-usuario.php",
            data: {
                tipo: "desconectar"
            }
        }).done(function (data) {
            if (data=="desconectado") {
                location.href = "index.php"
            }
        });
    });
});