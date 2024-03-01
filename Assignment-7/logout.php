<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Log out</title>
</head>
<body>
	<?php

	require __DIR__ . '/sessionManage.php';
	// Destroy the session.
	destroySession();
	?>

	<p>You have been Logged out</p>
</body>
</html>
