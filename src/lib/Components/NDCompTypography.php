<?php

namespace lib\Components;

class NDCompTypography {
	public static function printParagraph(string $paragraph): void {
		echo self::paragraph($paragraph);
	}
	public static function paragraph(string $paragraph): string {
		return <<<HTML
			<p class="text-gray-700 mb-3">$paragraph</p>	
		HTML;
	}
	public static function printHeading1(string $topic): void {
		echo self::heading1($topic);
	}
	public static function heading1(string $topic): string {
		return <<<HTML
			<h2 class="text-gray-800 text-2xl font-bold mb-2">$topic</h2>
		HTML;
	}
}