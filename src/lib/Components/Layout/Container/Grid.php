<?php

namespace lib\Components\Layout\Container;

use lib\Components\Component;

class Grid extends Component {
	protected function __construct(
		private readonly array $cells,
		private readonly int   $size,
	) {
		parent::__construct();
	}

	public static function size1(Cell ...$cells): self { return new self($cells, 1); }
	public static function size2(Cell ...$cells): self { return new self($cells, 2); }
	public static function size3(Cell ...$cells): self { return new self($cells, 3); }
	public static function size4(Cell ...$cells): self { return new self($cells, 4); }

	public function __toString(): string {
		$content = implode("", $this->cells);

		return <<<HTML
			<div class="grid grid-cols-$this->size gap-4">
				$content
			</div>
		HTML;
	}
}