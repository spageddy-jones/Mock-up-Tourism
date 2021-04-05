<?php
require_once('config.php');
class BaseDAO{
		function __construct(){
			$pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
}

class PostDAO extends BaseDAO{
	
	function getAll(){
		$sql = "SELECT * FROM travelposts";
		$stmt = $pdo->prepare($sql);
		$stmt = $pdo->execute();
		return $stmt;
	}
	
	function getByID($id){
		$sql = "SELECT * FROM travelposts WHERE PostID=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt = $pdo->execute();
		return $stmt;
	}
	
	function getForUser($uid){
		$sql = "SELECT * FROM travelpost WHERE UID=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $uid);
		$stmt = $pdo->execute();
		return $stmt;
	}
	
}

class CityDAO extends BaseDAO{
	
	function getAll(){
		$sql = "SELECT * FROM geocities";
		$stmt = $pdo->prepare($sql);
		$stmt = $pdo->execute();
		return $stmt;
	}
	
	function getByID($id){
		$sql = "SELECT * FROM geocities WHERE GeoNameID=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt = $pdo->execute();
		return $stmt;
	}
	
	function getForCountry($countryName){
		$sql = "SELECT * FROM geocities INNER JOIN geocountries ON geocities.CountryCodeISO = geocountries.ISO WHERE CountryName=:name";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':name', $countryName);
		$stmt = $pdo->execute();
		return $stmt;
	}
	
}

class CountryDAO extends BaseDAO{
	
	function getAll(){
		$sql = "SELECT * FROM geocountries INNER JOIN travelimagedetails ON geocountries.ISO = travelimagedetails.CountryCodeISO 
			GROUP BY travelimagedetails.CountryCodeISO";
		$stmt = $pdo->prepare($sql);
		$stmt = $pdo->execute();
		return $stmt;
	}
	
	function getByISO($id){
		$sql = "SELECT * FROM geocountries WHERE ISO=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt = $pdo->execute();
		return $stmt;
	}
	
}



class UserDAO extends BaseDAO{
	
	function getAll(){
		$sql = "SELECT * FROM traveluser";
		$stmt = $pdo->prepare($sql);
		$stmt = $pdo->execute();
		return $stmt;
	}
	
	function getByID($id){
		$sql = "SELECT * FROM traveluser WHERE UID=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt = $pdo->execute();
		return $stmt;
	}
	
	function getForCountry($countryName){
		$sql = "SELECT * FROM traveluserdetails WHERE Country=:name";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':name', $countryName);
		$stmt = $pdo->execute();
		return $stmt;
	}
	
}

class ImageDAO extends BaseDAO{
	
	function getAll(){
		$sql = "SELECT * FROM travelimage";
		$stmt = $pdo->prepare($sql);
		$stmt = $pdo->execute();
		return $stmt;
	}
	
	function getByID($id){
		$sql = "SELECT * FROM travelimage WHERE ImageID=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt = $pdo->execute();
		return $stmt;
	}
	
	function getForPost($pid){
		$sql = "SELECT * FROM travelpostimages WHERE PostID=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $pid);
		$stmt = $pdo->execute();
		return $stmt;
	}
	
	function getForUser($uid){
		$sql = "SELECT * FROM travelimage WHERE UID=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $uid);
		$stmt = $pdo->execute();
		return $stmt;
	}
	function getForCity($cityCode){
		$sql = "SELECT * FROM travelimagedetails WHERE CityCode=:cc";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':cc', $cityCode);
		$stmt = $pdo->execute();
		return $stmt;
	}
	function getForCountry($countryName){
		$sql = "SELECT * FROM travelimagedetails INNER JOIN geocountries ON geocountries.ISO = travelimagedetails.CountryCodeISO WHERE CountryName=:name";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':name', $countryName);
		$stmt = $pdo->execute();
		return $stmt;
	}
	function getByRating($rating){
		
	}
}

?>