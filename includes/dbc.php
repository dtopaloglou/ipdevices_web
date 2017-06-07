<?php
error_reporting(E_ALL ^ E_NOTICE);
function my_autoloader($class)
{
    $f = $_SERVER['DOCUMENT_ROOT'] . "/includes/classes/" . $class . '.php';
    if (is_file($f))
    {
        include_once($f);
    }
}

spl_autoload_register('my_autoloader');
// SET DATABASE CONFIGURATION

CoreConfig::applySettings(require_once('settings.php'));

Registry::setConfig(new MySqlConfig(DatabaseManager::dbUser, DatabaseManager::dbPass, DatabaseManager::dbName, DatabaseManager::host, DatabaseManager::dbPort));



if (!empty($_SESSION))
{
    $User = UserFactory::create($_SESSION['uid']);


    WebUser::setUser($User);

}


date_default_timezone_set(CoreConfig::settings()['timezone']); // register timezone

?>