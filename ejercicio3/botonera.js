window.onload=function(){

    document.getElementById("principal").onmouseover = function() {

        document.getElementById("principal").style.backgroundColor = "beige";

    }

    document.getElementById("principal").onmouseout = function() {

        document.getElementById("principal").style.backgroundColor = "white";

    }

    document.getElementById("principal").onclick = function(event) {

        var e = event || window.event;

        var xPrincipal = document.getElementById("principal").offsetLeft;
        var yPrincipal = document.getElementById("principal").offsetTop;
        var xVentana = e.clientX;
        var yVentana = e.clientY;

        var x = xVentana - xPrincipal;
        var y = yVentana - yPrincipal;

        document.getElementById("mensaje").innerHTML = 'Click en: '+ x +'x'+ y;

    }

    document.getElementById("campo1").onkeypress = function() {

        var textoC1 = document.getElementById("campo1").value;

        document.getElementById("mensaje").innerHTML = '<p>' +  textoC1 + '</p>';

    }

    document.getElementById("boton01").onclick = function() {

        var textoC1 = document.getElementById("campo1").value;
        var textoC2 = document.getElementById("campo2").value;
        var textoC3 = document.getElementById("campo3").value;
        var textoConcat = '@';

        document.getElementById("mensaje").innerHTML = textoC1 + textoConcat + textoC2 + textoConcat + textoC3;

    }

    document.getElementById("boton02").onclick = function() {

        var textoC2 = document.getElementById("campo2").value;

        document.getElementById("mensaje").style.backgroundColor = textoC2;

    }

    document.getElementById("boton03").onclick = function() {

        if(document.getElementById("campo1").value == document.getElementById("campo2").value){

            document.getElementById("mensaje").innerHTML = "Los campos coinciden";

        }else{

            document.getElementById("mensaje").innerHTML = "Los campos no coinciden";

        }

    }

    document.getElementById("boton04").onclick = function() {

        var textoC1 = document.getElementById("campo1").value;
        var textoC2 = document.getElementById("campo2").value;
        var textoC3 = document.getElementById("campo3").value;
        var textoConcat = '@';
        
        document.getElementById("principal").innerHTML += '<p>' + textoC1 + textoConcat + textoC2 + textoConcat + textoC3 + '</p>';

    }

    document.getElementById("boton05").onclick = function() {

        var textoC1 = document.getElementById("campo1").value;

        for (var i = 0; i < document.getElementById("campo3").value; i++) {

            document.getElementById("principal").innerHTML += '<p>' + textoC1 + '</p>';

        }

    }

    document.getElementById("boton06").onclick = function(){

        var parrafos = document.getElementById("principal").getElementsByTagName("p");

        while(document.getElementById("principal").firstChild != null){

            parrafos[parrafos.length - 1].parentNode.removeChild(parrafos[parrafos.length - 1]);

        }

    }


    document.getElementById("boton07").onclick = function(){

        if(document.getElementById("principal").style.visibility == "hidden"){

            document.getElementById("principal").style.visibility = "visible";

        }else{

            document.getElementById("principal").style.visibility = "hidden";

        }

    }

    document.getElementById("boton08").onclick = function(){

        setTimeout(function(){document.getElementById("mensaje").innerHTML = "Alarma de 3 segundos"}, 3000)

    }

}
