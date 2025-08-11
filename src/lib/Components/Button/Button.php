<?php

namespace lib\Components\Button;

use lib\Components\Component;
use lib\Components\Button\Enums\Type;

abstract class Button extends Component {
	private Type $type = Type::BASIC;

	protected function __construct(
		private readonly string $label,
	) {
		parent::__construct();
	}

	public function getColor(): string {
		if ($this->type === Type::SUCCESS)
			return "bg-green-600 hover:bg-green-700";
		if ($this->type === Type::WARNING)
			return "bg-amber-500 hover:bg-amber-600";
		if ($this->type === Type::DANGER)
			return "bg-red-600 hover:bg-red-700";
		return "bg-sky-600 hover:bg-sky-700";
	}

	public function getLabel(): string { return $this->label; }

	public function setType(Type $type): self {
		$this->type = $type;

		return $this;
	}
	public function getType(): Type { return $this->type; }

	public function getDefaultClasses(): string {
		return "
			text-white font-medium
			px-3 py-2 rounded-md
			cursor-pointer
			w-full
		";
	}
}