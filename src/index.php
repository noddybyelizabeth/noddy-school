<?php

use lib\Utilities\NDRouter;
use lib\Utilities\NDNetwork;

include("vendor/autoload.php");

$requestPath = NDNetwork::getRequestPath();
$siteType = NDNetwork::getCurrentSiteType();

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
		NDRouter::route(NDNetwork::getCurrentDomainURL().substr($requestPath, 0, -1));
	}
	$phpFile .= "/index.php";
} else {
	if (str_ends_with($requestPath, "/index")) {
		NDRouter::route(NDNetwork::getCurrentDomainURL().substr($requestPath, 0, -6));
	}
	$phpFile .= ".php";
}

if (!file_exists($phpFile))
	$GLOBALS["phpFile"] = "{$_SERVER["DOCUMENT_ROOT"]}/templates/shared/404.php";

include("templates/$siteType/handler.php");