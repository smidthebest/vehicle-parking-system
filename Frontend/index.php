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
        <div style="height: 100px">
            <form action = "/index.php" method="POST">
                <label for="auto">Put Address here: </label>
                
                <input id="auto" name="loc" style=" width: 200px" type="text">
                <button type="submit" name="submit" >Submit</button>
            </form>
                
        </div>
        <div id="mapid" style="height: 500px; width: 500px; float: left;"></div>
        
    </body>
    <?php
        if(isset($_POST['submit']))
        {
            $name = $_POST['loc'];
            
            $url = "http://localhost:8081/autoAPI.php".$name;
            
            $client = curl_init($url);
            curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
            $response = curl_exec($client);
            
            $result = json_decode($response);
            
            echo $result->data; 
        }
    ?>
    <script>
        $("#auto").autocomplete({
            source: ["hello", "how are you", "why", "apple"]
        })
         var mymap = L.map('mapid').setView([28.6139, 77.209], 8);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1Ijoic21pZGRtaXNoIiwiYSI6ImNrOTA4a2xwajAwNWozZXM1c2FnanlmNTQifQ.f53gGVXjiBqVqYXum8n8wA'
        }).addTo(mymap);

    </script>
</html>