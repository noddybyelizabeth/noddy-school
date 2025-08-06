<?php

namespace lib\Components\Layout\Container;

use lib\Components\Component;

class Cell extends Component {
	protected function __construct(
		private readonly string $content,
		private readonly int    $size,
	) {
		parent::__construct();
	}

	public static function size1(string $content): self { return new self($content, 1); }
	public static function size2(string $content): self { return new self($content, 2); }
	public static function size3(string $content): self { return new self($content, 3); }
	public static function size4(string $content): self { return new self($content, 4); }

	public function __toString(): string {
		$colSize = "";
		if ($this->size > 1)
			$colSize = "col-span-$this->size";

		return <<<HTML
			<div class="$colSize">
				$this->content
			</div>
		HTML;
	}
}