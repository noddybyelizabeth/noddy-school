<?php

namespace lib\Components\Table;

use lib\Components\Table\Enums\Alignment;

class NDCompTableCell {
	public function __construct(
		private readonly string $text,
		private int|null        $width = null,
		private Alignment       $alignment = Alignment::LEFT,
		private bool            $isHeader = false,
	) {}
	public static function createHeader(string $text): NDCompTableCell {
		$tableCell = new NDCompTableCell($text);
		$tableCell->isHeader = true;
		return $tableCell;
	}
	public static function create(string $text): NDCompTableCell {
		return new NDCompTableCell($text);
	}
	public function setAlignment(Alignment $alignment): NDCompTableCell {
		$this->alignment = $alignment;
		return $this;
	}
	public function getAlignment(): Alignment|null {
		return $this->alignment;
	}
	public function setWidth(int $width): NDCompTableCell {
		$this->width = $width;
		return $this;
	}
	public function getWidth(): int|null {
		return $this->width;
	}
	public function __toString(): string {
		$classDefault = "py-2 px-4 border-b text-gray-800";

		$classTextAlignment = $this->alignment->value;

		$classBorderBottomColor = "border-gray-400";
		$classFontWeight = "font-normal";

		if ($this->isHeader) {
			$classFontWeight = "font-semibold";
			return <<<HTML
				<th class="
					$classDefault
					$classTextAlignment
					$classFontWeight
					$classBorderBottomColor
				">
					<div class="w-full truncate block">$this->text</div>
				</th>
			HTML;
		}

		$classBorderBottomColor = "border-gray-300";
		return <<<HTML
			<td class="
				$classDefault
				$classTextAlignment
				$classFontWeight
				$classBorderBottomColor
			">
				<div class="w-full truncate block">$this->text</div>
			</td>
		HTML;
	}
}