<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbc.php');
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> <?php echo CoreConfig::settings()['appname']; ?> :: Sign Up </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="css/vendor.css">
    <!-- Theme initialization -->
    <script>
        var themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
        {};
        var themeName = themeSettings.themeName || '';
        if (themeName)
        {
            document.write('<link rel="stylesheet" id="theme-style" href="css/app-' + themeName + '.css">');
        }
        else
        {
            document.write('<link rel="stylesheet" id="theme-style" href="css/app.css">');
        }
    </script>
</head>

<body>
<div class="auth">
    <div class="auth-container">
        <div class="card">
            <header class="auth-header">
                <h1 class="auth-title">
                    <div class="logo">
                        <span class="l l1"></span> <span class="l l2"></span> <span class="l l3"></span>
                        <span class="l l4"></span> <span class="l l5"></span> <span class="l l6"></span>
                    </div><?php echo CoreConfig::settings()['appname']; ?>
                </h1>
            </header>
            <div class="auth-content">
                <p class="text-xs-center">SIGNUP TO GET INSTANT ACCESS</p>
                <form id="signup-form">
                    <div class="form-group"><label for="firstname">Name</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control underlined" name="firstname" id="firstname" placeholder="Enter firstname" required="">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control underlined" name="lastname" id="lastname" placeholder="Enter lastname" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><label for="email">Email</label>
                        <input type="email" class="form-control underlined" name="email" id="email" placeholder="Enter email address" required="">
                    </div>
                    <div class="form-group"><label for="email">Username</label>
                        <input type="text" class="form-control underlined" name="username" id="username" placeholder="Enter username" required="">
                    </div>

                    <div class="form-group"><label for="password">Password</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="password" class="form-control underlined" name="password" id="password" placeholder="Enter password" required="">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control underlined" name="cPassword" id="cPassword" placeholder="Re-type password" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><label for="agree">
                            <input class="checkbox" name="agree" id="agree" type="checkbox" required=""> <span>Agree the terms and <a href="#">policy</a></span>
                            <span id="agree-text"></span> </label></div>
                    <div class="form-group">
                        <button type="submit" id="SignUp" class="btn btn-block btn-primary">Sign Up</button>
                    </div>
                    <div id="results"></div>
                    <div class="form-group">
                        <p class="text-muted text-xs-center">Already have an account? <a href="index.php">Login!</a></p>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-xs-center">



            <a href="app/setup.exe"  class="btn btn-secondary rounded btn-sm"> <i class="fa fa-cloud-download"></i>  Download .exe</a>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-success">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><i class="fa fa-check"></i> Success!</h4></div>
            <div class="modal-body">
                <p>
                <div id="signup-success-msg"></div>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- Reference block for JS -->
<div class="ref" id="ref">
    <div class="color-primary"></div>
    <div class="chart">
        <div class="color-primary"></div>
        <div class="color-secondary"></div>
    </div>
</div>
<script src="js/vendor.js"></script>
<script src="js/app.js"></script>
<script>
    $(function ()
    {
        $('#modal-media').modal("toggle");

    })
</script>
</body>

</html>