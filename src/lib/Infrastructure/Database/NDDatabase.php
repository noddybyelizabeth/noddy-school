<?php

namespace lib\Infrastructure\Database;

use mysqli;

class NDDatabase {
	private static null|NDDatabase $instance = null;
	private null|mysqli $conn;

	private function __construct() {
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

		$this->conn = mysqli_init();
	}
	private static function tryConnection(): null|NDDatabase {
		$host = getenv("MYSQL_HOST") ?: "database";
		$port = intval(getenv("MYSQL_PORT") ?: "3306");
		$username = getenv("MYSQL_USER") ?: "noddy";
		$password = getenv("MYSQL_PASS") ?: "noddy";
		$databaseName = getenv("MYSQL_NAME") ?: "noddy-school";
		$charset = getenv("MYSQL_CHARSET") ?: "utf8mb4";
		$timeout = intval(getenv("MYSQL_TIMEOUT") ?: "5");

		$connection = new self();

		$connection->conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, $timeout);
		$result = $connection->conn->real_connect(
			$host,
			$username,
			$password,
			$databaseName,
			$port,
		);
		if (!$result)
			return null;

		$connection->conn->query("SET SESSION sql_mode = 'STRICT_TRANS_TABLES'");
		$connection->conn->set_charset($charset);

		return $connection;
	}
	public static function getInstance(): null|NDDatabase {
		if (self::$instance === null)
			self::$instance = self::tryConnection();
		return self::$instance;
	}
}