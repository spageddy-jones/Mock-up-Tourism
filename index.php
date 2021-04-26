
<?php
require_once 'code/functions.php';
?>

<?php require_once 'code/DOA.class.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Project 3</title>     
	
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	
	<style><?php require_once "css/styles.css"?></style>

</head>
<body>
	
	<?php require_once 'code/header.php'; ?>
	
	<main class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<?php require_once 'code/leftNav.php'; ?>
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
								<img src="images/travelCarousel2.jpeg" alt="planeBG" class="carouselImg">
								<div class="carousel-caption">
									<h2>Share</h2>
									<h3 class="desc">Share your photos with the world</h4>
								</div>
							</div>
							<div class="item">
								<img src="images/travelCarousel3.jpg" alt="suitcase" class="carouselImg">
								<div class="carousel-caption">
									<h2>Featured</h2>
									<h3 class="desc">Find your next travel destination!</h4>
								</div>
							</div>
							<div class="item">
								<img src="images/travelCarousel1.jpg" alt="travel" class="carouselImg">
								<div class="carousel-caption">
									<h2>Review</h2>
									<h3 class="desc">See what people have to say</h4>
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
				<div class="accordian">
					<div>
						<button class="btn btn-info btn-block" type="button" data-toggle="collapse" data-target="#topImages">Top Images</button>
					</div>
						<div class="collapse in">
						    <div id="myTopImages" style="width:100%;height:1em"></div>  
					    </div>
					</div>	
				</div>
				<div class="row">
					<div class="collapse" id="topImages">
					<?php topRatings();?>
					</div>
				</div>
				<div class="row">
				<div class="accordian">
					<div>
						<button class="btn btn-info btn-block" type="button" data-toggle="collapse" data-target="#newAdditions">New Additions</button>
					</div>
						<div class="collapse in">
						    <div id="myNewAdditions" style="width:100%;height:1em"></div>  
					    </div>
					</div>	
				</div>
				<div class="row">
					<div class="collapse" id="newAdditions">
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
				<div class="row">
				<div class="accordian">
					<div>
						<button class="btn btn-info btn-block" type="button" data-toggle="collapse" data-target="#recentReviews">Recent Reviews</button>
					</div>
						<div class="collapse in">
						    <div id="myTopImages" style="width:100%;height:1em"></div>  
					    </div>
					</div>	
				</div>
				<div class="row">
					<div class="collapse" id="recentReviews">
					<?php
					$recentReviews = new ReviewDAO;
					$stmt = $recentReviews->getMostRecent();
					for($i = 0; $i < 2; $i++){
						$row = $stmt->fetch();
						echo '<div class="panel panel-info">
							<div class="panel-body"><a href="singleImage.php?id=' . $row['ImageID'] . '">'
							. $row['Review'] .
							'</a></div>
							</div>';
					}
					?>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<img src="images/verticalBanner.jpg" alt="Trip and travel">
			</div>
		</div>
		<div class="row">
			<img src="images/horizontalBanner.jpg" alt="Time to travel!" class="responsive">
		</div>
	</main>
	
	</body>

</html>