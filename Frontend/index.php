

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
        <div style="height: 200px">
            <form method="POST">
                <label for="auto">Put Address here: </label>
                
                <input  class="ui-autocomplete-input" name = "term" id="auto"style=" width: 200px" type="text">
                <button type="submit" name = "submit"  >Submit</button>
            </form>
                
        </div>
        <div id="mapid" style="height: 500px; width: 500px; float: left;"></div>
        
    </body>
    
    <script>
    
       
        var mymap = L.map('mapid').setView([28.6139, 77.209], 8); 
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1Ijoic21pZGRtaXNoIiwiYSI6ImNrOTA4a2xwajAwNWozZXM1c2FnanlmNTQifQ.f53gGVXjiBqVqYXum8n8wA'
        }).addTo(mymap);
        autocompleteUpdate(mymap.getCenter().lat, mymap.getCenter().lng); 

        mymap.on("move", check); 

        //Whenever map is moved, the new center is updated, so that the autocomplete results
        //are biased to that specific location. 
        function check(e){
            autocompleteUpdate(mymap.getCenter().lat, mymap.getCenter().lng); 
        }
       

        //gets autocomplete results from API by sending the current term in the search box, 
        //and the current latitude and longitude of the map so that the results are biased to that location. 
        function autocompleteUpdate(lat, lng){
            console.log(lat + " " + lng); 
            if(lng < -180) lng = 360 + lng; 
            $("#auto").autocomplete({  
                source: "autoAPI.php?lat="+lat+"&long="+lng  
            }); 

        }

        //When user submits form, the form is cleared, and whatever they entered is sent to
        //API which returns the latitude and longitude of the location on the map, and the map 
        //is centered on that location. 
        $("form").submit(function (e){
            e.preventDefault(); 
            var loc = $("#auto").val(); 
             $("#auto").val(""); 
            $.getJSON("geocodeAPI.php?address=" + loc, function(result){
                if(result != null){
                    mymap.setView(result, 15); 
                    autocompleteUpdate(result["lat"], result["lng"]); 
                } 
            });
        }); 

    </script>
</html>