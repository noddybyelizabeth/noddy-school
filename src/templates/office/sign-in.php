<?php

namespace templates;

?>

<div class="w-full flex justify-center items-center">
	<div class="bg-white px-32 py-16 rounded-xl shadow-md flex flex-col gap-8">
		<img src="../static/logo/square-no-text.png" width="400" alt="Logo"/>

		<form action="#" method="POST" class="space-y-4">
			<div>
				<label for="email" class="block text-sm font-medium text-gray-700 mb-1">Username or Email</label>
				<input
					type="email"
					id="email"
					name="email"
					placeholder="user@noddybyelizabeth.ac.th"
					required
					class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
				/>
			</div>
			<div>
				<label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
				<input
					type="password"
					id="password"
					name="password"
					placeholder="********"
					required
					class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
				/>
			</div>
			<button
				type="submit"
				class="cursor-pointer w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200"
			>
				<i class="fas fa-sign-in me-3"></i>Sign In
			</button>
		</form>
	</div>
</div>