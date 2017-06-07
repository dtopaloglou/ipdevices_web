<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbc.php');

if(empty($_REQUEST) || !isset($_REQUEST['email1']))
    exit;

$pdo = Registry::getConnection();

$query = $pdo->prepare("SELECT uid FROM client WHERE Email=:email LIMIT 1");
$query->bindValue(":email", $_REQUEST['email1']);
$query->execute();

$exists = $query->rowCount() > 0;

if(!$exists)
{
    exit("<p class='text-danger'>No account associated with this e-mail address</p>");
}

$data = $query->fetch();

$User = new User($data['uid']);


$PasswordReset = new PasswordReset($User);


if($PasswordReset->Reset())
{

    $message = "Your password has been reset! Please check your e-mail as you should be receiving your new password shortly.";
    ?>




    <script>
        $(function ()
        {
            $('#reset-success-msg').html("<?php echo $message;?>");
            $('#modal-success').modal("toggle");
            $('#modal-success').on('hidden.bs.modal', function () {
                $('form#reset-form')[0].reset();
            })

        })
    </script>


    <?php
}
else
{
    $errors = $PasswordReset->getErrors();
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