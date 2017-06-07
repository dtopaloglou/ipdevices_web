<?PHP
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbc.php');
//check if user is logged in
WebUser::isLoggedIn(true);


$pdo = Registry::getConnection();
$query = $pdo->prepare("SELECT
  (SELECT COUNT(*) FROM device WHERE uid=:uid) AS DEVICES,
  (SELECT COUNT(*) FROM (SELECT DISTINCT p.IP, p.did FROM ip p) AS DISTINCTS LEFT JOIN device d ON d.did = DISTINCTS.did LEFT JOIN client c ON d.uid = c.uid ) AS DISTINCT_IPS");
$query->bindValue(":uid", $_SESSION['uid']);
$query->execute();
$stats = $query->fetch();
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> <?php echo CoreConfig::settings()['appname']; ?> :: Home </title>
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
<div class="main-wrapper">
    <div class="app" id="app">
        <?php require_once ("layouts/header.php"); ?>
        <?php require_once("layouts/sidebar.php"); ?>
        <article class="content dashboard-page">
            <div class="title-block">
                <h3 class="title">
                    Dashboard
                </h3> </div>
            <section class="section">

                Hello, <strong><?php echo WebUser::getUser()->getFullName(); ?></strong>


                <div class="row sameheight-container">
                    <div class="col col-xs-12 col-sm-12 col-md-6 col-xl-5 stats-col">
                        <div class="card sameheight-item stats" data-exclude="xs" style="height: 322px;">
                            <div class="card-block">
                                <div class="title-block">
                                    <h4 class="title">
                                        Stats
                                    </h4>

                                </div>
                                <div class="row row-sm stats-container">
                                    <div class="col-xs-12 col-sm-6 stat-col">
                                        <div class="stat-icon"> <i class="fa fa-gears"></i> </div>
                                        <div class="stat">
                                            <div class="value"> <?php echo $stats['DEVICES']; ?> </div>
                                            <div class="name"> Devices </div>
                                        </div> </div>
                                    <div class="col-xs-12 col-sm-6 stat-col">
                                        <div class="stat-icon"> <i class="fa fa-anchor"></i> </div>
                                        <div class="stat">
                                            <div class="value"> <?php echo $stats['DISTINCT_IPS'];?> </div>
                                            <div class="name"> Distinct IPs</div>
                                        </div>  </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>




            </section>

        </article>

        <?php require_once("layouts/footer.php"); ?>
        <div class="modal fade" id="modal-media">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Media Library</h4> </div>
                    <div class="modal-body modal-tab-container">
                        <ul class="nav nav-tabs modal-tabs" role="tablist">
                            <li class="nav-item"> <a class="nav-link" href="#gallery" data-toggle="tab" role="tab">Gallery</a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="#upload" data-toggle="tab" role="tab">Upload</a> </li>
                        </ul>
                        <div class="tab-content modal-tab-content">
                            <div class="tab-pane fade" id="gallery" role="tabpanel">
                                <div class="images-container">
                                    <div class="row"> </div>
                                </div>
                            </div>
                            <div class="tab-pane fade active in" id="upload" role="tabpanel">
                                <div class="upload-container">
                                    <div id="dropzone">
                                        <form action="/" method="POST" enctype="multipart/form-data" class="dropzone needsclick dz-clickable" id="demo-upload">
                                            <div class="dz-message-block">
                                                <div class="dz-message needsclick"> Drop files here or click to upload. </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary">Insert Selected</button> </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="confirm-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title"><i class="fa fa-warning"></i> Alert</h4> </div>
                    <div class="modal-body">
                        <p>Are you sure want to do this?</p>
                    </div>
                    <div class="modal-footer"> <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button> </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
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







<script>
    $(function ()
    {
        activateMenuLi("_dashboard");

    })
</script>
</body>

</html>