<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require("../../db_connect.php");
	//include("admin_functions.php");

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

function load_genres(){
include("../../db_connect.php");
$q = "SELECT genre_id, genre_name FROM genres";
$r = mysqli_query($dbc, $q);

echo '<p>Genre:<select name="genre_id">';

while ($row = mysqli_fetch_array($r)) {
	echo '<option value="' . $row["genre_id"] . '">' . $row["genre_name"] . '</option>';
}

echo "</select></p>";
}

echo '<form action="add_band.php" method="post">
		<p>Band Name:<input type="text" name="band_name" size="30" maxlength="60" /></p><p>';
load_genres();
echo '</p><p><input type="submit" name="submit" value="Add Band" /></p>
	  </form>';
?>