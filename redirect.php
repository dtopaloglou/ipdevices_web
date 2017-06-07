<?php
if(isset($_GET['su']))
{
    header("location: signup.php");
}
if(isset($_GET['pr']))
{
    header("location: reset.php");
}