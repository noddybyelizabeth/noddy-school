<?php

namespace lib\Components\Form\Inputs;

use lib\Components\Component;
use lib\Components\Form\Inputs\Enums\Type;

abstract class Input extends Component {
	protected function __construct(
		private readonly string $name,
		private readonly string $label,
		private readonly string $value,
		private readonly Type   $type,
	) {
		parent::__construct();
	}

	public function getName(): string { return $this->name; }
	public function getLabel(): string { return $this->label; }
	public function getValue(): string { return $this->value; }
	public function getType(): Type { return $this->type; }
}