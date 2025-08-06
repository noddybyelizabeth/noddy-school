<?php

namespace lib\Components\Button;

use lib\Components\Component;
use lib\Components\Button\Enums\Type;

abstract class Button extends Component {
	protected function __construct(
		private readonly string $label,
		private readonly Type   $type,
	) {
		parent::__construct();
	}

	public function getLabel(): string { return $this->label; }
	public function getType(): Type { return $this->type; }
}