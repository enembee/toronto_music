<?php
include("../../db_connect.php");

function load_genres(){
	$q = "SELECT genre_id, genre_name FROM genres";
	$r = mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r, MYSQLI_NUM);

	echo "<select>";
	foreach ($row as $key => $value) {
		echo '<option value="' . $value . '">' . $key . '</option>';
	}
	echo "</select>";
}
?>