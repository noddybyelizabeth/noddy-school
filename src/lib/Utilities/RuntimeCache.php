<?php

namespace lib\Utilities;

class RuntimeCache {
	private static array $cache = [];

	public function __construct(
		private readonly string $key,
	) {}

	public function isExists(): bool {
		return isset(self::$cache[$this->key]);
	}
	
	public function get(): mixed {
		return self::$cache[$this->key];
	}
	public function set(
		mixed $data,
	): void {
		self::$cache[$this->key] = $data;
	}

	/**
	 * @param string|int ...$keys
	 * @return RunTimeCache
	 */
	public static function create(
		string|int ...$keys
	): self {
		$backtrace = debug_backtrace();

		$className = $backtrace[0]["class"];
		$functionName = $backtrace[0]["function"];

		return new self("$className:$functionName:".implode(":", $keys));
	}
}