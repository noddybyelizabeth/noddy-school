<?php

namespace lib\Components\Form\Inputs;

class InputFactory {
	public static function image(
		string $name,
		string $label,
		string $value = "",
	): InputImage {
		return InputImage::create($name, $label, $value);
	}
	public static function select(
		string $name,
		string $label,
		string $value = "",
	): InputSelect {
		return InputSelect::create($name, $label, $value);
	}
	public static function text(
		string $name,
		string $label,
		string $value = "",
	): InputText {
		return InputText::create($name, $label, $value);
	}
	public static function textarea(
		string $name,
		string $label,
		string $value = "",
	): InputTextarea {
		return InputTextarea::create($name, $label, $value);
	}
}