<?php

namespace lib\Components\Form\Forms;

use lib\Components\Component;
use lib\Components\Form\Forms\Enums\Method;

abstract class Form extends Component {
	protected function __construct(
		private readonly array  $contents,
		private readonly Method $method,
	) {
		parent::__construct();
	}

	public function getContents(): array { return $this->contents; }
	public function getMethod(): Method { return $this->method; }
}