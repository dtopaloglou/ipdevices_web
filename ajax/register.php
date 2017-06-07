<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbc.php');

if(empty($_REQUEST))
    exit;

$Register = new Register();
$Register->setEmail($_REQUEST['email']);
$Register->setFirstname($_REQUEST['firstname']);
$Register->setUsername($_REQUEST['username']);
$Register->setLastname($_REQUEST['lastname']);
$Register->setPassword($_REQUEST['password']);
$Register->setConfirmPassword($_REQUEST['cPassword']);

if($Register->Register())
{

    $message = "Thank you <strong>" . $Register->getFirstname() . "</strong>, you have successfully signed up!";
    ?>




    <script>
        $(function ()
        {
            $('#signup-success-msg').html("<?php echo $message;?>");
            $('#modal-success').modal("toggle");
            $('#modal-success').on('hidden.bs.modal', function () {
                $('form#signup-form')[0].reset();
            })

        })
    </script>


    <?php
}
else
{
    $errors = $Register->getErrors();
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