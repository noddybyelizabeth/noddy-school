<?php

namespace lib\Infrastructure\Query\Builder;

use BackedEnum;

class QueryReplace extends QueryBuilder {
	private array $values;

	public function __construct(string $tableName) {
		parent::__construct($tableName);
	}

	public function values(array $values): void {
		$this->values = $values;
	}

	public function build(): string {
		$fieldsName = array_keys($this->values);
		$fieldName = implode(",", $fieldsName);

		$fieldValues = array_map(function ($value) {
			if (is_null($value))
				return "null";
			if (is_bool($value))
				return $value ? "true" : "false";
			if (is_int($value) || is_float($value))
				return $value;
			if ($value instanceof BackedEnum)
				return "'$value->value'";
			return "'$value'";

		}, $this->values);
		$fieldValues = implode(",", $fieldValues);

		return <<<SQL
			REPLACE INTO `$this->tableName` ( $fieldName ) values ( $fieldValues )
		SQL;
	}
}