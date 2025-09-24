<?php

namespace lib\Components\Table;

use lib\Components\Table\Enums\Alignment;

class TableCell {
	protected function __construct(
		private readonly string $text,
		private null|int        $width = null,
		private Alignment       $alignment = Alignment::LEFT,
		private bool            $isHeader = false,
	) {}

	public static function createHeader(string $text = ""): TableCell {
		$tableCell = new TableCell($text);
		$tableCell->isHeader = true;
		return $tableCell;
	}
	public static function create(string $text = ""): TableCell {
		return new TableCell($text);
	}

	public function setAlignment(Alignment $alignment): TableCell {
		$this->alignment = $alignment;
		return $this;
	}
	public function getAlignment(): null|Alignment {
		return $this->alignment;
	}

	public function setWidth(int $width): TableCell {
		$this->width = $width;
		return $this;
	}
	public function getWidth(): null|int {
		return $this->width;
	}

	public function __toString(): string {
		$classDefault = "py-2 px-4 border-b text-gray-800";
		$classFontWeight = "font-normal";

		$classTextAlignment = $this->alignment->value;

		$classBorderBottomColor = "border-gray-200";
		$classBorderStyle = "border-solid";

		if ($this->isHeader) {
			$classFontWeight = "font-semibold";
			return <<<HTML
				<th class="
					$classDefault
					$classTextAlignment
					$classFontWeight
					$classBorderBottomColor
					$classBorderStyle
				">
					<div class="w-full truncate block">$this->text</div>
				</th>
			HTML;
		}

		return <<<HTML
			<td class="
				$classDefault
				$classTextAlignment
				$classFontWeight
				$classBorderBottomColor
				$classBorderStyle
			">
				<div class="w-full truncate block">$this->text</div>
			</td>
		HTML;
	}
}