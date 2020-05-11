

<!DOCTYPE html>
<html lang ="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin=""/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
        crossorigin=""></script>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  
    

        <style>
        .ui-autocomplete {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            float: left;
            display: block;
            min-width: 160px;
            _width: 160px;
            padding: 4px 0;
            margin: 2px 0 0 0;
            list-style: none;
            background-color: #ffffff;
            border-color: #ccc;
            border-color: rgba(0, 0, 0, 0.2);
            border-style: solid;
            border-width: 1px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -webkit-background-clip: padding-box;
            -moz-background-clip: padding;
            background-clip: padding-box;
            *border-right-width: 2px;
            *border-bottom-width: 2px;
        }

        .ui-menu-item {
        display: block;
        padding: 3px 15px;
        clear: both;
        font-weight: normal;
        line-height: 18px;
        color: #555555;
        white-space: nowrap;
        }

        .ui-state-focus, .ui-state-active {
            color: #ffffff;
            text-decoration: none;
            background-color: #0088cc;
            border-radius: 0px;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            background-image: none;
        }
        
        .actions{
        display: inline-block;
        
        }

        #button-actions{
            padding: 4vmin;
            padding-left: 0vmin
        }

        body{
            background-color: rgb(189, 233, 146)
        }

        #address-form{
            padding-top: 1vmin
        }

        #mapid {
            height:50vmax; 
            padding: 33vmin;
            z-index: 10;
            
            
        }
        
        </style>
    </head>

    <body >
    <div class="container">
            <h1>Parking Lot Central</h1>
        </div>
        <div class ="container " id="button-actions" >
            <div>
                <button class="actions" onclick="edit()">Edit</button>
                <button class="actions" onclick="setAdd()">Add</button>
                <button class="actions" onclick="del()">Delete</button>
            </div>
            
            <form>
                <div class = "input-group form-inline" id="address-form">
                    <input  class="ui-autocomplete-input form-control" placeholder="Search Address" name = "term" id="auto" type="text">
                    <div class="input-group-btn">
                         <button class="btn btn-default" type="submit" name = "submit" >
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div  class ="container" id="mapid" style="" ></div>
    </body>

    <script>
        var mymap = L.map('mapid').setView([28.6139, 77.209], 8); 
        var add = false;
        var edit = false; 
        var del = false; 

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1Ijoic21pZGRtaXNoIiwiYSI6ImNrOTA4a2xwajAwNWozZXM1c2FnanlmNTQifQ.f53gGVXjiBqVqYXum8n8wA'
        }).addTo(mymap);
        autocompleteUpdate(mymap.getCenter().lat, mymap.getCenter().lng); 
        var marker;  
        
        mymap.on("move", check); 
        mymap.on("click", addPoly);
        
        var polygon; 
        var markers = []; 

        function addPoly(e){
            if(add){
                if(polygon == null) createPoly(e); 
                addMarker(e.latlng); 
                add = false; 
            }
        }

        function addMarker(e){
            polygon.addLatLng(e).addTo(mymap); 
            var mark = L.marker(e).addTo(mymap); 
            mark.dragging.enable(); 
            mark.draggable = true; 
            mark.autoPan = true; 
            mark.setLatLng(e);  
           // mark.on("move", moveMark, this); 
           // mark.on('click', deletePoly); 
            markers.push(mark); 
            
        }

        function createPoly(e){
            if(polygon != null){
                polygon = null; 
            }
            polygon = L.polygon(e.latlng); 
           // polygon.on('click', deletePoly); 
        }

        //Whenever map is moved, the new center is updated, so that the autocomplete results
        //are biased to that specific location. 
        function check(e){
            autocompleteUpdate(mymap.getCenter().lat, mymap.getCenter().lng); 
        }
       

        //gets autocomplete results from API by sending the current term in the search box, 
        //and the current latitude and longitude of the map so that the results are biased to that location. 
        function autocompleteUpdate(lat, lng){
            if(lng < -180) lng = 360 + lng; 
            $("#auto").autocomplete({  
                source: function (request, response){
                    $.ajax({
                        url: "<?php echo base_url() ?>/maps/autocomplete/"+request.term+"/"+lat+"/"+lng,
                        dataType: 'json', 
                        
                        complete: function(data){
                            console.log(data['responseJSON']); 
                            response(data['responseJSON']); 
                        },
                        headers: {
                            "Content-type": "application/json",
                            'Access-Control-Allow-Origin': '*'
                        
                        }
                    }); 
                }
            }); 
        }

        //When user submits form, the form is cleared, and whatever they entered is sent to
        //API which returns the latitude and longitude of the location on the map, and the map 
        //is centered on that location. 
        $("form").submit(function (e){
            e.preventDefault(); 
            var loc = $("#auto").val(); 
              
            // $.getJSON("maps/geocode/"+loc, function(result){
            //     console.log(result); 
            //     if(result != null){
            //         mymap.setView(result, 18); 
            //         autocompleteUpdate(result["lat"], result["lng"]); 
            //         if(marker != null) marker.remove(); 
            //         marker = L.marker(result).addTo(mymap); 
            //         $("#auto").val("");
            //     } 
            // });

            $.ajax({
                url:" maps/geocode/"+loc,
                dataType: "json", 
                complete: function(result){
                    result = result["responseJSON"]; 
                    console.log(result); 
                    if(result != null){
                        mymap.setView(result, 18); 
                        autocompleteUpdate(result["lat"], result["lng"]); 
                        if(marker != null) marker.remove(); 
                        marker = L.marker(result).addTo(mymap); 
                        $("#auto").val("");
                    } 
                }, 
                headers: {
                    "Content-type": "application/json",
                    'Access-Control-Allow-Origin': '*'
                
                }
            }); 
        }); 

         function setAdd(){
            add = true; 
        }

        function del(){

        }

        function edit(){

        }

    </script>
</html>