<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">    
	<title>Register</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	
	<style><?php require_once "css/styles.css"?></style>
</head>

<body>
<header>
	<?php require_once "code/header.php" ?>
</header>

<?php
    //session_start();   //now done in header
    require_once 'code/DOA.class.php';

    	
	
	if( isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) &&
      isset($_POST["phone"]) && isset($_POST["country"]) && isset($_POST["city"]) ) {
		  
	if(($_POST["username"]!="") && ($_POST["password"]!="") && ($_POST["firstname"]!="") && ($_POST["lastname"]!="") &&
      ($_POST["phone"]!="") && ($_POST["country"]!="") && ($_POST["city"]!="") ){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$phone = $_POST["phone"];
		$country = $_POST["country"];
		$city = $_POST["city"];
		
		$datejoined = "";
		$datemodified = "";
		
		$state = "";
		$address = "";
		$postal = "";
		if(isset($_POST["state"])){
		    $state = $_POST["state"];			
		}
		if(isset($_POST["address"])){
		    $address = $_POST["address"];			
		}
		if(isset($_POST["postal"])){
		    $postal = $_POST["postal"];			
		}
		
		$date = date("Y-m-d H:i:s");
		
		$lastID = 0;
		$myUsers = new UserDAO;
		$userResult = $myUsers->getAllOrderByID();
		while($userRow = $userResult->fetch()){
			$lastID = $userRow["UID"];
		}
		$newID = $lastID + 1;
		
		$sql = "INSERT INTO traveluser (UID, UserName, Pass, DateJoined, DateLastModified) 
		                        VALUES (".$newID.", '".$username."', '".$password."', '".$date."', '".$date."')";							
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->execute();
		
		$sql = "INSERT INTO traveluserdetails (UID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email) 
		                               VALUES (".$newID.", '".$firstname."', '".$lastname."', 
									           '".$address."', '".$city."', '".$state."', '".$country."', 
											   '".$postal."', '".$phone."', '".$username."')";
											   
		$stmt = $GLOBALS['pdo']->prepare($sql);
		$stmt->execute();
	}
	}
?>

<main>
<div class="container-fluid">
	<div class="row">
	    <div class="col-md-2">
		    <?php require_once 'code/leftNav.php'; ?>
	    </div>
		<div class="col-md-8">
		<h1>Register A New Account</h1>
		<hr>
		<?php
		    if(isset($_GET["status"])){
			    if(	$_GET["status"] == "sub"){
					if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) &&
                      isset($_POST["phone"]) && isset($_POST["country"]) && isset($_POST["city"]))
					{ 
					    if(($_POST["username"]!="") && ($_POST["password"]!="") && ($_POST["firstname"]!="") && ($_POST["lastname"]!="") &&
                        ($_POST["phone"]!="") && ($_POST["country"]!="") && ($_POST["city"]!="") ){
						    echo "<h3>Account created successfully, go <a href=\"login.php\">LOGIN</a></h3>";
						}
						else{
							echo "<h3>Error: All required fields need to be filled in</h3>";
						}
							
					}
					else{
						echo "<h3>Error: All required fields need to be filled in</h3>";
					}
				}
			}
		?>
		
		<div class="col-md-3"></div>
		<div class="col-md-6">
		    <div class="panel panel-info text-center">
                <h3>Input New Account Information</h3>
				<br>
		        
				<form method="POST" action="register.php?status=sub" >
				    <hr><h4>Basic Information</h4>
					<hr>
				    <label>Email: </label>
                    <input type="text" name="username" class="form-control"><br>
					<label>Password: </label>
                    <input type="password" name="password"  class="form-control"><br>
					<label>First Name: </label>
					<input type="text" name="firstname" class="form-control"><br>
					<label>Last Name: </label>
					<input type="text" name="lastname" class="form-control"><br>
					<label>Phone Number: </label>
					<input type="text" name="phone" class="form-control"><br>
					
					<hr><h4>Location Information</h4>
					<hr>
					
					<label>Country: </label>
					<select name = "country" class="form-control">
							<?php
							    $myCountries = new CountryDAO;
								$result = $myCountries->getAllIncludeUnused();
								while($row = $result->fetch()){
								    echo "<option value=\"".$row['CountryName']."\">".$row['CountryName']."</option>";
								}
							?>
					</select>
					<br>
					<label>City: </label>
					<input type="text" name="city" class="form-control"><br>
					<label>State(**optional**): </label>
					<input type="text" name="state" class="form-control"><br>					
					<label>Address(**optional**): </label>
					<input type="text" name="address" class="form-control"><br>
					<label>Postal(**optional**): </label>
					<input type="text" name="postal" class="form-control"><br>
					
                    <button type="submit" class="btn btn-primary">Submit</button>
					
                </form>
				
		    </div>
			
		</div>
	    <div class="col-md-3"></div>
	    </div>
	</div>
</div>
</main>

	</body>