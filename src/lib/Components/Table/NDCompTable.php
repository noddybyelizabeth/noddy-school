<?php

namespace lib\Components\Table;

class NDCompTable {
	/**
	 * @param string $id
	 * @param NDCompTableCell[] $headCells
	 * @param NDCompTableCell[][] $bodyRows
	 * @return void
	 */
	public static function printTable(
		string $id,
		array  $headCells,
		array  $bodyRows,
	): void {
		echo self::table(
			$id,
			$headCells,
			$bodyRows,
		);
	}
	/**
	 * @param string $id
	 * @param NDCompTableCell[] $headCells
	 * @param NDCompTableCell[][] $bodyRows
	 * @return string
	 */
	public static function table(
		string $id,
		array  $headCells,
		array  $bodyRows,
	): string {
		$head = implode("", $headCells);

		$colGroups = [];
		foreach ($headCells as $headCell) {
			$alignment = $headCell->getAlignment()->value;

			if ($headCell->getWidth() !== null) {
				$width = "{$headCell->getWidth()}px";
				$colGroups[] = <<<HTML
					<col class="$alignment" style="width: $width; max-width: $width; min-width: $width;" />
				HTML;
			} else {
				$colGroups[] = <<<HTML
					<col class="$alignment min-w-64" />
				HTML;
			}
		}
		$colGroups = implode("", $colGroups);

		$body = [];
		foreach ($bodyRows as $bodyCells) {
			$bodyRow = [];
			foreach ($bodyCells as $key => $bodyCell) {
				$headCell = $headCells[$key];
				$bodyCell->setAlignment($headCell->getAlignment());
				$bodyRow[] = $bodyCell;
			}
			$bodyRow = implode("", $bodyRow);
			$body[] = <<<HTML
				<tr>$bodyRow</tr>
			HTML;
		}
		$body = implode("", $body);

		return <<<HTML
			<div class="overflow-x-auto py-3">
				<table id="NDCompTable_$id" class="table-fixed w-full border-collapse">
					<colgroup>$colGroups</colgroup>
					<thead id="NDCompTableHead_$id" class="bg-gray-200">
						<tr>$head</tr>
					</thead>
					<tbody id="NDCompTableBody_$id" class="divide-y">$body</tbody>	
				</table>
			</div>
		HTML;
	}
	/**
	 * @param NDCompTableCell ...$contents
	 * @return NDCompTableCell[]
	 */
	public static function row(
		NDCompTableCell ...$contents,
	): array {
		return $contents;
	}
	/**
	 * @param NDCompTableCell ...$contents
	 * @return NDCompTableCell[]
	 */
	public static function head(
		NDCompTableCell ...$contents,
	): array {
		return $contents;
	}
	/**
	 * @param NDCompTableCell[] ...$contents
	 * @return NDCompTableCell[][]
	 */
	public static function body(
		array ...$contents,
	): array {
		return $contents;
	}
}