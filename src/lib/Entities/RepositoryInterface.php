<?php

namespace lib\Entities;

use lib\Infrastructure\Query\Query;

interface RepositoryInterface {
	public static function replace(Entity $entity): Entity;
	public static function delete(Entity $entity): void;

	static function getObject(
		Query $query,
		bool  $isArray = false,
	): null|array|Entity;
}