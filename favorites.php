<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">    
	<title>Favorites</title>

	<link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<style><?php require_once "css/styles.css"?></style>
	
	<?php require_once 'code/DOA.class.php'; ?>
	<?php require_once 'code/functions.php'; ?>
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
			    <h1>My Favorites</h1>
				<hr>
				<div class="col-md-12">
				<h3>Images</h3>
			    <?php
							$found = false;
							$image = new ImageDAO;
							$result = $image->getAll();
							
							while($row = $result->fetch()){
								$canDisplay = false;
								
								$cName = "favoriteImage".$row['ImageID'];
								if(isset($_COOKIE[$cName])){
								    if($_COOKIE[$cName] == "t")
										$canDisplay = true;
								}
								
								if($canDisplay == true){
								    getImagesFav($row);
								    $found = true;
								}
							}
							if($found==false)
								echo "<p>None</p>";	
					
				?>
				</div>
				<div class="col-md-12">
				<h3>Posts</h3>
				<br>
			    <?php
							$found = false;
							$myPost = new PostDAO;
							$result = $myPost->getAll();
							
							while($row = $result->fetch()){
								$canDisplay = false;
								
								$cName = "favoritePost".$row['PostID'];
								if(isset($_COOKIE[$cName])){
								    if($_COOKIE[$cName] == "t")
										$canDisplay = true;
								}
								
								if($canDisplay == true){
								    echo "<h4><a href=\"singlePost.php?id=".$row['PostID']."\">".$row['Title']."</a></h4>";
									echo "<p>".$row['Message']."</p>";
									echo '<a href="addFavorite.php?id='.$row['PostID'].'&type=post&act=rem" class="btn btn-danger btn-sm" role="button">Remove</a></p>';
									echo "<br>";
								    $found = true;
								}
							}
							if($found==false)
								echo "<p>None</p>";	
					
				?>
				</div>
				
			</div>
		</div>
</main>

</body>
</html>