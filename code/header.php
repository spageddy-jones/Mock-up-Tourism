<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<?php
    session_start();
?>
<header>
	<div class="row">
		<nav class="navbar navbar-inverse ">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="col-md-8">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php" id="title">Share Your Travels</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-left">
						<li><a href="index.php">Home</a></li>
						<li><a href="about.php">About Us</a></li>
						<li><a href="search.php">Advanced Search</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="browse-posts.php">Posts</a></li>
								<li><a href="browse-images.php">Images</a></li>
								<li><a href="browse-users.php">Users</a></li>
							</ul>
						</li>
						<li ><a> 
						<?php
						    require_once 'code/DOA.class.php';
							if(basename($_SERVER['REQUEST_URI']) == "login.php"){
								echo "<b>-------- Login / Logout --------</b>";
							}
							else if(basename($_SERVER['REQUEST_URI']) == "login.php?act=logout"){
								echo "<b>-------- Login / Logout --------</b>";
							}
							else if(isset($_SESSION["UID"])){
								$myID = $_SESSION["UID"];
								$myUser = new UserDAO;
								$result = $myUser->getByID($myID); 
								$myname = "";
								if($row = $result->fetch()){
									$myname = $row["FirstName"]." ".$row["LastName"];
								}
								echo "<b>---- Logged In As ".$myname."</b> ----";
							}
							else{
								echo "<b>---- Currently Logged Out ----</b>";	
							}                                                                 
						?> 
						</a></li>
					</ul>
				</div>
				</div>
				<!-- /.navbar-collapse -->
				<form method="post" action="search.php">
				<div class="col-md-4">
					<div class="input-group" id="search">
						<input class="form-control" type="text" placeholder="Search Images" name="search" id="search">
							<span class="input-group-btn">
								<input class="btn btn-info" type="submit" value="Search">
							</span>
					</div>
				</div>
				</form>
			</div>
			<!-- /.container-fluid -->
		</nav>
	</div>
	
</header>