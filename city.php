<?php require_once 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">    
	<title>About</title>

	<link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
	<style><?php require_once "styles.css"?></style>
</head>

<body>
<header>
	<?php require_once "header.php" ?>
</header>

<main>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2">
				<?php require_once 'leftNav.php'; ?>
		</div>
		<div class="col-md-10">
			<?php cityInfo(); ?>
		</div>
</body>
</html>