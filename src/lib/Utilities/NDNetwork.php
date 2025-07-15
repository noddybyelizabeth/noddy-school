<?php

namespace lib\Utilities;

class NDNetwork {
	public static function getCurrentSiteType(): string {
		$serverName = $_SERVER["SERVER_NAME"];

		if ($serverName === "office.localhost")
			return "office";
		if ($serverName === "teacher.localhost")
			return "teacher";
		if ($serverName === "parent.localhost")
			return "parent";

		return "";
	}
	public static function getCurrentDomainURL(): string {
		return 'http://'.$_SERVER['HTTP_HOST'];
	}
	public static function getRequestPath(): string {
		$path_only = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
		if ($path_only === null)
			return "";

		return $path_only;
	}
}