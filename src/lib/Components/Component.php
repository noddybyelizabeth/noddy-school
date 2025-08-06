<?php

namespace lib\Components;

use lib\Utilities\Text;
abstract class Component implements ComponentRenderable {
	private static array $randomIds = [];

	private string $id;

	public function __construct() {
		do {
			$generatedIds = Text::random(6);
		} while (array_key_exists($generatedIds, self::$randomIds));
		$this->id = $generatedIds;
	}

	public function setId(string $id): void {
		$this->id = $id;
	}
	public function getId(): string {
		return $this->id;
	}

	public function print(): void {
		echo $this->__toString();
	}
}