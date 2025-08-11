<?php

namespace lib\Components\Button;

class ButtonLink extends Button {
	protected function __construct(
		string $label,
		string $link,
	) {
		parent::__construct(
			$label,
		);
		$this->link = $link;
	}
	public static function create(
		string $label,
		string $link,
	): self {
		return new self($label, $link);
	}

	private string $link;

	public function __toString(): string {
		$id = $this->getId();
		$label = $this->getLabel();

		$defaultClasses = $this->getDefaultClasses();
		$color = $this->getColor();

		return <<<HTML
			<a
				id="$id"
				class="$defaultClasses $color"
				href="$this->link"
			>
				<span>$label</span>
			</a>
		HTML;
	}
}