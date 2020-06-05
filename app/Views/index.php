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
			.modal-backdrop {
			opacity: 0.0 !important;
			}
		</style>
	</head>
	<body style="margin-bottom: 60px;">
		<header class="navbar navbar-header navbar-header-fixed">
			<a id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
			<div class="navbar-brand">
				<a class="df-logo">Parking<span>Tool</span></a>
			</div>
			<!-- navbar-brand -->
			<div id="navbarMenu" class="navbar-menu-wrapper">
			<div class="navbar-menu-header">
				<a class="df-logo">Parking<span>Tool</span></a>
				<a id="mainMenuClose" href=""><i data-feather="x"></i></a>
			</div>
			<!-- navbar-menu-header -->
			<ul class="nav navbar-menu">
				<li class="nav-item with-sub ">
					<a href="" class="nav-link"><i data-feather="file"></i> File</a>
					<ul class="navbar-menu-sub">
						<li class="nav-sub-item"><a type="button" class="nav-sub-link" data-toggle="modal"
							data-target="#modal2"><i data-feather="save"></i>Save</a></li>
						<li class="nav-sub-item"><a class="nav-sub-link"><i data-feather="delete"></i>Delete</a></li>
						<li class="nav-sub-item"><a type="button" data-toggle="modal" data-target="#exampleModal"
							class="nav-sub-link"><i data-feather="book-open"></i>Open</a></li>
						<li class="nav-sub-item"><a class="nav-sub-link" type = "button" onclick="compClear()"><i data-feather="x-circle"></i>Clear</a></li>
					</ul>
				</li>
			</ul>
			<div class="navbar-right">
			<a id="navbarSearch" href="" class="search-link"><i data-feather="search"></i></a>
			<div class="dropdown dropdown-profile">
				<a href="" class="dropdown-link" data-toggle="dropdown" data-display="static">
					<div class="avatar avatar-sm">
						<div class="avatar-initial rounded-circle" alt=""><?php 
							$f1 = substr($_SESSION["fName"], 0, 1); 
							$f2 = substr($_SESSION["sName"], 0, 1); 
							echo $f1.$f2
							
							?></div>
				</a>
				<!-- dropdown-link -->
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
				<a href ="/signin" type="button" onclick="logout()" class="dropdown-item"><i data-feather="log-out"></i>Sign Out</a>
				</div><!-- dropdown-menu -->
				</div><!-- dropdown -->
			</div>
			<!-- navbar-right -->
			<div class="navbar-search">
				<div class="navbar-search-header">
					<input type="search" class="form-control" placeholder="Type and hit enter to search...">
					<button class="btn"><i data-feather="search"></i></button>
					<a id="navbarSearchClose" href="" class="link-03 mg-l-5 mg-lg-l-10"><i data-feather="x"></i></a>
				</div>
				<!-- navbar-search-header -->
				<div class="navbar-search-body">
					<label
						class="tx-10 tx-medium tx-uppercase tx-spacing-1 tx-color-03 mg-b-10 d-flex align-items-center">Recent
					Searches</label>
					<ul class="list-unstyled">
						<li><a href="dashboard-one.html">modern dashboard</a></li>
						<li><a href="app-calendar.html">calendar app</a></li>
						<li><a href="../../collections/modal.html">modal examples</a></li>
						<li><a href="../../components/el-avatar.html">avatar</a></li>
					</ul>
				</div>
				<!-- navbar-search-body -->
			</div>
			<!-- navbar-search -->
		</header>
		<!-- navbar -->
		<main class="container" style="padding: 2vmin">
			<div class="container mt-5">
				<div style="display: inline" class="col-1-6" id="button-actions">
				</div>
			</div>
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
				aria-hidden="true">
				<div class="modal-dialog  modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Saved Polygons</h5>
						</div>
						<div class="modal-body">
							<?php 
								$num = 1; 
								foreach($_SESSION["polys"] as $row) {
								
								    echo "<a  data-dismiss=\"modal\" type=\"button\" onclick = openPoly(".$num.")> ".$_SESSION["names"][$num-1]." last edited at ".$_SESSION["dates"][$num-1]."</a><br>"; 
								    $num = $num+1; 
								}
								    ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
				aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content tx-14">
						<div class="modal-header">
							<h6 class="modal-title" id="exampleModalLabel2">New Polygon</h6>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="first" data-parsley-validate>
								<div class="">
									<div class="form-group">
										<label>Name: <span class="tx-danger">*</span></label>
										<input id="name" type="text" name="firstname" class="form-control " placeholder="Name" required>
										<label>Description: <span class="tx-danger">*</span></label>
										<textarea id = "descrip"type="text" name="lastname" class="form-control" placeholder="Description..." required></textarea>
										<input id="tags" type="text" class="form-control" placeholder="tags" data-role="tagsinput">
									</div>
									<!-- d-flex -->
									<button type="submit"  class="btn btn-primary pd-x-20">Validate Form</button>
								</div>
							</form>
						</div>
						<!-- <div class="modal-footer">
							<button type="button" class="btn btn-primary tx-13" onclick="save()">Save changes</button>
							</div> -->
					</div>
				</div>
			</div>
			<form id ="temp" style="padding-bottom: 2vmin" class="container">
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
		<script src="lib/parsleyjs/parsley.min.js"></script>
		<script>
			var mymap = L.map('mapid').setView([28.6139, 77.209], 8);
			var add = false;
			var del = false;
			var id = -1;
			
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
			    polygon.bindPopup("<button data-toggle=\"modal\" data-target=\"#modal2\" >save</button>")
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
			$("#temp").submit(function (e) {
			    e.preventDefault();
			    var loc = $("#auto").val();
                $("#name").val(""); 
			    $("#descrip").val(""); 
			    $("#tags").val(""); 
                id = -1; 
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
			                clear();
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
			                moveMark(markers[0]);
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
			
			window.Parsley.on('form:success', function(){
			    $('#modal2').modal('toggle');
			   save(); 
			})

            $("#first").submit(function(e) {
                e.preventDefault(); 
            })
			function save() {
			    var latslngs = [];
			    for (var i = 0; i < markers.length; i++) {
			        latslngs[i] = [markers[i].getLatLng().lat, markers[i].getLatLng().lng];
			    }
			    ids = []; 
			    var name = $("#name").val(); 
			    var descrip = $("#descrip").val(); 
			    var tags = $("#tags").val(); 
			    $("#name").val(""); 
			    $("#descrip").val(""); 
			    $("#tags").val(""); 
			    console.log(id); 
			    <?php 
				foreach($_SESSION["ids"] as $row){
				    ?>
			            ids.push(<?php echo $row ?>); 
			            <?php
				}
				?>
			        $.ajax({
			            url: "<?php echo base_url() ?>/saveFence",
			            data: {
			                polygon: latslngs,
			                id: id == -1 ? -1 : ids[id],
			                name: name, 
			                descrip: descrip, 
			                tags: tags
			            },
			            method: "post",
			            dataType: "json",
			            success: function (result) {
			                console.log(result);
			            }
			        })
			    clear();
			    id = -1;
			    location.reload(true); 
			}
			
			
			function openPoly(num) {
			    id = num - 1;
			    edit = true;
			    polys = []; 
			    names = []; 
			    descrips = []; 
			    <?php 
				$num = 0; 
				foreach($_SESSION["polys"] as $row) { ?>
			        temp =[];           
			       <?php 
				foreach($row as $lat){
				     $temp = explode(" ", $lat);
				     ?>
			                temp.push([<?php echo $temp[0].",", $temp[1] ?>]);                    
			        <?php } ?>
			            polys.push(temp);  
			            names.push("<?php echo $_SESSION["names"][$num]?>"); 
			            descrips.push("<?php echo $_SESSION["des"][$num] ?>")
			            
			    <?php $num = $num +1;  } ?>
			    
			    $("#name").val(names[id]); 
			    $("#descrip").val(descrips[id]); 
			    //clear(); 
			    if (polygon != null) polygon.remove();
			    for (var i = 0; i < markers.length; i++) {
			        markers[i].remove();
			    }
			    markers = [];
			    polygon = null;
			
			    for (var i = 0; i < polys[num - 1].length; i++) {
			        addMarker(polys[num - 1][i]);
			    }
			    createPoly(polys[num - 1]);
			    moveMark(markers[0]);
			    console.log(polys[num - 1]);
			    mymap.setView(polys[num - 1][0], 17);
			}
			
			function clear() {
			    console.log(); 
			    if (polygon != null) polygon.remove();
			    for (var i = 0; i < markers.length; i++) {
			        markers[i].remove();
			    }
			    markers = [];
			    polygon = null;
			}
			
			function compClear(){
			    clear(); 
			}
			
		</script>
		<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
		<script src="/lib/feather-icons/feather.min.js"></script>
		<script src="lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="assets/js/dashforge.js"></script>
		<script src="assets/js/md5.min.js"></script>
	</body>
</html>