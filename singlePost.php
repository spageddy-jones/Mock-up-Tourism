<?php require_once 'code/DOA.class.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">    
	<title>About</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<style><?php require_once "css/styles.css"; ?></style>
	
	<?php require_once "code/functions.php"; ?>
</head>

<body>
<header>
<?php require_once "code/header.php"; ?>

<?php
    $myID = "";
    if(isset($_GET['id']))
		$myID = $_GET['id'];
?>
</header>

<main class="container-fluid">
	<div class="row">
		<div class="col-md-2">
				<?php require_once 'code/leftNav.php'; ?>
		</div>
		<div class="col-md-8">
		<?php
			$thisPost = new PostDAO;
			$stmt = $thisPost->getByID($_GET['id']);
			if($row = $stmt->fetch()){
				echo "<h2>" . $row['Title'] . "</h2>";
			}
			if ($row){
				echo $row['Message']; 
			}
			?>
			<div class="col-md-12">
				<h3>Travel images for this post</h3>
				<?php 
					$imagesForPost = new ImageDAO;
					$stmt = $imagesForPost->getForPost($_GET['id']);
					while($row = $stmt->fetch()){
						getImages($row);
					}
				?>
			</div>
			
		</div>
		<br><br><br>
		<div class="col-md-2">
			<a href=<?php echo "\"addFavorite.php?id=".$myID."&type=post\""; ?> 
				role="button" class="btn btn-default btn-lg" id="favButton"><span class="glyphicon glyphicon-heart"></span> Add to Favorites List</a>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
					  <!-- Default panel contents -->
						<div class="panel-heading">Post Details</div>
					  <!-- List group -->
						<ul class="list-group">
							<?php
								$thisPost = new PostDAO;
								$stmt = $thisPost->getByID($_GET['id']);
								$row = $stmt->fetch();
							?>
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
		
		<div class="col-md-2">
			<img src="images/verticalBanner.jpg" alt="Time to travel!">
		</div>

	    <div class="row">
			
	    </div>
		<div class="row">
			<img src="images/horizontalBanner.jpg" alt="Time to travel!" class="responsive">
		</div>
	</div>
</main>

</body>

</html>