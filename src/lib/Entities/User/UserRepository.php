<?php

namespace lib\Entities\User;

use lib\Entities\Entity;
use lib\Entities\Repository;
use lib\Entities\User\Enums\Role;
use lib\Infrastructure\Query\Query;
use lib\Infrastructure\Query\Statement;
use lib\Infrastructure\Query\Builder\QueryReplace;

class UserRepository extends Repository {
	protected static string $tableName = "user";

	#region Other Methods
	public static function replace(User|Entity $entity): User {
		$replace = new QueryReplace(self::$tableName);

		$replace->values([
			"id" => $entity->getId(),
			"email" => $entity->getEmail(),
			"username" => $entity->getUsername(),
			"password_hash" => $entity->getPasswordHash(),
			"first_name" => $entity->getFirstName(),
			"last_name" => $entity->getLastName(),
			"role" => $entity->getRole(),
			"is_enable" => $entity->isEnable(),
			"created_at" => $entity->getCreatedAt(),
			"updated_at" => $entity->getUpdatedAt(),
		]);

		$query = Query::execute($replace);
		$entity->setId($query->getInsertedId());

		return $entity;
	}
	public static function delete(User|Entity $entity): void {
		// TODO: implement
	}
	#endregion
	#region Abstract Methods
	public static function processObject(Query $query, bool $isArray = false): null|array|User {
		$result = [];

		$bind = Statement::getEmptyFieldNames(self::$tableName);
		while ($bind = $query->nextBind($bind)) {
			$user = new User($bind["id"]);

			$user->setEmail($bind["email"]);
			$user->setUsername($bind["username"]);
			$user->setPasswordHash($bind["password_hash"]);
			$user->setFirstName($bind["first_name"]);
			$user->setLastName($bind["last_name"]);
			$user->setRole(Role::tryFrom($bind["role"]));
			$user->setEnable($bind["is_enable"]);

			$result[] = $user;

			if (!$isArray)
				return $result[0] ?? null;
		}
		if (!$isArray)
			return $result[0] ?? null;

		return $result;
	}
	#endregion
}