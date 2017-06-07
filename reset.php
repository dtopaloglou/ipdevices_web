<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbc.php');
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> <?php echo CoreConfig::settings()['appname']; ?> :: Password Recovery </title>
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
                        <span class="l l1"></span>
                        <span class="l l2"></span>
                        <span class="l l3"></span>
                        <span class="l l4"></span>
                        <span class="l l5"></span>
                        <span class="l l6"></span>
                    </div>        <?php echo CoreConfig::settings()['appname']; ?>
                </h1> </header>
            <div class="auth-content">
                <p class="text-xs-center">PASSWORD RECOVER</p>
                <p class="text-muted text-xs-center"><small>Enter your email address to recover your password.</small></p>
                <form id="reset-form">
                    <div class="form-group"> <label for="email1">Email</label> <input type="email" class="form-control underlined" name="email1" id="email1" placeholder="Your email address" required> </div>

                    <div id="results"></div>
                    <div class="form-group"> <button id="Reset" type="submit" class="btn btn-block btn-primary">Reset</button> </div>
                    <div class="form-group clearfix"> <a class="pull-left" href="index.php">return to Login</a> <a class="pull-right" href="signup.php">Sign Up!</a> </div>
                </form>
            </div>
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
                <h4 class="modal-title"><i class="fa fa-check"></i>Success!</h4></div>
            <div class="modal-body">
                <p>
                <div id="reset-success-msg"></div>

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
</body>

</html>