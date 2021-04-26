<?php require_once 'code/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">    
	<title>City</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<style><?php require_once "css/styles.css"?></style>
</head>

<body>
<header>
	<?php require_once "code/header.php" ?>
</header>

<main>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2">
				<?php require_once 'code/leftNav.php'; ?>
		</div>
		<div class="col-md-8">
			<?php cityInfo(); 
			$cityInfo = new CityDAO;
			$stmt = $cityInfo->getById($_GET['GeoNameID']);
			if($row = $stmt->fetch()){
				$lat = $row['Latitude'];
				$lon = $row['Longitude'];
			}
			?>
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
			<?php
			$cityImages = new ImageDAO;
			$stmt = $cityImages->getForCity($_GET["GeoNameID"]);
			echo '<h3>Images of this city:</h3>';
			while($row = $stmt->fetch()){
				getImages($row);
			}?>
		</div>
		<div class="col-md-2">
			<img src="images/verticalBanner.jpg" alt="Time to travel!">
		</div>
	</div>
	<div class="row">
		<img src="images/horizontalBanner.jpg" alt="Time to travel!" class="responsive">
	</div>
</body>
</html>