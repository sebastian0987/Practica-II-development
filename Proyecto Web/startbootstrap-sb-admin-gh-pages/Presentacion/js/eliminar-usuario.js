/**
 * Created by tatan on 23-02-2017.
 */
$(document).ready(function () {
    obtenerCuenta();
    $("#btAceptar").click(function (e) {
        if (document.getElementById("password").value == "") {
            document.getElementById("errorUsuario").style.display = "inherit";
            document.getElementById("errorUsuario").innerHTML = "Debe ingresar su contraseña actual para continuar"
            return;
        };
        if (document.getElementById("password").value == ""
            || document.getElementById("correoEliminar").value == "") {
            document.getElementById("errorUsuario").style.display = "inherit";
            document.getElementById("errorUsuario").innerHTML = "Debe llenar todos los campos para continuar"
            return;
        };
        validarUsuario()
        $('#btConfirmar').click(function () {
            eliminarUsuario();
        });
    });
});
function validarUsuario() {
    // alert("s")
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
            if(document.getElementById("correo").value == document.getElementById("correoEliminar").value){
                document.getElementById("errorUsuario").style.display = "inherit";
                document.getElementById("errorUsuario").innerHTML = "No puede eliminar su propia cuenta de usuario";
            }else {
                document.getElementById("mensajeConfirmacion").innerHTML = "¿Esta seguro que desea eliminar al usuario: "+document.getElementById("correoEliminar").value+"?";
                $('#modalConfirmacion').modal('show');
            }
        }else {
            if (data == "invalido"){
                document.getElementById("errorUsuario").style.display = "inherit";
                document.getElementById("errorUsuario").innerHTML = "Recuerde ingresar su contraseña actual en el campo 'Contraseña'";
            }else {
                $('#modalError').modal('show');
            }
        }
    });
}
function eliminarUsuario() {
    $.ajax({
        type: "POST",
        url: "../Logica/controlador-gestionar-usuario.php",
        data: {
            tipo: "eliminar",
            Correo: document.getElementById("correoEliminar").value
        }
    }).done(function (data) {
        if (data == "eliminado") {
            $('#modalMensaje').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#modalMensaje').modal('show');
        }else {
            $('#modalError').modal('show');
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