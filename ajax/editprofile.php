<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbc.php');

if(empty($_REQUEST))
    exit;

$EditProfile = new EditProfile(WebUser::getUser());
$EditProfile->setEmail($_REQUEST['uEmail']);
$EditProfile->setFirstname($_REQUEST['uFirstname']);
$EditProfile->setUsername($_REQUEST['uUsername']);
$EditProfile->setLastname($_REQUEST['uLastname']);


$EditProfile->setCurrentPassword($_REQUEST['uCurrentPassword']);
$EditProfile->setPassword($_REQUEST['uPassword']);
$EditProfile->setConfirmPassword($_REQUEST['uCPassword']);


if($EditProfile->Edit())
{

    $message = "Your profile information has been updated!";
    ?>




    <script>
        $(function ()
        {
            $('#edit-profile-success-msg').html("<?php echo $message;?>");
            $('#edit-success').modal("toggle");
            $('#uCPassword, #uCurrentPassword, #uPassword').val("");

        })
    </script>


    <?php
}
else
{
    $errors = $EditProfile->getErrors();
    ?>

    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php
        $msg .= "<ul>";
        foreach ($errors as $error)
        {
            $msg .= '<li>' . $error . '</li>';
        }
        $msg .= "</ul>";
        echo $msg;
        ?>
    </div>
    <?php
}