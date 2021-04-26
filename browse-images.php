<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">    
	<title>Browse Images</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<style><?php require_once "css/styles.css"?></style>
	
	<?php require_once 'code/DOA.class.php'; ?>
	<?php require_once 'code/functions.php'; ?>
</head>

<body>
<?php
	$searchCountry = "";
	$searchContinent = "";
    
	if(isset($_GET["country"])){
		$searchCountry = $_GET["country"];
	}
	if(isset($_GET["continent"])){
		$searchContinent = $_GET["continent"];
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
			    <h1>Travel Images</h1>
				<div class="jumbotron">
			        <form method="GET" action="browse-images.php" >
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
						<label>&emsp;Continent: </label>
						<select name = "continent">
						    <option value="">Any</option>
							<?php
							    $sql = "SELECT * FROM geocontinents";
		                        $stmt = $GLOBALS['pdo']->prepare($sql);
						        $stmt->execute();
						        $result = $stmt;
								while($row = $result->fetch()){
								    echo "<option value=\"".$row['ContinentCode']."\">".$row['ContinentName']."</option>";
								}
							?>
					    </select>
						<label>&emsp;</label>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>	
			    </div>
				<h3>Search Results</h3>
			    <?php
					if($searchCountry=="" && $searchContinent==""){
							$found = false;
							$image = new ImageDAO;
							$result = $image->getAll();
							
							while($row = $result->fetch()){
								getImages($row);
								$found = true;
							}
							if($found==false)
								echo "<p>No results</p>";	
					}
					else{
							$found = false;
							$image = new ImageDAO;
							$result = $image->getAllWithDetails();
							
							while($row = $result->fetch()){
								$canDisplay = true;
								if($searchCountry != ""){
									if($searchCountry != $row['CountryCodeISO'])
										$canDisplay = false;
								}
								if($searchContinent != ""){
									if($searchContinent != $row['Continent'])
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