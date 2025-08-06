<?php

namespace lib\Components\Layout;

use lib\Components\Component;

class Spacer extends Component {
	protected function __construct(
		private readonly int $size,
	) {
		parent::__construct();
	}

	public static function small(): self { return new self(2); }
	public static function medium(): self { return new self(4); }
	public static function large(): self { return new self(6); }

	public function __toString(): string {
		return <<<HTML
			<hr class="my-$this->size border-none" /> 
		HTML;
	}
}
