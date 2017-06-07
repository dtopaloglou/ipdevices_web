<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbc.php');
//check if user is logged in
WebUser::isLoggedIn(true);
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> <?php echo CoreConfig::settings()['appname']; ?> :: My Devices </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="css/vendor.css">

    <!-- DataTables CSS -->
    <link href="bower_components/datatables/media/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- DataTables Buttons Extension -->

    <link href="bower_components/datatables/extensions/Buttons/css/buttons.bootstrap4.min.css" rel="stylesheet">

    <!-- DataTable Select Extension -->
    <link href="bower_components/datatables/extensions/Select/css/select.bootstrap4.min.css" rel="stylesheet">
    <link href="bower_components/datatables/extensions/Select/css/select.dataTables.min.css" rel="stylesheet">



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
                    Devices
                </h3> </div>
            <section class="section">
                <div class="row sameheight-container">


                    <div class="col-xl-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <div class="header-block">
                                    <p class="title"> Devices </p>
                                </div>
                            </div>
                            <div class="card-block">


                                <div id="myDevices">


                                    <table id="myDevicesTable" class="table table-bordered">
                                        <thead>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>IP</th>
                                        <th>Date</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="card-footer"> &nbsp; </div>
                        </div>
                    </div>

                </div>
            </section>
            <section class="section">

            </section>
            <section class="section map-tasks">

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
<!-- DataTables JavaScript -->
<script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables/media/js/dataTables.bootstrap4.min.js"></script>
<!-- DataTable extensions -->
<script src="bower_components/datatables/extensions/Buttons/js/dataTables.buttons.js"></script>
<script src="bower_components/datatables/extensions/Buttons/js/buttons.bootstrap4.min.js"></script>
<script src="bower_components/datatables/extensions/Select/js/dataTables.select.min.js"></script>
<script src="bower_components/datatables/extensions/Buttons/js/buttons.flash.js"></script>
<script>
    $(function(){

        myDevices = $('#myDevicesTable').DataTable({

            dom : 'Bfrtip',
            "serverSide" : false,
            "destroy" : true,
            select :
            {
                style : "os"
            },
            buttons : [
                {
                    "extend" : "selectAll"
                },
                {
                    "extend" : "selectNone"
                },
                {
                    text : 'Refresh',
                    action : function (e, dt, node, config)
                    {
                        dt.ajax.reload();
                    }
                },

            ],
            "ajax" :
            {
                "url" : "ajax/mydevices.php",
                "type" : "POST",
            },
            "columns" : [

                {"data" : "did"},
                {"data" : "Name"},
                {"data" : "Location"},
                {"data" : "IP"},
                {"data" : "Date"}
            ],
            'order' : [[2, "asc"]],
            "rowCallback" : function (nRow, aData)
            {
                $(nRow).addClass('selectable');
            }
        });
        

        activateMenuLi("_mydevices");

    })
</script>
</body>

</html>