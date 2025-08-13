<?php

namespace lib\Components\Form\Inputs;

class InputText extends Input {
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
				<label for="NDCOMP_INPUT_TEXT_$id" class="font-medium">$this->label</label>
				<input
					id="NDCOMP_INPUT_TEXT_$id"
					type="text"
					name="$this->name"
					value="$this->value"
					autocomplete="off"
					title="Please fill in this field"
					class="
						w-full appearance-none
						border rounded-md px-3 py-1.5 bg-white
						border-gray-300 focus:border-blue-400
						outline-sky-500
						transition-colors duration-200
					"
				/>
			</div>
		HTML;
	}
}