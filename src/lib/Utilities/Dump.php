<?php

namespace lib\Utilities;

use UnitEnum;
use Exception;

class Dump {
	public static function error(
		string $errorTopic,
		string $errorMessage,
		string $errorFilePath,
		int    $errorLine,
	): void {
		echo <<<HTML
			<div class="font-mono border py-2 px-4 border-red-400 bg-red-50 my-2 text-sm">
				<div class="flex-shrink-0">
					<div><span class="font-bold underline text-lg">$errorTopic</span></div>
					<div><span class="font-bold text-amber-700 underline">$errorFilePath</span></div>
					<div class="border text-red-600 font-bold border-red-400 bg-red-100 px-3 py-2 mt-2">$errorMessage [Line $errorLine]</div>
				</div>
			</div>
		HTML;
	}
	public static function exception(Exception $e): void {
		$documentRoot = $_SERVER["DOCUMENT_ROOT"];

		function getStackRow(int $index, array $stackTrace): string {
			$documentRoot = $_SERVER["DOCUMENT_ROOT"];

			$stackLine = $stackTrace["line"];
			$stackFunction = $stackTrace["function"];

			$stackFile = str_replace($documentRoot, "", $stackTrace["file"]);

			return <<<HTML
				<tr class="border-b border-gray-300">
					<td class="px-2 text-center font-bold text-red-600">$index</td>
					<td class="px-2 text-center font-bold">$stackLine</td>
					<td class="px-2 text-start"><span class="font-bold text-blue-600">$stackFunction</span></td>
					<td class="px-2 text-start font-bold text-amber-700 underline">$stackFile</td>
				</tr>
			HTML;
		}

		$exceptionMessage = htmlspecialchars($e->getMessage());
		$exceptionFilePath = str_replace($documentRoot, "", $e->getFile());
		$exceptionStackTraces = $e->getTrace();

		$stackTracesHTML = "";
		foreach ($exceptionStackTraces as $index => $trace)
			$stackTracesHTML .= getStackRow($index, $trace);

		echo <<<HTML
			<div class="font-mono border py-2 px-4 border-red-400 bg-red-50 my-2 text-sm">
				<div class="flex-shrink-0">
					<div><span class="font-bold underline text-lg">CAUGHT EXCEPTION!!!</span></div>
					<div><span class="font-bold text-amber-700 underline">$exceptionFilePath</span></div>
					<div class="border text-red-600 font-bold border-red-400 bg-red-100 px-3 py-2 mt-2">$exceptionMessage</div>
					
					<div class="overflow-x-scroll">
						<table class="w-full mt-3">
							<thead class="bg-red-200">
								<tr class="border-b text-red-800">
									<th class="px-2" scope="col">Stack</th>
									<th class="px-2" scope="col">Line</th>
									<th class="px-2 text-start" scope="col">Function</th>
									<th class="px-2 text-start" scope="col">File</th>
								</tr>
							</thead>
							<tbody>
								$stackTracesHTML
							</tbody>
						</table>
					</div>
				</div>
			</div>
		HTML;
	}
	public static function var(mixed $data): void {
		$result = self::dumpVar($data);

		echo <<<HTML
			<div class="font-mono border py-2 px-4 border-amber-400 bg-amber-50 my-2 text-sm overflow-x-scroll w-full flex">
				<div class="flex-shrink-0">
					<div class="mb-2"><span class="font-bold underline text-lg">VARIABLE DUMP!!!</span></div>
					$result
				</div>
			</div>
		HTML;
	}

	private static function getFormatNull(): string {
		return <<<HTML
			<span class="font-bold text-red-600">null</span>
		HTML;
	}
	private static function getFormatBoolean(bool $data): string {
		$data = $data ? "true" : "false";
		return <<<HTML
			<span class="text-red-600 font-bold">$data</span>
		HTML;
	}
	private static function getFormatInt(int $data): string {
		return <<<HTML
			<span class="text-blue-600 font-bold">$data</span>
		HTML;
	}
	private static function getFormatFloat(float $data): string {
		return <<<HTML
			<span class="text-sky-600">$data</span>
		HTML;
	}
	private static function getFormatString(string $data): string {
		$data = htmlspecialchars($data);
		return <<<HTML
			<span class="text-green-700 font-bold">"$data"</span>
		HTML;
	}
	private static function getFormatArray(array $data, string $indent = ""): string {
		$nextIndent = $indent.str_repeat("&nbsp;", 4);

		$arrayCount = count($data);
		$arrayContent = "";

		foreach ($data as $key => $value) {
			$arrayKey = htmlspecialchars($key);
			$arrayValue = self::dumpVar($value, $nextIndent);

			$arrayContent .= <<<HTML
				<div><span class="font-bold">$nextIndent$arrayKey</span>: $arrayValue,</div>
			HTML;
		}

		return <<<HTML
			<span class="font-bold"><span class="text-red-600">Array</span> ($arrayCount) (</span>
			<div>$arrayContent</div>
			<span>$indent)</span>
		HTML;
	}
	private static function getFormatEnum(UnitEnum $data): string {
		$classPath = get_class($data);
		$classParts = explode("\\", $classPath);
		$className = end($classParts);

		$enumPath = htmlspecialchars(implode("\\", array_slice($classParts, 0, -1)));

		return <<<HTML
			<span class="font-bold text-blue-600">$className::$data->name</span>
		HTML;
	}
	private static function getFormatObject(object $data, string $indent = ""): string {
		$nextIndent = $indent.str_repeat("&nbsp;", 4);

		$classPath = get_class($data);
		$classParts = explode("\\", $classPath);
		$className = end($classParts);

		$classContent = "";
		$properties = self::sanitizeObjectsVars($data);
		foreach ($properties as $vars) {
			$varPath = htmlspecialchars($vars[0]);
			$varName = htmlspecialchars($vars[1]);
			$varValue = self::dumpVar($vars[2], $nextIndent);

			$classContent .= <<<HTML
				<div>$nextIndent<span class="font-bold">$varName</span>: $varValue</div>
			HTML;
		}

		return <<<HTML
			<span class="font-bold"><span class="text-red-600">Object</span> ($className) (</span>
			<div>$classContent</div>
			<span>$indent)</span>
		HTML;
	}
	private static function getFormatAny($data): string {
		$result = htmlspecialchars(gettype($data));
		return <<<HTML
			<span>$result</span>
		HTML;
	}

	private static function dumpVar(mixed $data, string $indent = ""): string {
		if (is_null($data))
			return self::getFormatNull();
		else if (is_bool($data))
			return self::getFormatBoolean($data);
		else if (is_int($data))
			return self::getFormatInt($data);
		else if (is_float($data))
			return self::getFormatFloat($data);
		else if (is_string($data))
			return self::getFormatString($data);
		else if (is_array($data))
			return self::getFormatArray($data, $indent);
		else if ($data instanceof UnitEnum)
			return self::getFormatEnum($data);
		else if (is_object($data))
			return self::getFormatObject($data, $indent);
		return self::getFormatAny($data);
	}
	private static function sanitizeObjectsVars(object $obj): array {
		$vars = (array)$obj;
		$cleaned = [];

		foreach ($vars as $key => $value) {
			if (str_starts_with($key, "\0")) {
				$parts = explode("\0", $key);
				$scope = $parts[1] ?: "*";
				$name = $parts[2] ?? $parts[1];
			} else {
				$scope = get_class($obj);
				$name = $key;
			}
			$cleaned[] = [$scope, $name, $value];
		}

		return $cleaned;
	}
}