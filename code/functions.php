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
			echo '<div class="panel panel-primary">';
			echo '<div class="panel-heading">';
			echo '<h3 class="panel-title">Posts by this user</h3></div>';
			echo '<ul class="list-group">';
			while($row = $stmt->fetch()){
				echo '<li class="list-group-item">';
				echo '<a href="singlePost.php?id=' . $row["PostID"] . '"><h4>' . $row["Title"] . '</h4></a>';
				echo $row['Message'];
				echo '</li>';
			}
			echo '</ul></div>';
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
		echo '<h3>Images of this country:</h3>';
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
			</ul>';
		}
	}
}


function topRatings(){
	$thisImage = new ImageDAO;
	$first = 0;
	$firstRating = 0;
	$second = 0;
	$secondRating = 0;
	$third = 0;
	$thirdRating = 0;
	$fourth = 0;
	$fourthRating = 0;
	$totalRating = 0;
	$averageRating = 0;
	$ratingCount = 0;
	
	for($i=1; $i < 83; $i++){
		$totalRating = 0;
		$averageRating = 0;
		$ratingCount = 0;
		$stmt = $thisImage->getAllRating($i);
		while($row = $stmt->fetch()){
			$totalRating += $row['Rating'];
			$ratingCount++;
		}
		
		if($ratingCount != 0)
		$averageRating = $totalRating / $ratingCount;
		
		if($averageRating > $firstRating){
			$fourthRating = $thirdRating;
			$fourth = $third;
			$thirdRating = $secondRating;
			$third = $second;
			$secondRating = $firstRating;
			$second = $first;
			$firstRating = $averageRating;
			$first = $i;
		} 
		else if($averageRating > $secondRating){
			$fourthRating = $thirdRating;
			$fourth = $third;
			$thirdRating = $secondRating;
			$third = $second;
			$secondRating = $averageRating;
			$second = $i;
		}
		else if($averageRating > $thirdRating){
			$fourthRating = $thirdRating;
			$fourth = $third;
			$thirdRating = $averageRating;
			$third = $i;
		}
		else if($averageRating > $fourthRating){
			$fourthRating = $averageRating;
			$fourth = $i;
		}
	}
	$stmt = $thisImage->getByIDWithDetails($first);
	if($row = $stmt->fetch())
	getImages($row);
	$stmt = $thisImage->getByIDWithDetails($second);
	if($row = $stmt->fetch())
	getImages($row);
	$stmt = $thisImage->getByIDWithDetails($third);
	if($row = $stmt->fetch())
	getImages($row);
	$stmt = $thisImage->getByIDWithDetails($fourth);
	if($row = $stmt->fetch())
	getImages($row);
}

function getImages($row){
	echo '<div class="col-md-3 " >';
	echo '<div class="thumbnail imgThumb imagePanelHeight" >
		<a href="singleImage.php?id=' . $row['ImageID'] .'"><img src="images/square-medium/' . $row['Path'] . '" alt="Travel Image"></a>
		<div class="caption thumbCaption">
			<a href="singleImage.php?id=' . $row['ImageID'] .'" class="titleLink">' . $row['Title'] . '</a>
			<p class="thumbBtns"><a href="singleImage.php?id=' . $row['ImageID'] .'" class="btn btn-primary btn-sm" role="button"><span class="glyphicon glyphicon-info-sign">View</a>
			<a href="addFavorite.php?id='.$row['ImageID'].'&type=image" class="btn btn-success btn-sm" role="button"><span class="glyphicon glyphicon-heart">Favorite</a></p>
		</div>
	</div>
	</div>';
}

function getImagesFav($row){
	echo '<div class="col-md-3 " >';
	echo '<div class="thumbnail imgThumb imagePanelHeight" >
		<a href="singleImage.php?id=' . $row['ImageID'] .'"><img src="images/square-medium/' . $row['Path'] . '" alt="Travel Image"></a>
		<div class="caption thumbCaption">
			<a href="singleImage.php?id=' . $row['ImageID'] .'" class="titleLink">' . $row['Title'] . '</a>
			<p class="thumbBtns"><a href="singleImage.php?id=' . $row['ImageID'] .'" class="btn btn-primary btn-sm" role="button"><span class="glyphicon glyphicon-info-sign">View</a>
			<a href="addFavorite.php?id='.$row['ImageID'].'&type=image&act=rem" class="btn btn-danger btn-sm" role="button">Remove</a></p>
		</div>
	</div>
	</div>';
}

function favoriteImage($id){
    $cookieName = "favoriteImage".$id;
    setcookie($cookieName, "t"); 
}
function favoriteImageRem($id){
    $cookieName = "favoriteImage".$id;
    if(isset($_COOKIE[$cookieName]))
        setcookie($cookieName, "f"); 
}


function favoritePost($id){
	$cookieName = "favoritePost".$id;
    setcookie($cookieName, "t"); 
}
function favoritePostRem($id){
	$cookieName = "favoritePost".$id;
	if(isset($_COOKIE[$cookieName]))
        setcookie($cookieName, "f"); 
}

?>