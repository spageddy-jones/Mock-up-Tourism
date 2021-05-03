<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">    
	<title>Image</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
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
			    <?php 
				    $imID = "";
				    $title = "Error, data not found";
					$file = "";
					$user = "";
					$lat = "";
					$lon = "";
					$desc = "";
					$country = "";
					
					$city = "";
					$cityID = "";
					
					$ratingAvg = "";
					$ratingCount = 0;
					
					$postID = "0";
					$postName = "";
					
					$countryID = "";
					$userID = "";
					
					$userLink = "singleUser.php?uid=";
					$cityLink = "city.php?GeoNameID=";
					$countryLink = "country.php?iso=";
					
					
				    if(isset($_GET["id"])){
						$imID = $_GET["id"];
                        $image = new ImageDAO;
    					$result = $image->getByIDWithDetails($_GET["id"]);
	     				while($row = $result->fetch()){
					    	$title = $row["Title"];
							$file = $row["Path"];
							$user = $row["FirstName"] . " " . $row["LastName"];
							$lat = $row["Latitude"];
			                $lon = $row["Longitude"];
			                $desc = $row["Description"];
							$country = $row["CountryName"];
							$cityID = $row["CityCode"];
							$countryID = $row["CountryCodeISO"];
							$userID = $row["UID"];
		    			}
						//rating
						$result = $image->getAllRating($_GET["id"]);
						$ratingAvg = 0;
						$found = false;
						while($row = $result->fetch()){
							$found = true;
						    $ratingCount++;
							$ratingAvg += $row["Rating"];
						}
						if($found == true){
							$ratingAvg = $ratingAvg / $ratingCount;
				            $ratingAvg = round($ratingAvg, 1);
						}
						if($found == false){
						    $ratingAvg = "";	
						}
						//city
						$newCity = new CityDAO;
						$result = $newCity->getByID($cityID);
						while($row = $result->fetch()){
							$city = $row["AsciiName"];
						}
						
					}
					
					$userLink = $userLink . $userID;
					$cityLink = $cityLink . $cityID;
					$countryLink = $countryLink . $countryID;

				?>
				
				
				<h2><?php echo $title; ?></h2>
				<h4>By: <?php echo "<a href=\"".$userLink."\">". $user . "</a>"; ?></h4>
				
				<div class="col-md-9">
				    <div >
				        <?php echo 
						    "<a data-toggle=\"modal\" data-target=\"#modal\">
                                 <img src=\"images/medium/" . $file . "\" title=\"" . $title . "\" alt=\"" . $title . "\">
                            </a>
							
							<div class=\"modal fade\" role=\"dialog\" id=\"modal\">
							    <div class=\"modal-dialog modal-lg\">
								    <div class=\"modal-content\">
									    <div class=\"modal-header\">
										    <button type=\"button\" class=\"close\" data-dismiss=\"modal\"><b>X</b></button>
									        <h2 class=\"modal-title container\">".$title."</h2>
										    
										</div>
										<div class=\"modal-body\">
										    <img class=\"img-responsive\" src=\"images/large/" . $file . "\" title=\"" . $title . "\" alt=\"" . $title . "\">
										</div>
									</div>
							    </div>
							</div>"
							; 
						?>
			        </div>
				    <h4 class="panel"><?php echo $desc; ?></h4>
				</div>
				
				<div class="col-md-3">
				
				    <a href=<?php echo "\"addFavorite.php?id=".$imID."&type=image\""; ?> role="button" class="btn btn-default btn-lg" id="favButton"><span class="glyphicon glyphicon-heart"></span> Add to Favorites List</a>
					<div class="panel panel-info">
                        <div class="panel-heading">
                            <h4>Rating </h4>
                        </div>
					    <div class = "panel-body">
					        <h4><b><?php echo $ratingAvg; ?></b> [<?php echo $ratingCount; ?> reviews] </h4>
							<h4><a href= <?php echo "\"singleImageReviews.php?id=".$imID."\""; ?> >See Reviews</a></h4> 
					    </div>
				    </div>
				    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Image Details </h4>
                        </div>
					    <div class = "panel-body">
					        <h4><b>Country:</b> <?php echo "<a href=\"".$countryLink."\">". $country . "</a>"; ?></h4>
					    	<h4><b>City:</b> <?php echo "<a href=\"".$cityLink."\">". $city . "</a>"; ?></h4>
					    	<h4><b>Latitude:</b> <?php echo $lat; ?></h4>
					    	<h4><b>Longitude:</b> <?php echo $lon; ?></h4>
					    </div>
				    </div>
			    </div>
				<div class="col-md-12">
					<script>
						function googMap() {
						    var map = new google.maps.Map(document.getElementById("myMap"),
							                               {center:new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $lon; ?>), zoom:8,}
														 );
							var mark = new google.maps.Marker({position: {lat: <?php echo $lat; ?>, lng: <?php echo $lon; ?>}, 
							                                     map: map,
                                                              });
						}
                    </script>
					<div class="accordian">
					    <div>
						    <button class="btn btn-info btn-block" type="button" data-toggle="collapse" data-target="#collapseMap">Google Map</button>
						</div>
						<div id="collapseMap" class="collapse in">
						    <div id="myMap" style="width:100%;height:200px"></div>  
					    </div>
					</div>	
					<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUhVpkVC4RfvApJcjuOHPvFjx9fZ_M-WA&callback=googMap"></script>
				</div>
				<div class="clearfix"></div>
				<br>
				<div class="container col-md-12">
					<div class="panel panel-default">
						<?php
							if(isset($_SESSION["UID"])){
							$currentUser = new UserDAO;
							$review = new ReviewDAO;
							$userStmt = $currentUser->getByID($_SESSION["UID"]);
							$reviewStmt = $review->hasReviewed($_SESSION["UID"], $_GET["id"]);
							if($userRow = $userStmt->fetch() && !($reviewRow = $reviewStmt->fetch())){     //valid user AND has not reviewed this image
						?>
						<div class="panel-heading">Add a review</div>
						<div class="panel-body" id="reviewForm">
							<form method="post">
								<label>Rating:&nbsp;</label>
								<input type="radio" id="1" name="rating" value="1">
								<label for="1">1 star&nbsp;</label>
								<input type="radio" id="2" name="rating" value="2">
								<label for="2">2 stars&nbsp;</label>
								<input type="radio" id="3" name="rating" value="3">
								<label for="3">3 stars&nbsp;</label>
								<input type="radio" id="4" name="rating" value="4">
								<label for="4">4 stars&nbsp;</label>
								<input type="radio" id="5" name="rating" value="5">
								<label for="2">5 stars&nbsp;</label>
								<div class="comment">
									<textarea id="review" name="review" placeholder="Write a review..."></textarea>
								</div>
								<input class="btn btn-info" type="submit" value="Post Review">
							</form>
						</div>
						<?php
							if(isset($_POST['rating']))
							{
								$reviewStmt = $review->addNewReview($_GET['id'], $_POST['rating'], $_SESSION['UID'], $_POST['review']);
							}
							}
							else{
								echo '<div class="panel-heading">Add a review</div>
									<div class="panel-body" id="reviewForm">';
								echo 'Thank you for your review!</div>';
							}
							}
							else{
								echo '<div class="panel-heading">Add a review</div>
									<div class="panel-body" id="reviewForm">';
								echo 'Log in to leave a review</div>';
							}
						?>
						
					</div>				  

				  <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Appears in post: </h4>
                        </div>
					    <div class = "panel-body">
						    <?php 
							    $sql = "SELECT * FROM travelpostimages INNER JOIN travelpost ON travelpostimages.PostID = travelpost.PostID 
						        WHERE ImageID = " . $_GET["id"];
		                        $stmt = $GLOBALS['pdo']->prepare($sql);
						        $stmt->execute();
						        $result = $stmt;
						        while($row = $result->fetch()){
							        $postName = $row["Title"];
						    	    $postID = $row["PostID"];
									echo "<h4><a href=\"singlePost.php?id=".$postID."\">".$postName."</a></h4>";
						        }
							?>
					    </div>
				    </div>
				</div>
				<div class="row">
				<h3>Other Images From This Post</h3>
				<?php
				    $postFound = false;
				    $result = $image->getForPost($postID);
					while($row = $result->fetch()){
						if($row["ImageID"] != $_GET["id"]){
							$postFound = true;
						    getImages($row);
						}
					}
					if($postFound == false)
						echo "<h4>No other images found</h4>";
				?>
				</div>
				<div class = "row">
				    <h3>More Photos From <?php echo "<a href=\"".$countryLink."\">". $country . "</a>"; ?></h3>
				    <?php
			    	    $result = $image->getForCountry($countryID);
			    		while($row = $result->fetch()){
			    			if($row["ImageID"] != $_GET["id"])
			    			    getImages($row);
			    		}
				    ?>
				</div>
			</div>
			<div class="col-md-2">
				<img src="images/verticalBanner.jpg" alt="Time to travel!">
			</div>
		</div>
		<div class="row">
			<img src="images/horizontalBanner.jpg" alt="Time to travel!" class="responsive">
		</div>
</main>

</body>
</html>