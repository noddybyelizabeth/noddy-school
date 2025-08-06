<?php

namespace lib\Components\Button;

use lib\Components\Button\Enums\Type;
class ButtonSubmit extends Button {
	protected function __construct(
		string $label,
	) {
		parent::__construct(
			$label,
			Type::SUBMIT,
		);
	}

	public static function create(
		string $label,
	): self {
		return new self($label);
	}

	public function __toString(): string {
		$id = $this->getId();
		$label = $this->getLabel();
		$type = $this->getType()->value;

		return <<<HTML
			<button
				id="$id"
				class="
					px-3 py-2 text-white rounded-md
					bg-sky-600 hover:bg-sky-700
					cursor-pointer w-full
				"
				type="$type"
			>
				<span>$label</span>
			</button>
		HTML;
	}
}