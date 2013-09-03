<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require_once("../../db_connect.php");

	$errors = array();

	if (empty($_POST["genre_name"])) {
		$errors[] = "Please enter a genre name";
	} else {
		$gn = mysqli_real_escape_string($dbc, trim($_POST["genre_name"]));
	}

	if (empty($errors)) {
		$q = "INSERT INTO genres (genre_name) VALUES ('$gn')";
		$r = mysqli_query($dbc, $q);
		if ($r) {
			echo "Success! Genre added.";
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

echo '<form action="add_genre.php" method="post">
		<p>Genre Name:<input type="text" name="genre_name" size="20" maxlength="40" /></p>
		<p><input type="submit" name="submit" value="Add Genre" /></p>
	  </form>';
?>