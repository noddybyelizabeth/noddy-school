<?php

namespace templates;

?>

<aside class="w-64 border-r bg-white border-gray-200">
	<a href="/" class="text-2xl font-bold block flex ps-7 py-4">
		<img src="../static/logo/horizontal-text-side.png" width="150" alt="Logo"/>
	</a>
	<nav>
		<a href="/" class="flex items-center px-4 py-3 hover:bg-gray-100">
			<span class="ml-3">Dashboard</span>
		</a>
		<a href="/messages" class="flex items-center px-4 py-3 hover:bg-gray-100">
			<span class="ml-3">Messages</span>
		</a>
		<a href="/users" class="flex items-center px-4 py-3 hover:bg-gray-100">
			<span class="ml-3">Users</span>
		</a>
		<a href="/settings" class="flex items-center px-4 py-3 hover:bg-gray-100">
			<span class="ml-3">Settings</span>
		</a>
	</nav>
</aside>

<div class="flex-1 flex flex-col overflow-hidden">
	<header class="h-16 border-b flex items-center px-6 justify-between bg-white border-gray-200">
		<div class="text-xl font-semibold">Noddy by Elizabeth</div>
		<div class="flex items-center space-x-4">
			<img
				src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
				alt="User Avatar" class="w-8 h-8 rounded-full">
		</div>
	</header>

	<main class="flex-1 p-6 overflow-y-auto">
		<div class="w-full max-w-full overflow-x-auto">
			<?php include($GLOBALS["phpFile"]) ?>
		</div>
	</main>
</div>
