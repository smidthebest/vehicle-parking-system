<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
        crossorigin=""></script>
    <script src="Path.Drag.js"></script>
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>

    <link href="lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="assets/css/dashforge.css">
    <link rel="stylesheet" href="assets/css/dashforge.auth.css">

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

        .ui-state-focus,
        .ui-state-active {
            color: #ffffff;
            text-decoration: none;
            background-color: #0088cc;
            border-radius: 0px;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            background-image: none;
        }

        .actions {
            border: 1px solid grey;

        }

        #address-form {
            padding-top: 1vmin
        }

        #mapid {
            height: 35vmax;
            padding: 0;
            z-index: 10;
        }
        .modal-backdrop
{
    opacity:0.0 !important;
}
    </style>
</head>

<body style="margin-bottom: 60px;">

    <header class="navbar navbar-header navbar-header-fixed">
        <a id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
        <div class="navbar-brand">
            <a class="df-logo">Parking<span>Tool</span></a>
        </div><!-- navbar-brand -->
        <div id="navbarMenu" class="navbar-menu-wrapper">
            <div class="navbar-menu-header">
                <a class="df-logo">Parking<span>Tool</span></a>
                <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
            </div><!-- navbar-menu-header -->
            <ul class="nav navbar-menu">
                <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">Main Navigation</li>
                <li class="nav-item with-sub ">
                    <a href="" class="nav-link"><i data-feather="pie-chart"></i> File</a>
                    <ul class="navbar-menu-sub">
                        <li class="nav-sub-item"><a class="nav-sub-link"><i data-feather="save"></i>Save</a></li>
                        <li class="nav-sub-item"><a class="nav-sub-link"><i data-feather="delete"></i>Delete</a></li>
                        <li class="nav-sub-item"><a class="nav-sub-link"><i data-feather="book-open"></i>Open</a></li>
                        <li class="nav-sub-item"><a type="button" class="nav-sub-link" data-toggle="modal" data-target="#exampleModal"><i data-feather="x-circle"></i>Clear</a></li>
                        

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </li>
            </ul>
        </div><!-- navbar-menu-wrapper -->
        <div class="navbar-right">
            <div class="dropdown dropdown-profile">
                <a href="" class="dropdown-link" data-toggle="dropdown" data-display="static">
                    <div class="avatar avatar-sm">
                        <div class="avatar-initial rounded-circle" alt=""><?php 
                            $f1 = substr($_SESSION["fName"], 0, 1); 
                            $f2 = substr($_SESSION["sName"], 0, 1); 
                            echo $f1.$f2
                            
                        ?></div>
                </a><!-- dropdown-link -->
                <div class="dropdown-menu dropdown-menu-right tx-13">
                    <div class="avatar avatar-lg mg-b-15">
                        <div class=" avatar-initial rounded-circle" alt=""><?php 
                            $f1 = substr($_SESSION["fName"], 0, 1); 
                            $f2 = substr($_SESSION["sName"], 0, 1); 
                            echo $f1.$f2
                            
                        ?></div>
                    </div>
                    <h6 class="tx-semibold mg-b-5"><?php echo $_SESSION["fName"]." ".$_SESSION["sName"]; ?></h6>
                    <a href="" class="dropdown-item"><i data-feather="settings"></i>Account Settings</a>
                    <a onclick="logout()" class="dropdown-item"><i data-feather="log-out"></i>Sign Out</a>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </div><!-- navbar-right -->

    </header><!-- navbar -->
    <main class="container" style="padding: 2vmin">
        <div class="container mt-5">

            <div style="display: inline" class="col-1-6" id="button-actions">

            </div>
        </div>
        <form style="padding-bottom: 2vmin" class="container">
            <div class="input-group " id="address-form">
                <input class="ui-autocomplete-input form-control" placeholder="Search Address" name="term" id="auto"
                    type="text">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="container" id="mapid" style=""></div>
    </main>

    <footer class="footer">
        <div>
            <span>&copy; Yolo Travel Tech Pvt. Ltd. </span>
        </div>
        <div>

        </div>
    </footer>



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

        function addPoly(e) {
            if (add) {
                if (polygon == null) createPoly(e);
                addMarker(e.latlng);
                add = false;
            }
        }

        function addMarker(e) {
            var mark = L.marker(e).addTo(mymap);
            mark.dragging.enable();
            mark.draggable = true;
            mark.autoPan = true;
            mark.setLatLng(e);
            mark.on("move", moveMark, this);
            //  mark.on('click', deletePoly); 
            mark.bindPopup("<button id=\"delete\" onclick=\"deletePoly(" + mark._leaflet_id + ")\">Delete</button>");
            markers.push(mark);
        }

        function moveMark(e) {
            var lats = [];
            for (var i = 0; i < markers.length; i++) {
                if (markers[i] == e.target) {
                    lats.push(e.latlng);
                    markers[i].bindPopup("<button id=\"delete\" onclick=\"deletePoly(" + e.target._leaflet_id + ")\">Delete</button>");
                }
                else lats.push(markers[i].getLatLng());
            }
            createPoly(lats);
        }

        function createPoly(e) {
            if (e.latlng != null) e = e.latlng;
            if (polygon != null) {
                polygon.remove();
            }

            polygon = L.polygon(e, { dragging: true }).addTo(mymap);
            polygon.dragging.enable();
            polygon.on('drag', tempMove);
            polygon.bindPopup("<button onclick=\"save()\">save</button>")
            // polygon.on('click', deletePoly); 
        }


        function tempMove(e) {
            dragPoly(e);
            //  moveMark(markers[0]); 
        }
        //moves markers to new location of polygon. 
        function dragPoly(e) {
            var lats = e.target.getLatLngs()[0];

            for (var i = 0; i < lats.length; i++) {
                markers[i].remove();
                // markers[i].setLatLng(lats[i]); 
                markers[i].addTo(mymap);
            }

        }

        //Deletes the targeted component
        //if polygon is clicked then it is removed from map, markers removed from map.
        //and refrences are delted. 
        //if marker is deleted, polygon is reshaped. 
        function deletePoly(e) {

            if (polygon == null) {
                for (var i = 0; i < markers.length; i++) {
                    if (markers[i] != null) markers[i].remove();
                }
                markers = [];
                return;
            }
            var lats = [];
            var rem = -1;
            for (var i = 0; i < markers.length; i++) {
                if (markers[i]._leaflet_id == e) {

                    markers[i].remove();
                    rem = i;


                }
                else lats.push(markers[i].getLatLng());

            }
            markers.splice(rem, 1);

            if (markers.length == 0) {
                polygon.remove();
                polygon = null;
            }
            else createPoly(lats);

        }

        //Whenever map is moved, the new center is updated, so that the autocomplete results
        //are biased to that specific location. 
        function check(e) {
            autocompleteUpdate(mymap.getCenter().lat, mymap.getCenter().lng);
        }


        //gets autocomplete results from API by sending the current term in the search box, 
        //and the current latitude and longitude of the map so that the results are biased to that location. 
        function autocompleteUpdate(lat, lng) {
            if (lng < -180) lng = 360 + lng;
            $("#auto").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "<?php echo base_url() ?>/maps/autocomplete/" + request.term + "/" + lat + "/" + lng,
                        method: "post",
                        dataType: 'json',

                        success: function (data) {
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
        $("form").submit(function (e) {
            e.preventDefault();
            var loc = $("#auto").val();

            $.ajax({
                url: " maps/geocode/" + loc,
                dataType: "json",
                success: function (result) {
                    if (result != null) {
                        mymap.setView(result, 18);
                        var lat = result["lat"];
                        var lng = result["lng"];
                        autocompleteUpdate(result["lat"], result["lng"]);
                        if (marker != null) marker.remove();
                        if (polygon != null) polygon.remove();
                        for (var i = 0; i < markers.length; i++) {
                            markers[i].remove();
                        }
                        polygon = null;
                        markers = [];
                        // createPoly([[lat+.0005, lng]]); 
                        addMarker([lat + .0005, lng]);
                        addMarker([lat + .0005, lng - .0005]);
                        addMarker([lat, lng - .0005]);
                        addMarker([lat - .0005, lng - .0005]);
                        addMarker([lat - .0005, lng]);
                        addMarker([lat - .0005, lng + .0005]);
                        addMarker([lat, lng + .0005]);
                        addMarker([lat + .0005, lng + .0005]);
                        createPoly([[lat + .0005, lng], [lat + .0005, lng - .0005], [lat, lng - .0005], [lat - .0005, lng - .0005], [lat - .0005, lng], [lat - .0005, lng + .0005], [lat, lng + .0005], [lat + .0005, lng + .0005]])
                        $("#auto").val("");
                    }
                },
                headers: {
                    "Content-type": "application/json",
                    'Access-Control-Allow-Origin': '*'

                }
            });
        });

        function setAdd() {
            add = true;
            document.getElementById("save").style.display = "inline-block";
            document.getElementById("delete").style.display = "inline-block";

        }

        function save() {

            var latslngs = [];
            for (var i = 0; i < markers.length; i++) {
                latslngs[i] = [markers[i].getLatLng().lat, markers[i].getLatLng().lng];
            }

            $.ajax({
                url: "<?php echo base_url() ?>/saveFence",
                data: {
                    polygon: latslngs
                },
                method: "post",
                dataType: "json",
                success: function (result) {
                }
            })
        }

        function logout() {

            //location.reload(true); 
            window.location.href = "<?php echo base_url() ?>/signin"
        }

    </script>

    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="/lib/feather-icons/feather.min.js"></script>
    <script src="lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="assets/js/dashforge.js"></script>
    <script src="assets/js/md5.min.js"></script>
</body>

</html>