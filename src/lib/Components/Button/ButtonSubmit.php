<?php

namespace lib\Components\Button;

class ButtonSubmit extends Button {
	protected function __construct(
		string $label,
	) {
		parent::__construct(
			$label,
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

		$icon = $this->getIcon() ?? "";
		$defaultClasses = $this->getDefaultClasses();
		$color = $this->getColor();

		return <<<HTML
			<button
				id="$id"
				class="$defaultClasses $color"
				type="submit"
			>
				<span>$icon$label</span>
			</button>
		HTML;
	}
}