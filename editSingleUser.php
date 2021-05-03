<?php require_once 'code/functions.php'; ?>
<?php require_once 'code/DOA.class.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Project 3</title>     
	
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	
	<style><?php require_once "css/styles.css"?></style>

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
			if(!isset($_POST['newLastName'])) editUserInfo();
			else{
				$user = new userDAO;
				$stmt = $user->getByID($_GET['uid']);
				if($row = $stmt->fetch()){
					echo '<h4 class="panel">User info updated.</h4>';
					if(!empty($_POST['newFirstName'])) $fname = $_POST['newFirstName'];
					else $fname = $row['FirstName'];
					
					$lname = $_POST['newLastName'];
					$addr = $_POST['newAddress'];
					$city = $_POST['newCity'];
					$country = $_POST['newCountry'];
					
					if(!empty($_POST['newRegion'])) $region = $_POST['newRegion'];
					else $region = $row['Region'];
					if(!empty($_POST['newPostal'])) $postal = $_POST['newPostal'];
					else $postal = $row['Postal'];
					if(!empty($_POST['newPhone'])) $phone = $_POST['newPhone'];
					else $phone = $row['Phone'];
					if(!empty($_POST['newEmail'])) $email = $_POST['newEmail'];
					else $email = $row['Email'];
					
					$user->updateUserInfo($_GET['uid'], $fname, $lname, $addr, $city, $region, $country, $postal, $phone, $email);
				}
				editUserInfo();
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
</body>