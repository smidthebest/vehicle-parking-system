

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
        <script src="/maps/pathdrag"></script>
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
            height:35vmax; 
            padding: 33vmin;
            z-index: 10;
            
            
        }
        
        </style>
    </head>

    <body>
        <header>
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                    <a class="navbar-brand">Parking Tool</a>
                </nav>
            </div>
        </header>
        <main>
            <div class ="container " id="button-actions">
                <div>
                    <button class="actions" onclick="setAdd()">Add</button>
                    <button id="delete" class="actions" style="display:none" onclick="setDel()">Delete</button>
                    <button id="save" class="actions" style="display:none" onclick="save()">Save</button>
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
            <div class ="container" id="mapid" style=""></div>
        </main>
        <footer>
            <div class="container">
                <span>Copyright YOLO Bus</span> 
            </div>
        </footer>
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
        var finishPolys = []; 

        function addPoly(e){
            if(add){
                if(polygon == null) createPoly(e); 
                addMarker(e.latlng); 
                add = false; 
            }
        }

        function addMarker(e){
            polygon.addLatLng(e); 
            var mark = L.marker(e).addTo(mymap); 
            mark.dragging.enable(); 
            mark.draggable = true; 
            mark.autoPan = true; 
            mark.setLatLng(e);  
            mark.on("move", moveMark, this); 
            mark.on('click', deletePoly); 
            markers.push(mark); 
            
        }

        function moveMark(e){
            var lats =[]; 
            for(var i = 0; i<markers.length; i++){
                if(markers[i] == e.target){
                    lats.push(e.latlng); 
                }
                else lats.push(markers[i].getLatLng()); 
            }
             createPoly(lats); 
        }

        function createPoly(e){
            if(e.latlng != null) e = e.latlng; 
            if(polygon != null){
                polygon.remove(); 
            }

            polygon = L.polygon(e, {dragging: true}).addTo(mymap); 
            polygon.dragging.enable(); 
            polygon.on('drag', dragPoly); 
            polygon.on('click', deletePoly); 
        }

         //moves markers to new location of polygon. 
         function dragPoly(e){
            var lats = e.target.getLatLngs()[0]; 
            for(var i = 0; i<lats.length; i++){
               markers[i].remove(); 
               markers[i].latlng = lats[i]; 
               markers[i].addTo(mymap); 
            }
            
            
        }

            //Deletes the targeted component
        //if polygon is clicked then it is removed from map, markers removed from map.
        //and refrences are delted. 
        //if marker is deleted, polygon is reshaped. 
        function deletePoly(e){
            if(polygon == null) return; 
            
            if(del){
                if(e.target == polygon){
                    polygon.remove();
                    polygon = null; 
                    document.getElementById("save").style.display = "none"; 
                    document.getElementById("delete").style.display = "none"; 
                    for(var i = markers.length - 1; i>=0; i--){
                        markers[i].remove(); 
                    }
                    markers = []; 
                }
                else {
                    var lats = [];
                    var rem = -1; 
                    for(var i = 0; i<markers.length; i++){
                        if(markers[i] == e.target){
                           
                            markers[i].remove(); 
                            rem = i; 
                        }
                        else lats.push(markers[i].getLatLng()); 
                        
                    }
                    markers.splice(rem, 1); 
                    if(markers.length == 0) {
                        polygon.remove(); 
                        polygon = null; 
                        document.getElementById("save").style.display = "none"; 
                    }
                    else createPoly(lats); 
                }
                
                del = false; 
            }
                    
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
                        
                        success: function(data){
                            response(data); 
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
              
            $.ajax({
                url:" maps/geocode/"+loc,
                dataType: "json", 
                success: function(result){
                    
                   
                    if(result != null){
                        mymap.setView(result, 18); 
                        autocompleteUpdate(result["lat"], result["lng"]); 
                        if(marker != null) marker.remove(); 
                       // marker = L.marker(result).addTo(mymap); 
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
            document.getElementById("save").style.display = "inline-block"; 
            document.getElementById("delete").style.display = "inline-block"; 
            
        }

        function save(){
            if(polygon == null) {
                return; 
            }

            polygon.bindPopup('This is polygon ' + (finishPolys.length +1)); 
            polygon.fill = true; 
            polygon.fillColor = '#ff0000' ; 
            polygon.off("click"); 
            polygon.off("drag"); 
            polygon.on("click", setFocus); 
            polygon.dragging.disable(); 

            polygon.addTo(mymap); 
           
            var check = true; 
            for(var i = 0; i<finishPolys.length; i++){
                if(finishPolys[i][0] == polygon){
                    check = false;
                    break; 
                }
            }
            if(check) finishPolys.push([polygon, markers]); 
            for(var i = 0; i<markers.length; i++){
               
                markers[i].dragging.disable(); 
               
            }

            polygon = null; 
            markers = []; 
            document.getElementById("save").style.display = "none"; 
            document.getElementById("delete").style.display = "none"; 
        }

        function setFocus(e){
            console.log(finishPolys);
            for(var i = 0; i<finishPolys.length; i++){
                if(finishPolys[i][0] == e.target){
                    console.log(i); 
                    save(); 
                    polygon = finishPolys[i][0]; 
                    markers = finishPolys[i][1]; 
                    polygon.dragging.enable(); 
                    polygon.on('drag', dragPoly); 
                    polygon.on('click', deletePoly);
                    for(var i = 0; i<markers.length; i++){
                        markers[i].dragging.enable(); 
                        markers[i].on("move", moveMark, this); 
                        markers[i].on('click', deletePoly); 
                    }
                    document.getElementById("save").style.display = "inline-block"; 
                    document.getElementById("delete").style.display = "inline-block"; 
                    finishPolys.splice(i, 1); 
                    return; 
                }
                
            }
        }

        function setDel(){
            del = true; 
        }

    </script>
</html>