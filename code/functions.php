<?php require_once 'DOA.class.php';
function userInfo(){
	if(isset($_GET["uid"])){
		$thisUser = new UserDAO;
		$stmt = $thisUser->getByID($_GET["uid"]);
		if($row = $stmt->fetch()){
			echo '<ul class="list-group" id="userInfo">
					<li class="list-group-item "><h3>' . $row['FirstName'] . " " . $row['LastName'] .'</h3></li>';
			if ($row['Privacy'] == 2){
				echo '<li class="list-group-item"><strong>Address:</strong> Hidden</li>
					<li class="list-group-item"><strong>City:</strong> ' . $row['City'] . '</li>
					<li class="list-group-item"><strong>Region:</strong> ' . $row['Region'] . '</li>
					<li class="list-group-item"><strong>Country:</strong> ' . $row['Country'] . '</li>
					<li class="list-group-item"><strong>Postal:</strong> Hidden</li>
					<li class="list-group-item"><strong>Phone:</strong> Hidden</li>
					<li class="list-group-item"><strong>Email:</strong> ' . $row['Email'] . '</li>
				</ul>';
			}
			else{
				echo '<li class="list-group-item"><strong>Address:</strong> ' . $row['Address'] . '</li>
					<li class="list-group-item"><strong>City:</strong> ' . $row['City'] . '</li>
					<li class="list-group-item"><strong>Region:</strong> ' . $row['Region'] . '</li>
					<li class="list-group-item"><strong>Country:</strong> ' . $row['Country'] . '</li>
					<li class="list-group-item"><strong>Postal:</strong> ' . $row['Postal'] . '</li>
					<li class="list-group-item"><strong>Phone:</strong> ' . $row['Phone'] . '</li>
					<li class="list-group-item"><strong>Email:</strong> ' . $row['Email'] . '</li>
				</ul>';
			}

			$userPosts = new PostDAO;
			$stmt = $userPosts->getForUser($_GET["uid"]);
			echo '<h3>Posts by this user:</h3>';
			while($row = $stmt->fetch()){
				echo '<a href="singlePost.php?id=' . $row["PostID"] . '"><h4>' . $row["Title"] . '</h4></a>';
				echo '<p class="message">' . $row['Message'] . '</p>';
			}
			
			$userImages = new ImageDAO;
			$stmt = $userImages->getForUser($_GET["uid"]);
			echo '<h3>Images by this user:</h3>';
			while($row = $stmt->fetch()){
				getImages($row);
			}
		}
	}
}

function countryInfo(){
	if (isset($_GET["iso"])){
		$thisCountry = new CountryDAO;
		$stmt = $thisCountry->getByISO($_GET["iso"]);
		if($row = $stmt->fetch()){
			echo '<ul class="list-group" id="countryInfo">
				<li class="list-group-item "><h3><img src="images/flags/' . $row['ISO'] . '.png" alt="flag"> ' . $row['CountryName'] . '</h3></li>
				<li class="list-group-item"><strong>Capital:</strong> ' . $row['Capital'] . '</li>
				<li class="list-group-item"><strong>Area:</strong> ' . $row['Area'] . ' sq km</li>
				<li class="list-group-item"><strong>Population:</strong> ' . $row['Population'] . '</li>
				<li class="list-group-item"><strong>Continent:</strong> ' . $row['Continent'] . '</li>
				<li class="list-group-item"><strong>Currency:</strong> ' . $row['CurrencyCode'] . '</li>
				<li class="list-group-item"><strong>Description:</strong> ' . $row['CountryDescription'] . '</li>
			</ul>';
		}
		
		$countryImages = new ImageDAO;
		$stmt = $countryImages->getForCountry($_GET["iso"]);
		echo '<h3>Images of this city:</h3>';
		while($row = $stmt->fetch()){
				getImages($row);
		}
	}
}

function cityInfo(){
	if (isset($_GET["GeoNameID"])){
		$thisCity = new CityDAO;
		$stmt = $thisCity->getByID($_GET["GeoNameID"]);
		if($row = $stmt->fetch()){
			echo '<ul class="list-group" id="countryInfo">
				<li class="list-group-item "><h3>' . $row['AsciiName'] . '</h3></li>
				<li class="list-group-item"><strong>Population:</strong> ' . $row['Population'] . '</li>
				<li class="list-group-item"><strong>Elevation:</strong> ' . $row['Elevation'] . '</li>
				<li class="list-group-item"><strong>Country:</strong> ' . $row['CountryName'] . '</li>
				<li class="list-group-item"><strong>Map:</strong></li>
			</ul>';
		}
		
		$cityImages = new ImageDAO;
		$stmt = $cityImages->getForCity($_GET["GeoNameID"]);
		echo '<h3>Images of this city:</h3>';
		while($row = $stmt->fetch()){
				getImages($row);
		}
	}
}

function getImages($row){
	echo '<div class="col-md-3">';
	echo '<div class="thumbnail imgThumb">
		<img src="images/square-medium/' . $row['Path'] . '" alt="Travel Image">
		<div class="caption thumbCaption">
			<a href="singleImage.php?id=' . $row['ImageID'] .'" id="titleLink">' . $row['Title'] . '</a>
			<p class="thumbBtns"><a href="singleImage.php?id=' . $row['ImageID'] .'" class="btn btn-primary btn-sm" role="button"><span class="glyphicon glyphicon-info-sign">View</a>
			<a href="#" class="btn btn-success btn-sm" role="button"><span class="glyphicon glyphicon-heart">Favorite</a></p>
		</div>
	</div>
	</div>';
}

?>