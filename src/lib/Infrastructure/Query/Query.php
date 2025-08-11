<?php

namespace lib\Infrastructure\Query;

use mysqli_result;
use lib\Utilities\Dump;
use mysqli_sql_exception;
use lib\Infrastructure\Query\Builder\QueryBuilderInterface;

class Query {
	private array $fieldsName = [];

	private mysqli_result|false $result = false;

	private int $affectedRows;
	private int $insertedId;

	public function __construct() {}

	public static function execute(
		QueryBuilderInterface|string $queryString,
	): self {
		if (!is_string($queryString))
			$queryString = $queryString->build();

		$query = new self();

		try {
			$statement = Statement::prepare($queryString);

			$query->result = $statement->get_result();
			$query->affectedRows = $statement->affected_rows;
			$query->insertedId = intval($statement->insert_id);

			if ($query->result) {
				$fields = $query->result->fetch_fields();
				foreach ($fields as $field)
					$query->fieldsName[] = $field->name;
			}
		} catch (mysqli_sql_exception $e) {
			Dump::exception($e);
			exit(1);
		}
		return $query;
	}

	public function affectedRows(): int {
		return $this->affectedRows;
	}
	public function getInsertedId(): int {
		return $this->insertedId;
	}
	public function nextBind(array $fields = []): array|bool {
		if (!$this->result)
			return false;

		$result = $this->result->fetch_assoc();

		if (!$result)
			return false;

		foreach ($this->fieldsName as $fieldName)
			$fields[$fieldName] = $result[$fieldName];

		return $fields;
	}
}