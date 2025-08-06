<?php

namespace lib\Components\Typography;

use lib\Components\Component;

class Paragraph extends Component {
	protected function __construct(
		private readonly string $text,
	) {
		parent::__construct();
	}

	public static function text(string $text): self {
		return new self($text);
	}

	public function __toString(): string {
		return <<<HTML
			<p>$this->text</p>
		HTML;
	}
}