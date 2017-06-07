<?php
if(empty($_REQUEST))
    exit;

session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbc.php');

$Login = new Login($_POST);

if ($Login->login())
{

        ?>
        <script>window.location.replace("home.php");</script>

        <?php

}
else
{
    $errors = $Login->getErrors();
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
?>