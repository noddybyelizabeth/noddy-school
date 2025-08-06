<?php

namespace pages;

use lib\Components\Header;
use lib\Infrastructure\Query\Query;
use lib\Infrastructure\Database\Database;

Header::printTitle("Database");
Header::printBreadcrumb();

function getDatabaseTableData(): string {
	$result = "";

	$databaseName = Database::getName();

	$tableNamesSQL = <<<SQL
		SHOW TABLES FROM `$databaseName`
	SQL;
	$queryTableNames = Query::execute($tableNamesSQL);

	$result .= <<<HTML
		<div class="font-bold text-gray-400">*=-----------------------------------=*</div>
	HTML;

	while ($bindTableNames = $queryTableNames->nextBind()) {
		$tableName = $bindTableNames["Tables_in_noddy-school"];
		$result .= <<<HTML
			<div class="font-bold">Table Name: "$tableName"</div>
		HTML;

		$fieldsInfoSQL = <<<SQL
			DESCRIBE `$tableName`
		SQL;

		$queryFieldNames = Query::execute($fieldsInfoSQL);
		$bindFieldNames = [
			"Field" => null,
			"Type" => null,
			"Null" => null,
			"Key" => null,
			"Default" => null,
			"Extra" => null,
		];
		while ($bindFieldNames = $queryFieldNames->nextBind($bindFieldNames)) {
			$field = $bindFieldNames["Field"];
			$type = $bindFieldNames["Type"];
			$null = $bindFieldNames["Null"] === "NO" ? "NOT NULL" : "";
			$key = match ($bindFieldNames["Key"]) {
				"PRI" => "#PK",
				default => "",
			};
			$default = $bindFieldNames["Default"] === null ? "NULL" : "'".$bindFieldNames["Default"]."'";
			$extra = $bindFieldNames["Extra"] === "" ? "" : $bindFieldNames["Extra"];

			$result .= <<<HTML
				<div>
					<span>- $field -> </span>
					<span class="text-sky-700 font-bold">$type</span>
					<span class="text-purple-700">($null)</span>
					<span class="text-orange-700 font-bold">$key</span>
					<span class="text-gray-500">$extra</span>
					<span class="text-green-600 font-bold">DEFAULT: $default</span>
				</div>
			HTML;
		}
		$result .= <<<HTML
			<div class="font-bold text-gray-400">*=-----------------------------------=*</div>
		HTML;
	}
	return $result;
}

?>

<section class="font-mono border border-sky-500 bg-sky-50 px-3 py-2">
	<?= getDatabaseTableData() ?>
</section>

