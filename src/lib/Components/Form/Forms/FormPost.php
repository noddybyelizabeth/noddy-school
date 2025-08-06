<?php

namespace lib\Components\Form\Forms;

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
		$content = implode("", $this->getContents());

		$submitButton = ButtonFactory::submit("Submit");

		return <<<HTML
			<form method="$method" action="#">
				<div class="flex flex-col gap-4">
					<div>$content</div>
					<div class="">$submitButton</div>
				</div>
			</form>
		HTML;
	}
}