<?php
session_start();
unset($_SESSION['uid']);
session_destroy();
header("location: index.php?logout=true");
exit;
