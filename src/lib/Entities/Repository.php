<?php

namespace lib\Entities;

use lib\Utilities\RuntimeCache;
use lib\Infrastructure\Query\Query;
use lib\Infrastructure\Query\Builder\QuerySelect;
use lib\Infrastructure\Query\Builder\QueryDelete;

abstract class Repository implements RepositoryInterface {
	protected static string $tableName;

	public static function get(
		null|int $id,
	): null|Entity {
		if ($id === null)
			return null;

		$cache = RuntimeCache::create(
			$id,
		);
		if ($cache->isExists())
			return $cache->get();

		$select = new QuerySelect(self::$tableName);
		$select->where("id", $id);

		$result = self::getObject(Query::execute($select));
		if ($result !== null)
			$cache->set($result);

		return $result;
	}
	public static function delete(
		null|Entity $entity,
	): void {
		if ($entity === null)
			return;

		$delete = new QueryDelete(self::$tableName);
		$delete->where("id", $entity->getId());

		RuntimeCache::dump();

		Query::execute($delete);
	}

	public static function getObject(
		Query $query,
		bool  $isArray = false,
	): null|array|Entity {
		return null;
	}
}