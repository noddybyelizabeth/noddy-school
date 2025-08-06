<?php

namespace lib\Components\Typography;

use lib\Components\Component;

class Heading extends Component {
	protected function __construct(
		private readonly string $text,
		private readonly int    $level,
	) {
		parent::__construct();
	}

	public static function level1(string $text): self {
		return new self($text, 1);
	}

	public function __toString(): string {
		$headingLevelTag = "h$this->level";
		return <<<HTML
			<$headingLevelTag>$this->text</$headingLevelTag>
		HTML;
	}
}