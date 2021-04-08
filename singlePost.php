<?php require_once 'DOA.class.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">    
	<title>About</title>

	<link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
	<style><?php require_once "styles.css"; ?></style>
</head>

<body>
<header>
<?php require_once "header.php"; ?>
</header>

<main class="container-fluid">
	<div class="row">
		<div class="col-md-12">
		<?php
			$thisPost = new PostDAO;
			$stmt = $thisPost->getByID($_GET['id']);
			if($row = $stmt->fetch()){
				echo "<h2>" . $row['Title'] . "</h2>";
			}
		?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<?php
				if ($row){
					echo $row['Message']; 
				}
			?>
		</div>
		<div class="col-md-6">
			<button type="button" class="btn btn-default btn-lg" id="favButton"><span class="glyphicon glyphicon-heart"></span> Add to Favorites List</button>
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-default">
					  <!-- Default panel contents -->
						<div class="panel-heading">Post Details</div>
					  <!-- List group -->
						<ul class="list-group">
							<li class="list-group-item"><strong>Date: </strong><?php if($row) {
								echo date("M-d-Y", mktime(0, 0, 0, substr($row['PostTime'], 5, 2), substr($row['PostTime'], 8, 2), substr($row['PostTime'], 0, 4))+1);
								} ?> </li>
							<li class="list-group-item"><strong>Posted By: </strong>
								<?php 
									$thisUser = new UserDAO;
									$stmt = $thisUser->getForPost($_GET['id']);
									if($row = $stmt->fetch()){
										echo '<a href="singleUser.php?uid=' . $row['UID'] . '">' . $row['FirstName'] . " " . $row['LastName'] . "</a>";
									}
								?>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h3>Travel images for this post</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php 
				$imagesForPost = new ImageDAO;
				$stmt = $imagesForPost->getForPost($_GET['id']);
				while($row = $stmt->fetch()){
					echo '<div class="col-md-2">';
					echo '<div class="thumbnail imgThumb">
						<img src="images/square-medium/' . $row['Path'] . '" alt="Travel Image">
						<div class="caption thumbCaption">
							<a href="Part03_SingleImage.php?id=' . $row['ImageID'] .'" id="titleLink">' . $row['Title'] . '</a>
							<p class="thumbBtns"><a href="singleImage.php?id=' . $row['ImageID'] .'" class="btn btn-primary btn-sm" role="button"><span class="glyphicon glyphicon-info-sign">View</a>
							<a href="#" class="btn btn-success btn-sm" role="button"><span class="glyphicon glyphicon-heart">Favorite</a></p>
						</div>
						</div>
						</div>';
				}
			?>
		</div>
	</div>
</main>

</body>

</html>