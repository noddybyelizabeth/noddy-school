<?php

namespace lib\Utilities;

class RuntimeCache {
	private static array $cache = [];

	public function __construct(
		private readonly string $className,
		private readonly string $functionName,
		private readonly string $key,
	) {}

	public function isExists(): bool {
		return isset(self::$cache[$this->key]);
	}

	public function get(): mixed {
		return self::$cache[$this->className][$this->functionName][$this->key];
	}
	public function set(
		mixed $data,
	): void {
		self::$cache[$this->className][$this->functionName][$this->key] = $data;
	}

	/**
	 * @param string|int ...$keys
	 * @return RunTimeCache
	 */
	public static function create(
		string|int ...$keys
	): self {
		$backtrace = debug_backtrace();

		return new self(
			$backtrace[0]["class"],
			$backtrace[0]["function"],
			implode(":", $keys),
		);
	}

	public static function dump(): void {
		unset(self::$cache[debug_backtrace()[0]["class"]]);
	}
}