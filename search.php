<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">    
	<title>Search</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<style><?php require_once "css/styles.css"?></style>
	
	<?php require_once 'code/DOA.class.php'; ?>
	<?php require_once 'code/functions.php'; ?>
</head>

<body>
<?php
    $searchTerm = "";
	$searchType = "imageTitle";
	$searchOrder = "a";
	$searchCountry = "";
	$searchCity = "";
    if(isset($_POST["search"])){
		$searchTerm = $_POST["search"];
	}
	if(isset($_POST["type"])){
		$searchType = $_POST["type"];
	}
	if(isset($_POST["order"])){
		$searchOrder = $_POST["order"];
	}
	if(isset($_POST["country"])){
		$searchCountry = $_POST["country"];
	}
	if(isset($_POST["city"])){
		$searchCity = $_POST["city"];
	}
?>
<header>
	<?php require_once "code/header.php" ?>
</header>

<main class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<?php require_once 'code/leftNav.php'; ?>
			</div>
			<div class="col-md-8">
			    <h1>Search</h1>
				<div class="jumbotron">
			        <form method="POST" action="search.php" >
                        <input type="text" name="search" placeholder="Enter search term" class="form-control"><br>
                        <input type="radio" name="type" value="imageTitle" <?php if($searchType=="imageTitle"){ echo "checked";} ?>><label>Search By Image Title</label><br><br>
					    <input type="radio" name="type" value="postTitle"<?php if($searchType=="postTitle"){ echo "checked";} ?>><label>Search By Post Title</label><br><br>
                        <input type="radio" name="type" value="imageLocation"<?php if($searchType=="imageLocation"){ echo "checked";} ?>><label>Search By Image Location -</label>
						<label>&emsp;Country: </label>
						<select name = "country">
						    <option value="">Any</option>
							<?php
							    $myCountries = new CountryDAO;
								$result = $myCountries->getAll();
								while($row = $result->fetch()){
								    echo "<option value=\"".$row['ISO']."\">".$row['CountryName']."</option>";
								}
							?>
					    </select>
						<label>&emsp;City: </label>
						<select name = "city">
						    <option value="">Any</option>
							<?php
							    $myCity = new CityDAO;
								$result = $myCity->getAll();
								while($row = $result->fetch()){
								    echo "<option value=\"".$row['GeoNameID']."\">".$row['AsciiName']."</option>";
								}
							?>
					    </select>
						<br><br>
						<label>Sort Order: &emsp;</label>
						<input type="radio" name="order" value="a"<?php if($searchOrder=="a"){ echo "checked";} ?>><label>Ascending &emsp;</label>
						<input type="radio" name="order" value="d"<?php if($searchOrder=="d"){ echo "checked";} ?>><label>Descending &emsp;</label>
						<br><br>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>	
			    </div>
				<h3>Search Results</h3>
			    <?php
					if($searchTerm!=""){
						if($searchType == "imageTitle"){
							$found = false;
							$image = new ImageDAO;
							
							if($searchOrder != "d")
							    $result = $image->getByString($searchTerm);
							else 
								$result = $image->getByStringDescending($searchTerm);
							
							while($row = $result->fetch()){
								getImages($row);
								$found = true;
							}
							if($found==false)
								echo "<p>No results</p>";
						}
						else if($searchType == "postTitle"){
							$found = false;
							$post = new PostDAO;
							if($searchOrder != "d")
							    $result = $post->getByString($searchTerm);
							else
								$result = $post->getByStringDescending($searchTerm);
							while($row = $result->fetch()){
								echo "<h3><a href=\"singlePost.php?id=".$row["PostID"]."\">".$row["Title"]."</a></h3>";
								echo "<p>".$row["Message"]."</p>
								<a href=\"addFavorite.php?id=".$row["PostID"]."&type=post\" role=\"button\" class=\"btn btn-default btn-lg\" id=\"favButton\"><span class=\"glyphicon glyphicon-heart\"></span> Add to Favorites List</a>
								<br><br>";
								$found = true;
							}
							if($found==false)
								echo "<p>No results</p>";
						}
						
					}
					if($searchType == "imageLocation"){
							$found = false;
							$image = new ImageDAO;
							if($searchTerm!=""){
								if($searchOrder != "d")
							        $result = $image->getByString($searchTerm);
							    else 
								    $result = $image->getByStringDescending($searchTerm);
							}
							else{
								if($searchOrder != "d")
								    $result = $image->getAllOrderTitle();
								else
									$result = $image->getAllOrderTitleDescending();
							}
							while($row = $result->fetch()){
								$canDisplay = true;
								if($searchCountry != ""){
									if($searchCountry != $row['CountryCodeISO'])
										$canDisplay = false;
								}
								if($searchCity != ""){
									if($searchCity != $row['CityCode'])
										$canDisplay = false;
								}
								
								if($canDisplay == true){
								    getImages($row);
								    $found = true;
								}
							}
							if($found==false)
								echo "<p>No results</p>";
					}
				?>
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