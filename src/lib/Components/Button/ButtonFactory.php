<?php

namespace lib\Components\Button;

class ButtonFactory {
	public static function submit(
		string $label,
	): ButtonSubmit {
		return ButtonSubmit::create($label);
	}
}