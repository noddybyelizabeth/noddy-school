<?php

namespace lib\Infrastructure\Query;

use mysqli_stmt;
use lib\Infrastructure\Database\Database;

class Statement {
	public static function prepare(string $query): mysqli_stmt {
		$database = Database::getInstance();
		$connection = $database->getConnection();

		$statement = $connection->prepare($query);
		$statement->execute();

		return $statement;
	}

	public static function getFieldNames(string $table): array {
		$statement = self::prepare("SELECT * FROM `$table`");

		$result = $statement->get_result();
		$fields = $result->fetch_fields();

		$fieldsName = [];
		foreach ($fields as $field)
			$fieldsName[] = $field->name;

		return $fieldsName;
	}
	public static function getEmptyFieldNames(string $table): array {
		$emptyFields = [];

		$statement = self::prepare("SELECT * FROM `$table`");

		$result = $statement->get_result();
		$fields = $result->fetch_fields();

		foreach ($fields as $field)
			$emptyFields[$field->name] = null;

		return $emptyFields;
	}
}