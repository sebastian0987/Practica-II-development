$(function(){
    $(document).ready(function () {
        //<label for="primera" class="btn btn-info">Primera División <input type="checkbox" id="primera" class="badgebox"><span class="badge">&check;</span></label>
        $("#btSiguiente").show();
        // Obtiene las categorias y si estan o no jugando un torneo actualmente para deshabilitar sus correspondientes
        // checkboxes en caso de que ya esten jugando


        $.getJSON( "../Logica/isCategoriaJugandoTorneo.php", function( data ) {
            var checkboxes = [];
            var i = 1; // Varia entre 1 y 2. Cuenta las categorias.
            var j = 0;
            var nomCategoria;
            var color = ["btn btn-info","btn btn-primary"];
            $.each(data, function(key, value) {
                if ($.type(value) == "object") {
                    $.each(value, function(key, value) {
                        if(i%2==0){
                            // value = juegaSiNo (true o false)
                            if(value == true){
                                checkboxes.push( "<label for='" + i + "' class='" + color[j] + "'> "+ nomCategoria +
                                    "<input type='checkbox' id='" + i+ "' class='badgebox'><span class='badge'>&check; </span></label>");
                            }else{
                                checkboxes.push( "<label disabled='' for='" + i + "' class='" + color[j] + "'> "+ nomCategoria +
                                    "<input disabled='' type='checkbox' id='" + i+ "' class='badgebox'><span class='badge'>&check; </span></label>");
                            }
                            if(j==0){
                                j = 1;
                            }else{
                                j = 0;
                            }
                        }else{
                            // value = nombre de la categoria
                            nomCategoria = value;
                        }
                        i++;
                    })
                }
            });

            $( "<ul/>", {
                //"class": "my-new-list",
                html: checkboxes.join( "" )
            }).appendTo( "#divCategorias" );

            $("#btSiguiente").click(function(){
                $('#contenedor').load("index.php")
            });

            // var checkboxes = [];
            // $.each( data, function( key, val ) {
            //     checkboxes.push( "<li id='" + key + "'>" + val + "</li>" );
            // });
            // alert("Data: " + data + "\nStatus: " + status);
            //
            // $( "<ul/>", {
            //     "class": "my-new-list",
            //     html: checkboxes.join( "" )
            // }).appendTo( "body" );
        });
    });
});