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

<div class="panel panel-info" id="leftNav">
	<div class="panel-heading">Locations <a data-toggle="collapse" data-target=".location">&nbsp;
	<span class="glyphicon glyphicon-collapse-up expand"></span></a></div>
	<div class="panel-heading">Continents</div>
	<ul class="list-group location">
		<li class="list-group-item">Africa</li>
		<li class="list-group-item">Antarctica</li>
		<li class="list-group-item">Asia</li>
		<li class="list-group-item">Europe</li>
		<li class="list-group-item">South America</li>
	</ul>
	<div class="panel-heading">Countries</div>
	<ul class="list-group location">
	<?php
		$allCountries = new CountryDAO;
		$stmt = $allCountries->getAll();
		while ($row = $stmt->fetch()){
			echo '<li class="list-group-item"><a href="country.php?iso=' . $row['ISO'] . '">' . $row['CountryName'] . '</a></li>';
		}
	?>
	</ul>
	<div class="panel-heading">Cities</div>
	<ul class="list-group location">
	<?php
		$allCities = new CityDAO;
		$stmt = $allCities->getAll();
		while ($row = $stmt->fetch()){
			echo '<li class="list-group-item"><a href="city.php?GeoNameID=' . $row['GeoNameID'] . '">' . $row['AsciiName'] . '</a></li>';
		}
	?>
	</ul>
</div>