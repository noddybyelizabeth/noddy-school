<?php

namespace lib\Utilities;

use JetBrains\PhpStorm\NoReturn;
class NDRouter {
	#[NoReturn] public static function route($url, $delay = 0): void {
		echo '<meta http-equiv="refresh" content="'.$delay.'; url='.$url.'" />';
		exit;
	}
}