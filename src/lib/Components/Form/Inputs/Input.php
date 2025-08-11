<?php

namespace lib\Components\Form\Inputs;

use lib\Components\Component;

abstract class Input extends Component {
	protected function __construct(
		private readonly string $name,
		private readonly string $label,
		private readonly string $value,
	) {
		parent::__construct();
	}

	public function getName(): string { return $this->name; }
	public function getLabel(): string { return $this->label; }
	public function getValue(): string { return $this->value; }
}