<?php
// Ignorar los abortos hechos por el usuario y permitir que el script
// se ejecute siempre
ignore_user_abort(true);
set_time_limit(0);

echo 'Probando la gestión de conexión de PHP';

// Ejecutar un bucle que hará, con suerte,
// que hagamos clic fuera de la
// página o en el botón "Parar".
while(1)
{
    // ¿Falló la conexión?
    if(connection_status() != CONNECTION_NORMAL)
    {
        break;
    }

    // Dormir durante 10 segundos
    sleep(10);
}

// Si se alcanza esto, el 'break'
// fue provocado desde dentro del bucle while

// Por tanto, aquí podemos realizar una anotación o cualquier
// otra tarea que sea necesaria sin depender realmente del
// navegador.
?>