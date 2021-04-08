<?php require_once 'DOA.class.php'; 
require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Project 3</title>     
	
    <link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
	<style><?php require_once "styles.css"?></style>

</head>
<body>
	
	<?php require_once 'header.php'; ?>
	
	<main class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<?php require_once 'leftNav.php'; ?>
			</div>
			<div class="col-md-8">
				<div class="row" id="carouselRow">
					<div id="indexCarousel" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#indexCarousel" data-slide-to="0" class="active"></li>
							<li data-target="#indexCarousel" data-slide-to="1"></li>
							<li data-target="#indexCarousel" data-slide-to="2"></li>
						</ol>
						
						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							<div class="item active">
								<img src="travelCarousel2.jpeg" alt="planeBG" class="carouselImg">
								<div class="carousel-caption">
									<h2>Share</h2>
									<h4>Share your photos with the world</h4>
								</div>
							</div>
							<div class="item">
								<img src="travelCarousel3.jpg" alt="suitcase" class="carouselImg">
								<div class="carousel-caption">
									<h2>Featured</h2>
									<h4>Find your next travel destination!</h4>
								</div>
							</div>
							<div class="item">
								<img src="travelCarousel1.jpg" alt="travel" class="carouselImg">
								<div class="carousel-caption">
									<h2>Review</h2>
									<h4>See what people have to say</h4>
								</div>
							</div>
						</div>
						
						<!-- Controls -->
						<a class="left carousel-control" href="#indexCarousel" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#indexCarousel" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<h4>Top Images</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h4>New Additions</h4>
					</div>
				</div>
				<div class="row">
				<?php
				$newImages = new ImageDAO;
				$stmt = $newImages->getAll();
				for($i = 0; $i < 4; $i++){
					$row = $stmt->fetch();
					getImages($row);
				}
				?>
				</div>
			</div>
		</div>
	</main>
	
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>