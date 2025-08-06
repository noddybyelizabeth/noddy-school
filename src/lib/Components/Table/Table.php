<?php

namespace lib\Components\Table;

use lib\Components\Component;

class Table extends Component {
	protected function __construct(
		private readonly array $headCells,
		private readonly array $bodyRows,
		private null|string    $newItemLink = null,
	) {
		parent::__construct();
	}

	public static function create(
		array $headCells,
		array $bodyRows,
	): self {
		return new self($headCells, $bodyRows);
	}

	public function setNewItemLink(string $newItemLink): self {
		$this->newItemLink = $newItemLink;
		return $this;
	}

	/**
	 * @param TableCell ...$contents
	 * @return TableCell[]
	 */
	public static function row(
		TableCell ...$contents,
	): array {
		return $contents;
	}
	/**
	 * @param TableCell ...$contents
	 * @return TableCell[]
	 */
	public static function head(
		TableCell ...$contents,
	): array {
		return $contents;
	}
	/**
	 * @param TableCell[] ...$contents
	 * @return TableCell[][]
	 */
	public static function body(
		array ...$contents,
	): array {
		return $contents;
	}

	public function __toString(): string {
		$id = $this->getId();
		$headCells = $this->headCells;
		$bodyRows = $this->bodyRows;

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

		$newItemButton = "";
		if ($this->newItemLink !== null) {
			$newItemButton = <<<HTML
				<a class="ms-4 px-3 py-1 text-white rounded-md bg-emerald-500 hover:bg-emerald-600" href="$this->newItemLink">
					<i class="fas fa-plus me-2"></i>
					<span>New</span>
				</a>
			HTML;
		}

		return <<<HTML
			<div class="py-2 border border-gray-300 rounded-md bg-gray-200">
				<div class="mx-2 mb-2 flex items-center border-gray-300 border rounded-md bg-white px-2 py-2">
					<i class="text-gray-600 fas fa-filter me-3 ms-2"></i>
					<input
						type="search" placeholder="Type to filter"
						class="grow outline-none border-b-1 border-gray-300 focus:border-gray-500 px-2"
						id="NDCOMP_TABLE_INPUT_SEARCH_$id"'
					/>
					$newItemButton
				</div>
				<div class="overflow-x-scroll">
					<table id="NDCOMP_TABLE_$id" class="table-fixed w-full border-collapse">
						<colgroup>$colGroups</colgroup>
						<thead id="NDCOMP_TABLE_HEAD_$id" class="bg-gray-100">
							<tr>$head</tr>
						</thead>
						<tbody id="NDCOMP_TABLE_BODY_$id" class="divide-y bg-white">$body</tbody>	
					</table>
				</div>
			</div>
		HTML;
	}
}