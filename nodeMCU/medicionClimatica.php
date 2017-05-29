<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    
    <title>NodeMCU | Clima</title>
    
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <link href="https://file.myfontastic.com/Ri7PZxaHzGcfjUBgBZ2Twm/icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/normalizador.css">
    <link rel="stylesheet" href="css/EMedicionClimitica.css">
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
       <div class="clima">
            <div class="clima_actual">
                <div class="datos">
                    <h4>Medición de wmunoze</h4>
                    <div class="datosC">
                        <div class="datosCs">
                            <h4 class="grados g0">0°c en Medellín</h4>
                            <p class="info0">Sin clima</p>
                        </div>
                        <i class="iot f0">f</i>
                    </div>
                </div>

                <div class="barometros">
                    <div id="chart_div"></div>
                </div>
            </div>
            
            <div class="clima_actual">
                <div class="datos">
                    <h4>Medicion de ljpalaciom</h4>
                    <div class="datosC">
                        <div class="datosCs">
                            <h4 class="grados g1">0°c en Medellín</h4>
                            <p class="info1">Sin clima</p>
                        </div>
                        <i class="iot f1">h</i>
                    </div>
                </div>

                <div class="barometros">
                    <div id="chart_div1"></div>
                </div>
            </div>
            
            <div class="clima_actual">
                <div class="datos">
                    <h4>Medicion de prueba</h4>
                    <div class="datosC">
                        <div class="datosCs">
                            <h4 class="grados g2">0°c en Medellín</h4>
                            <p class="info2">Sin clima</p>
                        </div>
                        <i class="iot f2">e</i>
                    </div>
                </div>

                <div class="barometros">
                    <div id="chart_div2"></div>
                </div>
            </div>
        </div>
        
        <div class="infoMapa">
            <div class="mensaje">
                <div class="texto">
                    <h5 class="posicion">Lat: 0, Lang: 0</h5>
                    <h5 class="temperatura">Temperatura: 34°C || 72°F</h5>
                    <h5 class="humedad">Humedad: 40%</h5>
                    <h5 class="nCalor">Rojo</h5>
                </div>
            </div>
            <div id="mapa" class="mapa">

            </div>
        </div>
        
        <div class="graficas">
            <div id="datosC"></div>
        </div>
        
    </section>
        
    <footer>Luis Javier <br> Luis Giraldo <br>Willinton Muñoz <br>Mateo Montes Loaiza<br> Universidad EAFIT <br> 2017&copy;</footer>
    
    <script>
        $('.LogoMain').click(function(){
            window.location.href = "index.html";
        });
        
        $('.Luces').click(function(){
            window.location.href = "controlLuces.php";
        });
    </script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('.mensaje').fadeOut();
            $('.texto').fadeOut();
        });
    </script>
    
    <script type="text/javascript">
        var momentoActual = new Date();
        google.charts.load('current',{'packages':['gauge','corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Label', 'Value'],
                ['°F', 0],
                ['Humedad', 0]
            ]);

            var options = {
              width: 250, height: 0,
              redFrom: 82, redTo: 110,
              yellowFrom: 77, yellowTo: 82,
              minorTicks: 5,max: 100
            };

            var chart0 = new google.visualization.Gauge(document.getElementById('chart_div'));
            chart0.draw(data, options);
            
            var chart1 = new google.visualization.Gauge(document.getElementById('chart_div1'));
            chart1.draw(data, options);
            
            var chart2 = new google.visualization.Gauge(document.getElementById('chart_div2'));
            chart2.draw(data, options);
            
            
            var tiempo = 6000;
            
            var users= ["wmunoze","ljpalaciom"/*, "legiraldoj"*/];
            
            setInterval(function(){
                $.get("http://iotserver1.dis.eafit.edu.co/weather/"+users[0]+"/1",function(dataU){
                    data.setValue(0,1, ((dataU[0].temp*9)/5)+32);
                    data.setValue(1,1, dataU[0].humid);
                    $('.g0').html(dataU[0].temp+"°c en Medellín");
                    
                    var hora = momentoActual.getHours();
                    
                    if(dataU[0].temp >= 24 && dataU[0].humid <= 60){
                        
                        if(hora > 18){
                            $('.f0').html("c");
                            $('.info0').html("Noche");
                        }
                        else{
                            $('.f0').html("f");
                            $('.info0').html("Soleado");
                        }
                    }
                    
                    else if((dataU[0].temp >= 20 && dataU[0].temp <= 24)&& dataU[0].humid <= 60){
                        $('.info0').html("Nublado");
                        if(hora > 18){
                            $('.f0').html("c");
                        }
                        else{
                            $('.f0').html("i");
                        }
                    }
                    
                    else{
                        $('.info0').html("Tormenta");
                        if(hora > 18){
                            $('f0').html("e");
                        }
                        else{
                            $('.f0').html("h");
                        }
                    }
                    
                    chart0.draw(data,options);
                });
                
                $.get("http://iotserver1.dis.eafit.edu.co/weather/"+users[1]+"/1",function(dataU){
                    data.setValue(0,1, ((dataU[0].temp*9)/5)+32);
                    data.setValue(1,1, dataU[0].humid);
                    $('.g1').html(dataU[0].temp+"°c en Medellín");
                    
                    var hora = momentoActual.getHours();
                    
                    if(dataU[0].temp >= 24 && dataU[0].humid <= 60){
                        $('.info1').html("Soleado");
                        if(hora > 18){
                           $('.f1').html("g");
                        }
                        else{
                            $('.f1').html("f");
                        }
                    }
                    
                    else if((dataU[0].temp >= 20 && dataU[0].temp <= 24)&& dataU[0].humid <= 60){
                        $('.info1').html("Nublado");
                        if(hora > 18){
                            $('.f1').html("c");
                        }
                        else{
                            $('.f1').html("i");
                        }
                    }
                    
                    else{
                        $('.info1').html("Tormenta");
                        if(hora > 18){
                            $('f1').html("e");
                        }
                        else{
                            $('.f1').html("h");
                        }
                    }
                    
                    chart1.draw(data,options);
                });
            }, tiempo);
            
            var datosClima = google.visualization.arrayToDataTable([
                ['Fecha', 'Temperatura '],
                [2017,0],
            ]);
            
            var optionsC = {
                title: 'Registro de temperaturas',
                legend: {position: 'center'},
                is3D: true
                
            }
            
            var climaD = new google.visualization.LineChart(document.getElementById('datosC'));
            climaD.draw(datosClima,optionsC);
        }
    </script>
    
    <script type="text/javascript">
        var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('mapa'), {
            zoom: 12,
            center: {lat: 6.2428809, lng: -75.5628122},
            
            mapTypeId: 'hybrid',
            disableDefaultUI: true
        });

        // Create a <script> tag and set the USGS URL as the source.
        var script = document.createElement('script');

        // This example uses a local copy of the GeoJSON stored at
        // http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp
        //script.src = 'https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js';
        document.getElementsByTagName('head')[0].appendChild(script);
          
        function getCircle(color) {
            
            return{
              path: google.maps.SymbolPath.CIRCLE,
              fillColor: color,
              fillOpacity: .2,
              scale: Math.pow(2,6)/2,
              strokeColor: 'white',
              strokeWeight: .5
            }
        };
        
        $.get("http://iotserver1.dis.eafit.edu.co/weather/getAllLastWeather",function(marcadores){
            for (var i = 0; i < marcadores.length; i++) {
                var pos = new google.maps.LatLng(marcadores[i].latitude, marcadores[i].longitude);
                console.log(map.getZoom());
                var color = "";
                
                if(marcadores[i].temp > 28){
                    color = "RED";
                }
                
                else if(marcadores[i].temp > 25){
                        color = "YELLOW"
                }
                
                else if(marcadores[i].temp > 22){
                    color = "GREEN";
                }
                        
                else{
                    color = "BLUE";
                }
                
                var marcador = new google.maps.Marker({
                    position: pos,
                    icon: getCircle(color),
                    map: map,
                    title: marcadores[i].temp+'°c | '+marcadores[i].humid+'%',
                });
                
                var lat = marcadores[i].latitude;
                var lang = marcadores[i].longitude;
                var mar = marcadores[i].temp;
                var hu = marcadores[i].humid;
                
                (function(marcador,mar,hu,lat,lang,color){
                    google.maps.event.addListener(marcador, 'mouseover', function() {
                        activo = false;
                        $('.mensaje').fadeIn(800, function(){
                            $('.mensaje').css({height: 20+"%"});
                            $('.texto').fadeIn(400);
                        });
                        $('.posicion').html("Lat: "+lat+", Lng: "+lang);
                        $('.temperatura').html("Temperatura: "+mar+"°C || "+(((mar*9)/5)+32)+"°F");
                        $('.humedad').html("Humedad: "+hu+"%");
                        $('.nCalor').html("Nivel de alerta: "+color);
                        $('.nCalor').css({color: color});
                    });
                    
                    google.maps.event.addListener(marcador, 'mouseout', function(){
                        console.log("Ya sali");
                        $('.mensaje').fadeOut(50, function(){
                            $('.mensaje').css({height: 0+"%"});
                            $('.texto').fadeOut(25);
                        });
                    });
                })(marcador,mar,hu,lat,lang,color);
            }
        });
    }
      
        
      function eqfeed_callback(results) {
        map.data.addGeoJson(results);
      }
    </script>
    
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1uatwVp9CefMaZAF9scXMfDd1WNdufTM&callback=initMap" type="text/javascript"></script>
</body>
</html>