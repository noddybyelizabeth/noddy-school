<?php

namespace lib\Infrastructure\Query\Builder;

use BackedEnum;
use lib\Utilities\Dump;
use lib\Infrastructure\Query\Statement;

class QueryReplace implements QueryBuilder {
	private string $table;
	private array $values;

	public function __construct(string $table) {
		$this->table = $table;
	}

	public function values(array $values): void {
		$this->values = $values;
	}

	public function build(): string {
		$fieldsName = Statement::getFieldNames($this->table);
		if (count($this->values) != count($fieldsName))
			return "";

		$fieldName = implode(",", $fieldsName);
		$fieldValuesArray = [];

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

		Dump::var($this->values);

		return <<<SQL
			REPLACE INTO `$this->table` ( $fieldName ) values ( $fieldValues )
		SQL;
	}
}