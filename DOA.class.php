<?php
require_once('config.php');
$pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);

class PostDAO{
	
	function getAll(){
		$sql = "SELECT * FROM travelposts";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
	
	function getByID($id){
		$sql = "SELECT * FROM travelpost WHERE PostID=:id";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt;
	}
	
	function getForUser($uid){
		$sql = "SELECT * FROM travelpost WHERE UID=:id";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->bindValue(':id', $uid);
		$stmt->execute();
		return $stmt;
	}
	
}

class CityDAO{
	
	function getAll(){
		$sql = "SELECT * FROM geocities INNER JOIN travelimagedetails ON travelimagedetails.CityCode = geocities.GeoNameID
			GROUP BY geocities.GeoNameID ORDER BY geocities.AsciiName ASC";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
	
	function getByID($id){
		$sql = "SELECT * FROM geocities WHERE GeoNameID=:id";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt;
	}
	
	function getForCountry($countryName){
		$sql = "SELECT * FROM geocities INNER JOIN geocountries ON geocities.CountryCodeISO = geocountries.ISO WHERE CountryName=:name";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->bindValue(':name', $countryName);
		$stmt->execute();
		return $stmt;
	}
	
}

class CountryDAO{
	
	function getAll(){
		$sql = "SELECT * FROM geocountries INNER JOIN travelimagedetails ON geocountries.ISO = travelimagedetails.CountryCodeISO 
			GROUP BY travelimagedetails.CountryCodeISO ORDER BY geocountries.CountryName ASC";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
	
	function getByISO($id){
		$sql = "SELECT * FROM geocountries WHERE ISO=:id";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt;
	}
	
}



class UserDAO{
	
	function getAll(){
		$sql = "SELECT * FROM traveluser";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
	
	function getByID($id){
		$sql = "SELECT * FROM traveluser WHERE UID=:id";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt;
	}
	
	function getForPost($pid){
		$sql = "SELECT * FROM traveluserdetails INNER JOIN travelpost ON travelpost.UID = traveluserdetails.UID WHERE travelpost.PostID=:id";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->bindValue(':id', $pid);
		$stmt->execute();
		return $stmt;
	}
	
	function getForCountry($countryName){
		$sql = "SELECT * FROM traveluserdetails WHERE Country=:name";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->bindValue(':name', $countryName);
		$stmt->execute();
		return $stmt;
	}
	
}

class ImageDAO{
	
	function getAll(){
		$sql = "SELECT * FROM travelimage";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
	
	function getByID($id){
		$sql = "SELECT * FROM travelimage WHERE ImageID=:id";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt;
	}
	
	function getForPost($pid){
		$sql = "SELECT * FROM travelpost INNER JOIN travelpostimages ON travelpost.PostID = travelpostimages.PostID INNER JOIN travelimagedetails ON
					travelimagedetails.ImageID = travelpostimages.ImageID INNER JOIN travelimage ON travelimage.ImageID = travelpostimages.ImageID WHERE travelpost.PostID=:id";;
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->bindValue(':id', $pid);
		$stmt->execute();
		return $stmt;
	}
	
	function getForUser($uid){
		$sql = "SELECT * FROM travelimage WHERE UID=:id";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->bindValue(':id', $uid);
		$stmt->execute();
		return $stmt;
	}
	function getForCity($cityCode){
		$sql = "SELECT * FROM travelimagedetails WHERE CityCode=:cc";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->bindValue(':cc', $cityCode);
		$stmt->execute();
		return $stmt;
	}
	function getForCountry($countryName){
		$sql = "SELECT * FROM travelimagedetails INNER JOIN geocountries ON geocountries.ISO = travelimagedetails.CountryCodeISO WHERE CountryName=:name";
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->bindValue(':name', $countryName);
		$stmt->execute();
		return $stmt;
	}
	function getByRating($rating){
		
	}
}

?>