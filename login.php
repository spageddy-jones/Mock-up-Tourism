<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">    
	<title>Login</title>

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

    if(isset($_GET["act"])){
		if($_GET["act"] == "logout"){
            unset($_SESSION["UID"]);
			//header("Location: index.php");
		}			
	}	
	
	if(isset($_POST["username"])){
		if(isset($_POST["password"])){
					    $username = $_POST["username"];
						$password = $_POST["password"];
						
						$user = new UserDAO;
    					$result = $user->getByUsername($username);
						$found=false;
						$foundpass = "";
						$foundID = 0;
	     				if($row = $result->fetch()){
							$found = true;
					    	$foundpass = $row["Pass"];
							$foundID = $row["UID"];
						}
						
						if($found==true){
						    if($password != $foundpass)
                                $found = false;								
						}
						
						if($found == true){
							$_SESSION["UID"] = $foundID;
							
							//header("Location: index.php");
						}
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
		<h1>Login / Logout</h1>
		<hr><hr>
		<?php
		    if(isset($_SESSION["UID"])){
				$myID = $_SESSION["UID"];
				$myUser = new UserDAO;
    			$result = $myUser->getByID($myID); 
				$myname = "";
				if($row = $result->fetch()){
					$myname = $row["FirstName"]." ".$row["LastName"];
				}
				echo "<h2>Currently logged in as <b>".$myname."</b></h2>";
			}
			else{
			    echo "<h2>Currently logged out</h2>";	
			}
		?>
		<hr><br>
		<div class="col-md-4"></div>
		<div class="col-md-4">
		    <div class="panel panel-info text-center">
                <h3>Login</h3>
				<form method="POST" action="login.php" >
                    <input type="text" name="username" placeholder="Username/Email" class="form-control"><br>
                    <input type="password" name="password" placeholder="Password" class="form-control"><br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
		    </div>
			<?php
				if(isset($_POST["username"])){
					if(isset($_POST["password"])){
						if($found == false){
							echo "<h3>Error: incorrect login information</h3>";
						}
					}
				}
				
			?>
			<hr><hr><hr><hr><hr><hr>
			<div class="panel panel-info text-center">
                <h3><a href="login.php?act=logout">Logout</a></h3>
		    </div>
			
		</div>
	    <div class="col-md-4"></div>
	    </div>
	</div>
</div>
</main>

	</body>