

<!DOCTYPE html>
<html>
    <head>
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
            integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
            crossorigin=""/>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

            <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
            integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
            crossorigin=""></script>
           <script src="//code.jquery.com/jquery-1.12.4.js"></script>
            <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
    </head>
    <body>
        <div style="height: 300px">
            <form method="POST">
                <label for="auto">Put Address here: </label>
                
                <input  name = "term" id="auto"style=" width: 200px" type="text">
                <button type="submit" name = "submit"  >Submit</button>
            </form>
                
        </div>
        <div id="mapid" style="height: 500px; width: 500px; float: left;"></div>
        
    </body>
    
    <script>
    
        
        var mymap; 
       console.log(performance.navigation.type)
        if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
            console.info( "This page is reloaded" );
        } else {
                mymap = L.map('mapid').setView([28.6139, 77.209], 8); 
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1Ijoic21pZGRtaXNoIiwiYSI6ImNrOTA4a2xwajAwNWozZXM1c2FnanlmNTQifQ.f53gGVXjiBqVqYXum8n8wA'
            }).addTo(mymap);
        }
      
            var lat = mymap.getCenter().lat; 
        var long = mymap.getCenter().lng; 
       
        $("#auto").autocomplete({  
            source: "autoAPI.php?lat="+lat+"&long="+long  
        })

        $("form").submit(function (e){
            e.preventDefault(); 
            var loc = $("#auto").val(); 
             
            $.getJSON("geocodeAPI.php?address=" + loc, function(result){
                if(result != null) mymap.setView(result, 12); 
            });
        }); 

    </script>
</html>