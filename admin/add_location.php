<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require_once("../../db_connect.php");

	$errors = array();

	if (empty($_POST["location_name"])) {
		$errors[] = "Please enter a location name";
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST["location_name"]));
	}

	if (empty($_POST["address_1"])) {
		$errors[] = "Please enter the first line of the address";
	} else {
		$a1 = mysqli_real_escape_string($dbc, trim($_POST["address_1"]));
	}

	if (!empty($a2)) {
		$a2 = mysqli_real_escape_string($dbc, trim($_POST["address_2"]));
	} else {
			$a2 = NULL;
	}

	if (empty($_POST["city"])) {
		$errors[] = "Please enter the name of the city";
	} else {
		$c = mysqli_real_escape_string($dbc, trim($_POST["city"]));
	}

	if (empty($_POST["postal_code"])) {
		$errors[] = "Please enter the postal code";
	} else {
		$pc = mysqli_real_escape_string($dbc, trim($_POST["postal_code"]));
	}

	if (empty($_POST["lat"])) {
		$errors[] = "Please enter the latitude";
	} else {
		$lat = mysqli_real_escape_string($dbc, trim($_POST["lat"]));
	}

	if (empty($_POST["lng"])) {
		$errors[] = "Please enter the longitude";
	} else {
		$lng = mysqli_real_escape_string($dbc, trim($_POST["lng"]));
	}


	if (empty($errors)) {
		$q = "INSERT INTO locations (location_name, address_1, address_2, city, postal_code, lat, lng) VALUES ('$ln', '$a1', '$a2', '$c', '$pc', '$lat', '$lng')";
		$r = mysqli_query($dbc, $q);
		if ($r) {
			echo "Success! Location added.";
		} else {
			echo mysqli_error($dbc);
		}

		mysqli_close($dbc);
	} else {
		foreach ($errors as $msg) {
			echo "- $msg<br />\n";
		}
	}
}

echo '<form action="add_location.php" method="post">
		<p>Venue Name:<input type="text" name="location_name" size="20" maxlength="40" /></p>
		<p>Address Line 1:<input type="text" name="address_1" size="20" maxlength="40" /></p>
		<p>Address Line 2:<input type="text" name="address_2" size="20" maxlength="40" /></p>
		<p>City:<input type="text" name="city" size="20" maxlength="20" /></p>
		<p>Postal Code:<input type="text" name="postal_code" size="20" maxlength="10" /></p>
		<p>Latitude:<input type="text" name="lat" size="20" maxlength="20" /></p>
		<p>Longitude:<input type="text" name="lng" size="20" maxlength="20" /></p>
		<p><a href="http://geolytica.com/">Look up Geocodes</></p>
		<p><input type="submit" name="submit" value="Add Location" /></p>
	  </form>';
?>