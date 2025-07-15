<?php

namespace template;

global $SITE_NAME;
global $SITE_LINK;

$STATIC_VERSION = "1.0";

?>

<head>
	<!-- View Port -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- Meta Data -->
	<title>Noddy by Elizabeth</title>

	<meta charset="UTF-8" />

	<meta property="og:site_name" content="<?= $SITE_NAME ?>" />
	<meta property="og:title" content="<?= $SITE_NAME ?>" />
	<meta property="og:description" content="<?= $SITE_NAME ?>" />
	<meta property="og:url" content="<?= $SITE_LINK ?>" />
	<meta property="og:type" content="website" />

	<link rel="canonical" href="<?= $SITE_LINK ?>" />

	<meta property="og:image" content="" />
	<meta property="og:image:height" content="" />
	<meta property="og:image:width" content="" />

	<link rel="icon" type="image/png" href="" sizes="x" />
	<link rel="shortcut icon" href="" />
	<link rel="apple-touch-icon" href="" sizes="x" />
	<link rel="manifest" href="" />

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

	<!-- CSS -->
	<link href="/static/css/styles.css?v=<?= $STATIC_VERSION ?>" rel="stylesheet">

	<!-- Font Awesome 6 -->
	<script src="https://kit.fontawesome.com/7a2f4548b7.js" crossorigin="anonymous"></script>

	<!-- Core Dependencies -->
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>