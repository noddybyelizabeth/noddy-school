<?php

namespace lib\Infrastructure\Database;

use mysqli;

class Database {
	private static null|Database $instance = null;
	private null|mysqli $conn;

	private function __construct() {
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

		$this->conn = mysqli_init();
	}
	private static function tryConnection(): null|Database {
		$host = self::getHost();
		$port = self::getPort();
		$username = self::getUsername();
		$password = self::getPassword();
		$databaseName = self::getName();
		$charset = self::getCharset();
		$timeout = self::getTimeout();

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
	public static function getInstance(): null|Database {
		if (self::$instance === null)
			self::$instance = self::tryConnection();
		return self::$instance;
	}

	public function getConnection(): mysqli {
		return $this->conn;
	}

	public static function getHost(): string { return getenv("MYSQL_HOST") ?: "database"; }
	public static function getPort(): int { return getenv("MYSQL_PORT") ?: "3306"; }
	public static function getUsername(): string { return getenv("MYSQL_USER") ?: "noddy"; }
	public static function getPassword(): string { return getenv("MYSQL_PASS") ?: "noddy"; }
	public static function getName(): string { return getenv("MYSQL_NAME") ?: "noddy-school"; }
	public static function getCharset(): string { return getenv("MYSQL_CHARSET") ?: "utf8mb4"; }
	public static function getTimeout(): int { return getenv("MYSQL_TIMEOUT") ?: "5"; }
}