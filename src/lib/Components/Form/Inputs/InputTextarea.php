<?php

namespace lib\Components\Form\Inputs;

class InputTextarea extends Input {
	protected function __construct(
		private readonly string $name,
		private readonly string $label,
		private readonly string $value,
	) {
		parent::__construct(
			$this->name,
			$this->label,
			$this->value,
		);
	}

	public static function create(
		string $name,
		string $label,
		string $value,
	): self {
		return new self(
			$name,
			$label,
			$value,
		);
	}

	public function __toString(): string {
		$id = $this->getId();
		return <<<HTML
			<div class="flex flex-col gap-y-2">
				<label for="NDCOMP_INPUT_TEXTAREA_$id" class="font-medium">$this->label</label>
				<textarea
					id="NDCOMP_INPUT_TEXTAREA_$id"
					name="$this->name"
					autocomplete="off"
					title="Please fill in this field"
					class="
						border rounded-md px-3 py-1.5 bg-white
						border-gray-300 focus:border-blue-400
						outline-sky-500 min-h-64
					"
				>$this->value</textarea>
			</div>
		HTML;
	}
}