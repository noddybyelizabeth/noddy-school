<?php

namespace lib\Components\Form\Inputs;

use lib\Components\Button\Enums\Type;
use lib\Components\Icon\Enums\IconType;
use lib\Components\Button\ButtonFactory;
class InputImage extends Input {
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

		$buttonChange = ButtonFactory::link("Change", "")
			->setIcon(IconType::FOLDER_OPEN);
		$buttonRemove = ButtonFactory::link("Remove", "")
			->setType(Type::DANGER)
			->setIcon(IconType::TRASH_CAN);

		return <<<HTML
			<div class="flex flex-col gap-y-2">
				<label for="NDCOMP_INPUT_IMAGE_$id" class="font-medium">$this->label</label>
				<div class="flex flex-row gap-x-4">
					<div>
						<img class="rounded-lg" src="../static/default-avatar.jpg" width="150" height="150" alt="User Avatar" />
					</div>
					<div class="flex flex-col gap-2 place-content-end">
						<div class="flex gap-2">
							<div>$buttonChange</div>
							<div>$buttonRemove</div>
						</div>
						<div class="text-gray-500">
							Accept PNG,JPG,JPEG or GIF. Max 2 MB.
						</div>
					</div>
				</div>
			</div>
		HTML;
	}
}