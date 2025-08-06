<?php

namespace lib\Entities\User;

use lib\Entities\Entity;
use lib\Utilities\DateTime;
use lib\Entities\User\Enums\Role;

class User extends Entity {
	private null|string $email = null;
	private null|string $username = null;
	private null|string $passwordHash = null;
	private null|string $firstName = null;
	private null|string $lastName = null;
	private null|Role $role = null;
	private null|bool $isEnable = null;
	private null|DateTime $createdAt = null;
	private null|DateTime $updatedAt = null;

	public function getEmail(): null|string { return $this->email; }
	public function setEmail(null|string $email): User {
		$this->email = $email;
		return $this;
	}
	public function getUsername(): null|string { return $this->username; }
	public function setUsername(null|string $username): User {
		$this->username = $username;
		return $this;
	}
	public function getPasswordHash(): null|string { return $this->passwordHash; }
	public function setPasswordHash(null|string $passwordHash): User {
		$this->passwordHash = $passwordHash;
		return $this;
	}
	public function getFirstName(): null|string { return $this->firstName; }
	public function setFirstName(null|string $firstName): User {
		$this->firstName = $firstName;
		return $this;
	}
	public function getLastName(): null|string { return $this->lastName; }
	public function setLastName(null|string $lastName): User {
		$this->lastName = $lastName;
		return $this;
	}
	public function getRole(): null|Role { return $this->role; }
	public function setRole(null|Role $role): User {
		$this->role = $role;
		return $this;
	}
	public function isEnable(): null|bool { return $this->isEnable; }
	public function setEnable(null|bool $enable): User {
		$this->isEnable = $enable;
		return $this;
	}
	public function getCreatedAt(): null|DateTime { return $this->createdAt; }
	public function setCreatedAt(null|DateTime $createdAt): User {
		$this->createdAt = $createdAt;
		return $this;
	}
	public function getUpdatedAt(): null|DateTime { return $this->updatedAt; }
	public function setUpdatedAt(null|DateTime $updatedAt): User {
		$this->updatedAt = $updatedAt;
		return $this;
	}
}