<?php

namespace lib\Utilities;

use Random\RandomException;
class Text {
	public static function random(int $length = 16): string {
		$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$charactersLength = strlen($characters);

		$result = "";

		try {
			for ($i = 0; $i < $length; $i++)
				$result .= $characters[random_int(0, $charactersLength - 1)];
		} catch (RandomException $_) {
			return "";
		}

		return $result;
	}
}