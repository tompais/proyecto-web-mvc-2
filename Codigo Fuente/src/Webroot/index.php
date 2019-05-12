<?php
define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

require_once ROOT . 'Config/core.php';
require_once ROOT . 'Helpers/Constantes.php';
require_once ROOT . 'router.php';
require_once ROOT . 'request.php';
require_once ROOT . 'dispatcher.php';

function getBaseAddress() {
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
    $filenamepattern = '/'.basename(__FILE__).'/';
    $url = $protocol.'://'.$_SERVER['HTTP_HOST'].preg_replace($filenamepattern,"",$_SERVER['REQUEST_URI']);
    return substr_replace($url, "", strripos($url, "/src/") + 5);
}

session_start();

$dispatch = new Dispatcher();
$dispatch->dispatch();
?>