<?php

namespace lib\Infrastructure\Query\Builder;

class QueryDelete extends QueryBuilder {
	public function __construct(string $tableName) {
		parent::__construct($tableName);
	}

	public function build(): string {
		return "";
	}
}