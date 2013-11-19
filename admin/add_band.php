<?php
require("../../db_connect.php");

function load_genres($dbc){
$q = "SELECT * FROM genres";
$r = mysqli_query($dbc, $q);

echo "<select name='genre_id'>";
while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
								echo "<option value=\"$row[0]\">$row[1]</option>\n";
							}
echo "</select>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//include("../../db_connect.php");
	$errors = array();

	if (empty($_POST["band_name"])) {
		$errors[] = "Please enter the band name";
	} else {
		$bn = mysqli_real_escape_string($dbc, trim($_POST["band_name"]));
	}

	if ($_POST["genre_id"] == 0) {
		$errors[] = "Please select a genre";
	} else {
		$gid = $_POST["genre_id"];
	}

	if (empty($errors)) {
		$q = "INSERT INTO bands (band_name, genre_id) VALUES ('$bn', '$gid')";
		$r = mysqli_query($dbc, $q);
		if ($r) {
			echo "Success! Band added.";
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

echo '<form action="add_band.php" method="post">
		<p>Band Name:<input type="text" name="band_name" size="30" maxlength="60" /></p><p>';
load_genres($dbc);
echo '</p><p><input type="submit" name="submit" value="Add Band" /></p>
	  </form>';
?>