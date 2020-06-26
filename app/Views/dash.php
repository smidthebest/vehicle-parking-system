<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- vendor css -->
    <link href="../../lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../../lib/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="../../assets/css/dashforge.css">
    <link rel="stylesheet" href="../../assets/css/dashforge.dashboard.css">
  </head>
  <body class="page-profile">

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
				
                <li class="nav-item">
                    <a href="/dashboard" class ="nav-link">Dashboard</a>
                </li>
                <li class="nav-item with-sub ">
					<a  class="nav-link"><i data-feather="file"></i> Map</a>
					<ul class="navbar-menu-sub">
						<li class="nav-sub-item"><a href="<?php echo base_url()?>/" type="button" class="nav-sub-link" ><i data-feather="plus-circle"></i>New</a></li>
						<li class="nav-sub-item"><a type="button" data-toggle="modal" data-target="#exampleModal"
							class="nav-sub-link"><i data-feather="book-open"></i>Open</a></li>
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

    <div class="content content-fixed">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Parking Tool</a></li>
                <li class="breadcrumb-item active" aria-current="page">GeoFences Dashboard</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">GeoFences Dashboard</h4>
          </div>
          <div class="d-none d-md-block">
            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-l-5"><i data-feather="download" class="wd-10 mg-r-5"></i> Load</button>
            <a href="<?php echo base_url()?>/" class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5" ><i data-feather="plus-circle" class="wd-10 mg-r-5"></i> New</a>
          </div>
        </div>

        <div class="card">
              <div class="card-header">
                <h6 class="mg-b-0">Number of polygons</h6>
              </div><!-- card-header -->
              <div class="card-body tx-center">
                <h4 class="tx-normal tx-rubik tx-40 tx-spacing--1 mg-b-0"><?php echo count($_SESSION["polys"])?></h4>
                <p class="tx-12 tx-uppercase tx-semibold tx-spacing-1 tx-color-02">Organic Search</p>
                <p class="tx-12 tx-color-03 mg-b-0">Measures your user's sources that generate traffic metrics to your website for this month.</p>
              </div><!-- card-body -->
            </div><!-- card -->
      </div><!-- container -->
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
									    echo "<a  type=\"button\" href=\"".base_url()."/trans/".($num)."\"> ".$_SESSION["names"][$num-1]." last edited at ".$_SESSION["dates"][$num-1]."</a><br>"; 
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
    </div><!-- content -->



    <footer class="footer">
			<div>
				<span>&copy; Yolo Travel Tech Pvt. Ltd. </span>
			</div>
			<div>
			</div>
		</footer>

    <script src="../../lib/jquery/jquery.min.js"></script>
    <script src="../../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../lib/feather-icons/feather.min.js"></script>
    <script src="../../lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../../lib/chart.js/Chart.bundle.min.js"></script>
    <script src="../../lib/jquery.flot/jquery.flot.js"></script>
    <script src="../../lib/jquery.flot/jquery.flot.stack.js"></script>
    <script src="../../lib/jquery.flot/jquery.flot.resize.js"></script>

    <script src="../../assets/js/dashforge.js"></script>
    <script src="../../assets/js/dashforge.sampledata.js"></script>

    <!-- append theme customizer -->
    <script src="../../lib/js-cookie/js.cookie.js"></script>
    <script src="../../assets/js/dashforge.settings.js"></script>

    <script>
  
    </script>
  </body>
</html>
