<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">    
	<title>About</title>

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
			<div class="row">
				<div class="jumbotron" id="aboutJumbotron">
					<h2>This site is an assignment for a Web Development class.</h2>
				</div>
				<div class="panel panel-info">
					<div class="panel-heading">Robin Oster</div>
					<div class="panel-body">
						Robin was responsible for the home page, the header, and the navigation sections seen to the left. They also customized
						the bootstrap theme, wrote browse-posts.php, browse-users.php, city.php, country.php, singlePost.php, singleUser.php,
						the some of the functions within functions.php, and writing some of the base classes for DOA.class.php. In the second part of the project,
						they were responsible for adding the travel banners, the ability to add reviews, displaying recent reviews on the front
						page, and adding the ability for admins to edit user info, as well as further expanding DOA.class.php and functions.php.
					</div>
				</div>
				<div class="panel panel-info">
					<div class="panel-heading">Nathan Fahey</div>
					<div class="panel-body">
						Nathan was responsible for writing browse-images.php and singleImage.php, as well as implementing the site's seach, advanced seach, 
						and favorite functionality. He also expanded the classes in DOA.class.php, adding the getByString, getByStringDescending, getAllOrderTitle,
						getAllOrderTitleDescending, getByIDWithDetails, get getAllWithDetails, and getAllRating methods. In the second part of the
						project, Nathan further expanded upon DOA.class.php and functions.php, and was responsible for implementing the login and 
						registration functionalities, as well as the browse reviews pages.
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<img src="images/verticalBanner.jpg" alt="Time to travel!">
		</div>
	</div>
	<div class="row">
		<img src="images/horizontalBanner.jpg" alt="Time to travel!" class="responsive">
	</div>
</div>
</main>

	</body>