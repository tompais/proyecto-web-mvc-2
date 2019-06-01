<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');

define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

require_once ROOT . 'Config/core.php';
require_once ROOT . 'router.php';
require_once ROOT . 'request.php';
require_once ROOT . 'dispatcher.php';

massiveImport('Helpers');
massiveImport('Enums');
massiveImport('Utils');
massiveImport('Exceptions');
massiveImport('Dto');
massiveImport('Models');

header("Content-Type: text/html; charset=utf-8");

function massiveImport($folder)
{
    $path = ROOT . $folder . "/*.php";
    foreach (glob($path) as $filename)
    {
        require_once "$filename";
    }
}

function getBaseAddress()
{
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
    $filenamepattern = '/' . basename(__FILE__) . '/';
    $url = $protocol . '://' . $_SERVER['HTTP_HOST'] . preg_replace($filenamepattern, "", $_SERVER['REQUEST_URI']);
    return substr_replace($url, "", strripos($url, "/src/") + 5);
}

function throwError404()
{
    http_response_code(404);
    include ROOT . "Views/NoCompletado/noCompletado.php";
    die();
}

function globalErrorHandler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, 0, $errfile, $errline);
}

set_error_handler("globalErrorHandler");

function globalExceptionHandler($exception)
{
    $strError = ($exception->getCode() != 0 ? ("Error " . $exception->getCode()) : ("Excepción no controlada")) . ": '" . $exception->getMessage() . "' en el archivo " . substr($exception->getFile(), strripos($exception->getFile(), "\\") + 1)  . " en la línea " . $exception->getLine() . PHP_EOL . "Trace: " . $exception->getTraceAsString();
    echo $strError;
    $strLog = "[". date("Y-m-d H:i:s") ."]  " . $strError . PHP_EOL . PHP_EOL;
    file_put_contents("exception-log.txt", $strLog,FILE_APPEND);
    if($exception->getCode() == 0)
        throwError404();
}

set_exception_handler('globalExceptionHandler');

session_start();

$dispatch = new Dispatcher();
$dispatch->dispatch();
?>