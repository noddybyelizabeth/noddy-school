<?php

namespace lib\Components\Form\Inputs;

class InputFactory {
	public static function text(
		string $name,
		string $label,
		string $value = "",
	): InputText {
		return InputText::create($name, $label, $value);
	}
}