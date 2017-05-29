<?php
    $usuarios = array("wmunoze","ljpalaciom","");
    function traerI($i){
        $str = file_get_contents("http://iotserver1.dis.eafit.edu.co/weather/getSwitch?idhome=".$usuarios[$i]);
        $claves = preg_split("/\<\/pre\>/", "$str");
        $htmlx = $claves[0];
        $claves2 = preg_split("/\<pre\>/", "$htmlx");
        return $htmlx2 = $claves2[0];
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>NodeMCU | Control de luces</title>
     <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="css/normalizador.css">
    <link rel="stylesheet" href="css/ECluces.css">
    <link rel="stylesheet" href="css/fontello-82d9a87c/css/power_boton.css">
</head>
<body>
    <header>
        <div class="Clima">
            <h3>Medicion Climatica</h3>
            <figure>
                <img src="imagenes/icons/icon-nube.png" alt="Nuve">
            </figure>
        </div>
        
        <div class="LogoMain">
            <figure>
                <img src="imagenes/Logo_sub.png" alt="icon-Logo">
            </figure>
        </div>
        
        <div class="Luces">
            <h3>Control de luces</h3>
            <figure>
                <img src="imagenes/icons/icon-bombillo2.png" alt="Bombillo">
            </figure>
        </div>
    </header>
    
    <section class="contenido">
        <!--<div class="luz">
            <div class="etiquetaN">
                <h5>Luz de prueba</h5>
            </div>
            <div class="boton">
                <input type="checkbox" id="toggle">
                <label for="toggle" class="icon-power"></label>
            </div>
        </div>-->
        
    </section>
    <iframe src="#" frameborder="0" id="frame"></iframe>
    <!--<button class="pp">Prueba de aparicion</button>-->
    <footer>
       Luis Javier <br> Luis Giraldo <br>Willinton Muñoz <br>Mateo Montes Loaiza<br> Universidad EAFIT <br> 2017&copy;
    </footer>
    
    <script>
        var i = 0;
        for(i = 0; i < 3; i++){
            agregarNL(i);
        }
        
        function agregarNL(i){
            $('.contenido').append('<div class="luz">'+
                    '<div class="etiquetaN">'+
                        '<h5>Luz de prueba '+i+'</h5>'+
                    '</div>'+
                    '<div class="boton">'+
                        '<input type="checkbox" id="toggle'+i+'">'+
                        '<label for="toggle'+i+'" id="L'+i+'" class="icon-lightbulb"></label>'+
                    '</div>'+
                '</div>');
            i++;
            return true;
        }
        
        $('.LogoMain').click(function(){
            window.location.href = "index.html";
        });
        
        $('.Clima').click(function(){
            window.location.href = "medicionClimatica.php";
        });
        
    </script>
    
    <script>
        $(document).ready(function(){
            var cambio = true;
            var url = "";
            $('#L0').click(function(){
                if(cambio){
                   url = "1";
                    cambio = false;
                    $('#frame').attr('src',"http://iotserver1.dis.eafit.edu.co/weather/putSwitch?idhome=wmunoze&val="+url);
                }
                else{
                    url = "0";
                    cambio = true;
                    $('#frame').attr('src',"http://iotserver1.dis.eafit.edu.co/weather/putSwitch?idhome=wmunoze&val="+url);
                }
            });
            
            $('#L1').click(function(){
                if(cambio){
                   url = "1";
                    cambio = false;
                    $('#frame').attr('src',"http://iotserver1.dis.eafit.edu.co/weather/putSwitch?idhome=ljpalaciom&val="+url);
                }
                else{
                    url = "0";
                    cambio = true;
                    $('#frame').attr('src',"http://iotserver1.dis.eafit.edu.co/weather/putSwitch?idhome=ljpalaciom&val="+url);
                }
            });
            
            $('#L2').click(function(){
                if(cambio){
                   url = "1";
                    cambio = false;
                    $('#frame').attr('src',"http://iotserver1.dis.eafit.edu.co/weather/putSwitch?idhome=legiraldoj&val="+url);
                }
                else{
                    url = "0";
                    cambio = true;
                    $('#frame').attr('src',"http://iotserver1.dis.eafit.edu.co/weather/putSwitch?idhome=legiraldoj&val="+url);
                }
            });
            
        });
    </script>
</body>
</html>