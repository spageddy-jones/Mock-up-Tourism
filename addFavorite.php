<!DOCTYPE html>

<?php require_once 'code/DOA.class.php'; ?>
<?php require_once 'code/functions.php'; ?>

<?php
	$favType = "";
	$favID = "";
	$favAct = "add";
    
	if(isset($_GET["type"])){
		$favType = $_GET["type"];
	}
	if(isset($_GET["id"])){
		$favID = $_GET["id"];
	}
	if(isset($_GET["act"])){
		$favAct = $_GET["act"];
	}
	
	if($favAct == "add"){
		if($favType == "post")
			favoritePost($favID);
		else
			favoriteImage($favID);
	}
	else if($favAct == "rem"){
		if($favType == "post")
			favoritePostRem($favID);
		else
			favoriteImageRem($favID);
	}
	
	header("Location: favorites.php");
	
?>

<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">    
	<title>Add Favorite</title>

	<link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<style><?php require_once "css/styles.css"?></style>
	
	
</head>

<body>

<header>
	<?php require_once "code/header.php" ?>
</header>

<main class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<?php require_once 'code/leftNav.php'; ?>
			</div>
			<div class="col-md-8">
			    <h1>Error Adding Favorite</h1>
				
			</div>
		</div>
</main>

</body>
</html>