<?php

use lib\Utilities\Dump;
use lib\Utilities\Router;
use lib\Utilities\Network;

error_reporting(E_ALL);

include("vendor/autoload.php");

function errorHandler(
	int    $errorNumber,
	string $errorMessage,
	string $errorFilePath,
	string $errorLine,
): bool {
	if (!(error_reporting() & $errorNumber))
		return false;

	$errorString = htmlspecialchars($errorMessage);

	switch ($errorNumber) {
		case E_PARSE:
		case E_ERROR:
		case E_CORE_ERROR:
		case E_COMPILE_ERROR:
		case E_USER_ERROR:
			Dump::error("FATAL ERROR!!!", $errorMessage, $errorFilePath, $errorLine);
			exit(1);
		case E_WARNING:
		case E_USER_WARNING:
		case E_COMPILE_WARNING:
		case E_RECOVERABLE_ERROR:
			Dump::error("WARNING!!!", $errorMessage, $errorFilePath, $errorLine);
			break;
		case E_NOTICE:
		case E_USER_NOTICE:
			Dump::error("NOTICE!!!", $errorMessage, $errorFilePath, $errorLine);
			break;
		case E_DEPRECATED:
		case E_USER_DEPRECATED:
			Dump::error("DEPRECATED!!!", $errorMessage, $errorFilePath, $errorLine);
			break;
		default:
			Dump::error("UNKNOWN ERROR!!!", $errorMessage, $errorFilePath, $errorLine);
			exit(1);
	}
	return true;
}
set_error_handler("errorHandler");

$requestPath = Network::getRequestPath();
$siteType = Network::getCurrentSiteType();

if (explode("/", $requestPath)[1] == "api") {
	$split = explode("/", $requestPath, 3);
	$split = (count($split) < 3) ? "" : $split[2];

	$phpFile = "{$_SERVER["DOCUMENT_ROOT"]}/api/$siteType/$split.php";

	if (file_exists($phpFile))
		include($phpFile);
	else {
		header("{$_SERVER["SERVER_PROTOCOL"]} 404 Not Found");
		echo "API not found!";
	}
	exit;
}

$phpFile = "{$_SERVER["DOCUMENT_ROOT"]}/pages/$siteType$requestPath";
$GLOBALS["phpFile"] = $phpFile;
if (is_dir($phpFile)) {
	if (str_ends_with($requestPath, "/") && $requestPath != "/") {
		Router::route(Network::getCurrentDomainURL().substr($requestPath, 0, -1));
	}
	$phpFile .= "/index.php";
} else {
	if (str_ends_with($requestPath, "/index")) {
		Router::route(Network::getCurrentDomainURL().substr($requestPath, 0, -6));
	}
	$phpFile .= ".php";
}

if (!file_exists($phpFile))
	$GLOBALS["phpFile"] = "{$_SERVER["DOCUMENT_ROOT"]}/templates/shared/404.php";

include("templates/$siteType/handler.php");