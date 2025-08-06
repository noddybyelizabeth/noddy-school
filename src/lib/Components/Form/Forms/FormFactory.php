<?php

namespace lib\Components\Form\Forms;

class FormFactory {
	public static function post(
		string ...$contents,
	): FormPost {
		return FormPost::create(...$contents);
	}
}