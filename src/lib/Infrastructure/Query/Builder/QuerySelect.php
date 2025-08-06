<?php

namespace lib\Infrastructure\Query\Builder;

use lib\Infrastructure\Database\Database;

class QuerySelect implements QueryBuilder {
	private string $table;

	private null|string $where = null;
	private null|string $order = null;
	private bool $isDescending = false;
	private null|int $limit = null;
	private null|int $offset = null;

	public function __construct(string $table) {
		$this->table = $table;
	}

	public function where(string $column, string $value): void {
		$database = Database::getInstance();
		$connection = $database->getConnection();

		$this->where = "$column = '$value'";
	}
	public function whereRaw(string $where): void {
		$this->where = $where;
	}

	public function sortByColumn(string $column): void { $this->order = $column; }
	public function sortDescending(bool $bool): void { $this->isDescending = $bool; }
	public function limit(int $limit): void { $this->limit = $limit; }
	public function offset(int $offset): void { $this->offset = $offset; }

	public function build(): string {
		$limit = "";
		if ($this->limit > 0) {
			if ($this->offset === 0)
				$limit = "LIMIT $this->limit";
			else
				$limit = "LIMIT $this->offset, $this->limit";
		}

		$descending = "";
		if ($this->isDescending)
			$descending = "DESC";

		$orderBy = "";
		if ($this->order)
			$orderBy = "ORDER BY $this->table.$this->order";

		$where = "";
		if ($this->where)
			$where = "WHERE $this->where";

		return <<<SQL
			SELECT * FROM $this->table
			$where $orderBy
			$descending $limit
		SQL;
	}
}