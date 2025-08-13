<?php

namespace lib\Components\Form\Inputs;

class InputSelect extends Input {
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
				<div class="relative">
					<select
						id="NDCOMP_INPUT_SELECT_123456"
						name="example_select"
						autocomplete="off"
						title="Please select an option"
						class="
							w-full appearance-none
							border rounded-md px-3 py-1.5 pr-10 bg-white
							border-gray-300 focus:border-blue-400
							outline-sky-500 text-gray-500
							cursor-pointer
							transition-colors duration-200
						"
					>
						<option value="" disabled selected>Choose an option...</option>
						<option value="A">Option A</option>
						<option value="B">Option B</option>
						<option value="C">Option C</option>
					</select>
					<div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
						<i class="fas fa-chevron-down text-gray-500"></i>
					</div>
				</div>
			</div>
		HTML;
	}
}