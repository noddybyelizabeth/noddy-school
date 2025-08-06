<?php

namespace lib\Components;

class Header {
	private static string|null $header = null;

	public static function printTitle(string $title): void {
		global $SITE_NAME;
		self::$header = $title;

		echo <<<HTML
			<script>
			document.title = '$title - $SITE_NAME';	
			</script>
		HTML;
	}
	public static function printBreadcrumb(array $items = []): void {
		$breadcrumbSeperator = <<<HTML
			<li class="mx-2 flex-shrink-0 text-gray-400">/</li>
		HTML;

		function getBreadcrumbLink(
			string $text,
			string $link,
		): string {
			return <<<HTML
				<li class="flex-shrink-0">
					<a href="$link" class="rounded-md underline text-gray-600 hover:text-gray-700">
						<span>$text</span>
					</a>
				</li>
			HTML;
		}
		function getBreadcrumbLinkActive(
			string $text,
		): string {
			return <<<HTML
				<li class="flex-shrink-0 text-gray-400">
					<span>$text</span>
				</li>
			HTML;
		}

		$header = self::$header;
		$links = array_merge([["Home", "/"]], $items);
		$recentLink = $links[array_key_last($links)];

		$breadcrumbBody = [];
		foreach ($links as $link)
			$breadcrumbBody[] = getBreadcrumbLink($link[0], $link[1]);
		if (self::$header)
			$breadcrumbBody[] = getBreadcrumbLinkActive(self::$header);
		$breadcrumbBody = implode($breadcrumbSeperator, $breadcrumbBody);

		echo <<<HTML
			<nav class="mb-4 overflow-x-auto whitespace-nowrap bg-white border border-gray-300 py-1 px-4 rounded-lg">
				<ol class="flex items-center text-gray-600">
					$breadcrumbBody
				</ol>
			</nav>
			<div class="flex items-center gap-4 mb-2">
				<a href="$recentLink[1]" class="underline px-4 py-1 rounded-lg bg-sky-600 hover:bg-sky-700 text-white decoration-sky-600 hover:decoration-sky-700">
					<i class="fas fa-left-long me-2"></i>
					<span>Back</span>
				</a>
				<h1 class="text-2xl font-bold flex gap-2">
					<span class="text-gray-500">#</span>
					<span class="text-gray-800">$header</span>
				</h1>
			</div>
		HTML;
	}
}