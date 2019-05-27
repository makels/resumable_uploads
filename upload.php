<?php
ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);

define ('DIRSEP', DIRECTORY_SEPARATOR);
define ('SITE_PATH', realpath(dirname(__FILE__)) . DIRSEP);
define("CLASSES_DIR", SITE_PATH . "classes" .DIRSEP);
define("UPLOADS_DIR", SITE_PATH . "uploads" .DIRSEP);
define("TEMP_DIR", SITE_PATH . "tmp" .DIRSEP);

require_once SITE_PATH . "vendor/autoload.php";

use Dilab\Network\SimpleRequest;
use Dilab\Network\SimpleResponse;
use Dilab\Resumable;

$request = new SimpleRequest();
$response = new SimpleResponse();

$resumable = new Resumable($request, $response);
$resumable->tempFolder = TEMP_DIR;
$resumable->uploadFolder = UPLOADS_DIR;
$resumable->process();