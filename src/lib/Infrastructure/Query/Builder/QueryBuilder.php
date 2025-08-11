<?php

namespace lib\Infrastructure\Query\Builder;

use lib\Infrastructure\Database\Database;
abstract class QueryBuilder implements QueryBuilderInterface {
	protected string $tableName;

	protected null|string $where = null;

	public function __construct(string $tableName) {
		$this->tableName = $tableName;
	}

	public function where(string $column, string $value): void {
		$database = Database::getInstance();
		$connection = $database->getConnection();

		$this->where = "$column = '$value'";
	}
	public function whereRaw(string $where): void {
		$this->where = $where;
	}
}