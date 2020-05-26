<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
   
    <!-- Facebook -->
   
    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <!-- Favicon -->
    
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>/assets/img/favicon.png">


    <!-- vendor css -->
  
    <link href="<?php echo base_url(); ?>/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/lib/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- DashForge CSS -->
   
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/dashforge.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/dashforge.auth.css">
  </head>
  <body>

    <header class="navbar navbar-header navbar-header-fixed">
      
    </header><!-- navbar -->

    <div class="content content-fixed content-auth">
      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
       
          <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
            <div class="wd-100p">
            <div id="passAlert" class="alert alert-danger d-flex align-items-center"  style="visibility: hidden; display:none;">
              <i data-feather="alert-circle" class="mg-r-10"></i> Email/password is incorrect!
            </div>
              <h3 class="tx-color-01 mg-b-5">Sign In</h3>
              <p class="tx-color-03 tx-16 mg-b-40">Welcome back! Please signin to continue </p>
             
              <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" placeholder="yourname@yourmail.com" id="email">
              </div>
              <div class="form-group">
                <div class="d-flex justify-content-between mg-b-5">
                  <label class="mg-b-0-f">Password</label>
                  <a href="" class="tx-13">Forgot password?</a>
                </div>
                <input type="password" class="form-control" placeholder="Enter your password" id="pass">
              </div>
              <button class="btn btn-brand-02 btn-block" onclick="signIn()">Sign In</button>
             <div class="tx-13 mg-t-20 tx-center">Don't have an account? <a href="signup">Create an Account</a></div>
            </div>
          </div><!-- sign-wrapper -->
        </div><!-- media -->
      </div><!-- container -->
    </div><!-- content -->

    <footer class="footer">
      <div>
      </div>
      <div>
        <nav class="nav">
         </nav>
      </div>
    </footer>

    <script src="<?php echo base_url(); ?>/lib/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>/lib/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="<?php echo base_url(); ?>/assets/js/dashforge.js"></script>
    <script src="assets/js/md5.min.js"></script>

    <script>
      function signIn(){
        var email = document.getElementById("email").value; 
        var pass = md5(document.getElementById("pass").value);

        $.ajax({
          url: "<?php echo base_url() ?>/signin", 
          data: {
            email: email, 
            pass: pass
          }, 
          method: "post", 
          dataType: "json", 
          success: function(res){
            if(res=="false"){
              document.getElementById("passAlert").style.visibility ="visible"; 
            }
            else{
             
             window.location.href ="<?php echo base_url()?>/"; 
              
            }
          }
        })
      }
    </script>
    <!-- append theme customizer -->
    <script src="<?php echo base_url(); ?>/lib/js-cookie/js.cookie.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/dashforge.settings.js"></script>

  </body>   
</html>
