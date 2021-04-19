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
    if(isset($_POST["search"])){
		$searchTerm = $_POST["search"];
	}
	if(isset($_POST["type"])){
		$searchType = $_POST["type"];
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
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>	
			    </div>
				<h3>Search Results</h3>
			    <?php
					if($searchTerm!=""){
						if($searchType == "imageTitle"){
							$found = false;
							$image = new ImageDAO;
							$result = $image->getByString($searchTerm);
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
							$result = $post->getByString($searchTerm);
							while($row = $result->fetch()){
								echo "<h3><a href=\"singlePost.php?id=".$row["PostID"]."\">".$row["Title"]."</a></h3>";
								echo "<p>".$row["Message"]."</p> 
								<button type=\"button\" class=\"btn btn-default btn-lg\" id=\"favButton\"><span class=\"glyphicon glyphicon-heart\"></span> Add to Favorites List</button>
								<br><br>";
								$found = true;
							}
							if($found==false)
								echo "<p>No results</p>";
						}
					}
				?>
			</div>
		</div>
</main>

</body>
</html>