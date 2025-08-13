<?php

namespace lib\Components\Icon;

use lib\Components\Component;
use lib\Components\Icon\Enums\IconType;

class Icon extends Component {
	protected function __construct(
		private readonly IconType $iconType,
		private int               $marginLeft = 0,
		private int               $marginRight = 0,
	) {
		parent::__construct();
	}

	public static function create(IconType $iconType): self {
		return new self($iconType);
	}

	public function setMarginLeft(int $marginLeft): self {
		$this->marginLeft = $marginLeft;
		return $this;
	}
	public function setMarginRight(int $marginRight): self {
		$this->marginRight = $marginRight;
		return $this;
	}

	public function __toString(): string {
		$iconClass = $this->iconType->value;

		return <<<HTML
			<i class="fas fa-$iconClass ms-$this->marginLeft me-$this->marginRight"></i>
		HTML;
	}
}