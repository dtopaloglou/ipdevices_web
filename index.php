<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbc.php');

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> <?php echo CoreConfig::settings()['appname']; ?> </title>
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
                    </div> <?php echo CoreConfig::settings()['appname']; ?>
                </h1>
            </header>
            <div class="auth-content">
                <p class="text-xs-center">LOGIN TO CONTINUE</p>
                <form id="login-form" role="form">
                    <div class="form-group"><label for="username">Username</label>
                        <input type="email" class="form-control underlined" name="username" id="username" placeholder="Your username or e-mail address" required>
                    </div>
                    <div class="form-group"><label for="password">Password</label>
                        <input type="password" class="form-control underlined" name="password" id="password" placeholder="Your password" required>
                    </div>
                    <div class="form-group"><label for="remember">
                            <input class="checkbox" id="remember" type="checkbox"> <span>Remember me</span> </label>
                        <a href="reset.php" class="forgot-btn pull-right">Forgot password?</a></div>
                    <div class="form-group">

                        <button id="login" name="login" type="submit" class="btn btn-block btn-primary">
                            Login
                        </button>
                        <br>
                        <div id="results">

                            <?php
                            $time = time();
                            // display not logged in message
                            if (isset($_GET['l']) && isset($_GET['u']) && $_GET['l'] == 0 && $time == $_GET['u'])
                            {
                                ?>

                                <div class="alert alert-danger"><p class="text-md-center">You are not logged in</p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="text-muted text-xs-center">Do not have an account? <a href="signup.php">Sign Up!</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-xs-center">



            <a href="app/setup.exe"  class="btn btn-secondary rounded btn-sm"> <i class="fa fa-cloud-download"></i>  Download .exe</a>
        </div>
    </div>
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