<?PHP
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbc.php');

?>

<header class="header">
    <div class="header-block header-block-collapse hidden-lg-up">
        <button class="collapse-btn" id="sidebar-collapse-btn">
            <i class="fa fa-bars"></i>
        </button>
    </div>
    <div class="header-block header-block-search hidden-sm-down">
        <form role="search">
            <div class="input-container"><i class="fa fa-search"></i> <input type="search" placeholder="Search">
                <div class="underline"></div>
            </div>
        </form>
    </div>
    <div class="header-block header-block-buttons">
        <a href="https://github.com/dtopaloglou" class="btn btn-oval btn-sm rounded-s header-btn"> <i
                class="fa fa-github-alt"></i> View on GitHub </a>
        <a href="../app/setup.exe" class="btn btn-oval btn-sm rounded-s header-btn"> <i
                class="fa fa-cloud-download"></i> Download .exe </a>
    </div>
    <div class="header-block header-block-nav">
        <ul class="nav-profile">
            <!--
            <li class="notifications new">
                <a href="" data-toggle="dropdown"> <i class="fa fa-bell-o"></i> <sup>
                        <span class="counter">8</span>
                    </sup> </a>

                <div class="dropdown-menu notifications-dropdown-menu">
                    <ul class="notifications-container">
                        <li>
                            <a href="" class="notification-item">
                                <div class="img-col">
                                    <div class="img" style="background-image: url('assets/faces/3.jpg')"></div>
                                </div>
                                <div class="body-col">
                                    <p> <span class="accent">Zack Alien</span> pushed new commit: <span class="accent">Fix page load performance issue</span>. </p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="notification-item">
                                <div class="img-col">
                                    <div class="img" style="background-image: url('assets/faces/5.jpg')"></div>
                                </div>
                                <div class="body-col">
                                    <p> <span class="accent">Amaya Hatsumi</span> started new task: <span class="accent">Dashboard UI design.</span>. </p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="notification-item">
                                <div class="img-col">
                                    <div class="img" style="background-image: url('assets/faces/8.jpg')"></div>
                                </div>
                                <div class="body-col">
                                    <p> <span class="accent">Andy Nouman</span> deployed new version of <span class="accent">NodeJS REST Api V3</span> </p>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <footer>
                        <ul>
                            <li> <a href="">
                                    View All
                                </a> </li>
                        </ul>
                    </footer>
                </div>


            </li>
            -->
            <li class="profile dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false">
                    <div class="img" id="small-avatar"></div>
                    <span class="name">
    			      <?php echo WebUser::getUser()->getFullName(); ?>
    			    </span> </a>
                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                    <a class="dropdown-item" data-toggle="modal" data-target="#modal-media" href="#"> <i
                            class="fa fa-user icon"></i> Profile </a>
                    <a class="dropdown-item" href="#"> <i class="fa fa-bell icon"></i> Notifications </a>
                    <a class="dropdown-item" href="#"> <i class="fa fa-gear icon"></i> Settings </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../logout.php"> <i class="fa fa-power-off icon"></i> Logout </a>
                </div>
            </li>
        </ul>
    </div>
</header>


<form id="EditProfile">
    <div class="modal fade" id="modal-media">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Edit Profile</h4></div>


                <div class="container" style="padding-left : 60px; padding-top: 60px; padding-right: 30px; padding-bottom: 20px;">

                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <!-- Button trigger modal -->


                            <button type="button" class="btn btn-primary" data-ip-modal="#myModal">Edit</button>
                            <img id="profile-avatar" class="avatar img-circle center-block" alt="avatar">

                        </div>



                        <div class="ip-modal" id="myModal">
                            <div class="ip-modal-dialog">
                                <div class="ip-modal-content">
                                    <div class="ip-modal-header">
                                        <a class="ip-close" title="Close">&times;</a>
                                        <h4 class="ip-modal-title">Change avatar</h4>
                                    </div>
                                    <div class="ip-modal-body">
                                        <div class="btn btn-primary ip-upload">
                                            Upload <input type="file" name="file" class="ip-file">
                                        </div>
                                        <button type="button" class="btn btn-primary ip-webcam">Webcam</button>
                                        <button type="button" class="btn btn-info ip-edit">Edit</button>
                                        <button type="button" class="btn btn-danger ip-delete">Delete</button>
                                        <div class="alert ip-alert"></div>
                                        <div class="ip-info">
                                            To crop this image, drag a region below and then click "Save Image"
                                        </div>
                                        <div class="ip-preview"></div>
                                        <div class="ip-rotate">
                                            <button type="button" class="btn btn-default ip-rotate-ccw">
                                                <i class="icon-ccw"></i>
                                            </button>
                                            <button type="button" class="btn btn-default ip-rotate-cw">
                                                <i class="icon-cw"></i>
                                            </button>
                                        </div>
                                        <div class="ip-progress">
                                            <div class="text">Uploading</div>
                                            <div class="progress progress-striped active">
                                                <div class="progress-bar"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ip-modal-footer">
                                        <div class="ip-actions">
                                            <button type="button" class="btn btn-success ip-save">Save Image
                                            </button>
                                            <button type="button" class="btn btn-primary ip-capture">Capture
                                            </button>
                                            <button type="button" class="btn btn-default ip-cancel">Cancel
                                            </button>
                                        </div>
                                        <button type="button" class="btn btn-default ip-close">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- edit form column -->
                        <div class="col-md-8  personal-info">

                            <h3>Personal info</h3>

                            <form class="form-horizontal" role="form">
                                <div class="form-group">

                                    <label class="col-lg-4 control-label">First name:</label>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <input class="form-control underlined" id="uFirstname" name="uFirstname"
                                                   value="<?php echo WebUser::getUser()->getFirstName(); ?>" type="text"
                                                   placeholder="First name"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Last name:</label>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <input class="form-control underlined" id="uLastname" name="uLastname"
                                                   value="<?php echo WebUser::getUser()->getLastName(); ?>" type="text"
                                                   placeholder="Last name"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Email:</label>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <input class="form-control underlined"
                                                   value="<?php echo WebUser::getUser()->getEmail(); ?>" id="uEmail"
                                                   name="uEmail" type="text" placeholder="Email address"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Username:</label>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <input class="form-control underlined"
                                                   value="<?php echo WebUser::getUser()->getUsername(); ?>"
                                                   id="uUsername"
                                                   name="uUsername" type="text" placeholder="Username"></div>
                                    </div>
                                </div>

                                <h3>Password</h3>
                                <div class="form-group">

                                    <label class="col-md-4 control-label">Current password:</label>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <input class="form-control underlined" value="" id="uCurrentPassword"
                                                   name="uCurrentPassword" type="password" placeholder="Current password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label class="col-md-4 control-label">Password:</label>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <input class="form-control underlined" value="" id="uPassword"
                                                   name="uPassword"
                                                   type="password" placeholder="New assword">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label class="col-md-4 control-label" for="uCPassword">Confirm password:</label>


                                    <div class="col-md-8">
                                        <div class="row">
                                            <input class="form-control underlined" value="" id="uCPassword"
                                                   name="uCPassword" type="password" placeholder="Confirm new password">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div id="edit-profile-results"></div>


                <div class="modal-footer">
                    <button type="submit" id="SaveProfileEdit" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>


<!-- EDIT PROFILE DIALOG SUCCESS -->
<div class="modal fade" id="edit-success">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Success!</h4></div>

            <div class="modal-body">
                <div id="edit-profile-success-msg"></div>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>






