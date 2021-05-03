<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">    
	<title>Reviews</title>

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
				
				
				
				
				<div class="col-md-12"> 
				    <div class="col-md-5" >
				        <?php echo "<img src=\"images/small/" . $file . "\" title=\"" . $title . "\" alt=\"" . $title . "\">"; ?>
					</div>
					<div class="col-md-7">
			            <h3><?php echo "<a href=\"singleImage.php?id=".$imID."\">".$title."</a>"; ?></h3>
				        <h4>By: <?php echo "<a href=\"".$userLink."\">". $user . "</a>"; ?></h4>
						<p>Country: <?php echo $country; ?></p><p> City: <?php echo $city; ?></p>
						<h3><b>Rating: <?php echo $ratingAvg; ?> [<?php echo $ratingCount; ?> reviews] </b></h3>
						
					</div>
				</div>
				
				<div class="col-md-12">
				    <h2>Reviews</h2>
					<hr>
					
					<?php
					if(isset($_GET["id"])){
					    $result = $image->getAllRating($_GET["id"]);
						while($row = $result->fetch()){
							echo "<h3><b>".$row["Rating"]."/5</b></h3>";
							//$myID = 16; //for testing
							$myID = $row["UID"];
							$myUser = new UserDAO;
    			            $myresult = $myUser->getByID($myID); 
				            $myname = "";
				            if($myrow = $myresult->fetch()){
					             $myname = $myrow["FirstName"]." ".$myrow["LastName"];
				            }
							$date = $row["datecreated"];
							if($date == "0000-00-00")
								$date = "unknown";
							if($myname == "")
								$myname = "unknown";
							echo "<h4>Posted By: ".$myname."</h4>";
							echo "<h4>Date Posted: ".$date."</h4>";
							echo "<p>".$row["comment"]."</p>";
							echo "<br>";
						}
					}
					
					?>
					
			    </div>
				
			</div>
		</div>
</main>

</body>
</html>