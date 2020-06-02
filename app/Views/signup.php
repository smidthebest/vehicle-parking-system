<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- vendor css -->
  <link href="lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- DashForge CSS -->
  <link rel="stylesheet" href="assets/css/dashforge.css">
  <link rel="stylesheet" href="assets/css/dashforge.auth.css">
  <link rel="stylesheet" href="assets/css/dashforge.dashboard.css">

</head>

<body>

  <header class="navbar navbar-header navbar-header-fixed">
    <div class="navbar-brand">
      <a class="df-logo">Parking<span>Tool</span></a>
    </div><!-- navbar-brand -->
  </header><!-- navbar -->


  <div class="content content-fixed content-auth">
    <div class="container">
      <div class="media align-items-stretch justify-content-center ht-100p">
        <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
          <div class="pd-t-20 wd-100p">
            <div id="passAlert" class="alert alert-danger d-flex align-items-center"
              style="visibility: hidden; display:none;">
              <i data-feather="alert-circle" class="mg-r-10"></i> Email already exists! Please <a href="/signin"
                class="alert-link"> sign in </a>
            </div>
            <h4 class="tx-color-01 mg-b-5">Create New Account</h4>
            <p class="tx-color-03 tx-16 mg-b-40">It's free to signup and only takes a minute.</p>


            <div class="form-group">
              <label>Email address</label>
              <input type="email" class="form-control" placeholder="Enter your email address" id="email" name="email">
            </div>
            <div class="form-group">
              <div class="d-flex justify-content-between mg-b-5">
                <label class="mg-b-0-f">Password</label>
              </div>
              <input type="password" class="form-control" placeholder="Enter your password" id="pass" name="pass">
            </div>
            <div class="form-group">
              <label>Firstname</label>
              <input type="text" class="form-control" placeholder="Enter your firstname" id="fName" name="fName">
            </div>
            <div class="form-group">
              <label>Lastname</label>
              <input type="text" class="form-control" placeholder="Enter your lastname" id="sName" name="sName">
            </div>
            <div class="form-group tx-12">
              By clicking <strong>Create an account</strong> below, you agree to our terms of service and privacy
              statement.
            </div><!-- form-group -->

            <button class="btn btn-brand-02 btn-block" onclick="createAccount()">Create Account</button>

            <div class="tx-13 mg-t-20 tx-center">Already have an account? <a href="signin">Sign In</a></div>
          </div>
        </div><!-- sign-wrapper -->

      </div><!-- media -->
    </div><!-- container -->
  </div><!-- content -->

  <footer class="footer">
    <div>
      <span>&copy; Yolo Travel Tech Pvt. Ltd. </span>
    </div>
    <div>

    </div>
  </footer>

  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/lib/feather-icons/feather.min.js"></script>
  <script src="lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

  <script src="assets/js/dashforge.js"></script>
  <script src="assets/js/md5.min.js"></script>

  <script>
    function createAccount() {
      var name = document.getElementById("email").value;
      var pass = md5(document.getElementById("pass").value);
      var fName = document.getElementById("fName").value;
      var sName = document.getElementById("sName").value;

      $.ajax({
        url: "<?php echo base_url() ?>/up",
        data: {
          email: name,
          pass: pass,
          fname: fName,
          sname: sName
        },
        method: "post",
        success: function (res) {

          if (res == "true") {

            window.location.href = "<?php echo base_url()?>/";

          }
          else document.getElementById("passAlert").style.visibility = "visible";
        }

      })

    }
  </script>

  <!-- append theme customizer -->
  <script src="lib/js-cookie/js.cookie.js"></script>
  <script src="assets/js/dashforge.settings.js"></script>
</body>

</html>