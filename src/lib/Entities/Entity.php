<?php

namespace lib\Entities;

class Entity {
	public function __construct(
		private int $id,
	) {}

	public function getId(): int { return $this->id; }
	public function setId(int $id): Entity {
		$this->id = $id;
		return $this;
	}
}