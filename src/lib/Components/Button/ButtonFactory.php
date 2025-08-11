<?php

namespace lib\Components\Button;

class ButtonFactory {
	public static function submit(
		string $label,
	): ButtonSubmit {
		return ButtonSubmit::create($label);
	}
	public static function link(
		string $label,
		string $link,
	): ButtonLink {
		return ButtonLink::create($label, $link);
	}
}