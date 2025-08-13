<?php

namespace lib\Components\Form\Forms;

use lib\Components\Header;
use lib\Components\Button\Enums\Type;
use lib\Components\Icon\Enums\IconType;
use lib\Components\Button\ButtonFactory;
use lib\Components\Form\Forms\Enums\Method;

class FormPost extends Form {
	protected function __construct(
		array $contents,
	) {
		parent::__construct(
			$contents,
			Method::POST,
		);
	}

	public static function create(
		string ...$contents
	): self {
		return new self($contents);
	}

	public function __toString(): string {
		$method = $this->getMethod()->value;
		$contents = implode("", $this->getContents());

		$cancelButton = ButtonFactory::link("Cancel", Header::getBackLink())
			->setType(Type::DANGER)
			->setIcon(IconType::BAN);
		$submitButton = ButtonFactory::submit("Submit")
			->setType(Type::SUCCESS)
			->setIcon(IconType::PAPER_PLANE);

		return <<<HTML
			<form method="$method" action="#">
				<div class="flex flex-col gap-4">
					<div class="flex flex-col gap-2">$contents</div>
					<div class="flex gap-2">
						<div>$cancelButton</div>
						<div>$submitButton</div>
					</div>
				</div>
			</form>
		HTML;
	}
}