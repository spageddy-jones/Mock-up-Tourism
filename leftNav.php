<?php require_once 'DOA.class.php'; ?>

<div class="panel panel-info">
	<div class="panel-heading">Account</div>
	<ul class="list-group">
		<li class="list-group-item"><a href="#">View Favorites List</a></li>
		<li class="list-group-item"><a href="#">My Account</a></li>
		<li class="list-group-item"><a href="#">Register</a></li>
		<li class="list-group-item"><a href="#">Login</a></li>
	</ul>
</div>

<div class="panel panel-info">
	<div class="panel-heading">Continents</div>
	<ul class="list-group">
		<li class="list-group-item">Africa</li>
		<li class="list-group-item">Antarctica</li>
		<li class="list-group-item">Asia</li>
		<li class="list-group-item">Europe</li>
		<li class="list-group-item">South America</li>
	</ul>
	<div class="panel-heading">Countries</div>
	<?php
		$allCountries = new CountryDAO;
		$stmt = $allCountries->getAll();
	?>
	<div class="panel-heading">Cities</div>
</div>