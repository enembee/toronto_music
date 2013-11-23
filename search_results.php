<?php
//Establish db connection
include("../db_connect.php");
//Load genres from db into array
$q = "SELECT genre_name FROM genres";
$r = mysqli_query($dbc,$q);
$num = mysqli_num_rows($r);

$genres = array();
while ($row = mysqli_fetch_row($r)) {
    $genres[] = implode(',',$row);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$search_criteria = $_POST["search_criteria"];

	if (in_array($search_criteria , $genres)) {
		echo "Genre search";
		$q = "SELECT * FROM SHOWS INNER JOIN SHOWS_BANDS ON SHOWS_BANDS.SHOW_ID = SHOWS.SHOW_ID LEFT JOIN BANDS ON BANDS.BAND_ID = SHOWS_BANDS.BAND_ID LEFT JOIN GENRES ON GENRES.GENRE_ID = BANDS.GENRE_ID WHERE GENRES.GENRE_NAME LIKE '%$search_criteria%'";
		$r = mysqli_query($dbc,$q);
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			echo '<p><span>' . $row['show_description'] . ' </span><span> ' . $row['show_date'] . '</span></p>';
		}
	} else {
		$q = "SELECT * FROM SHOWS INNER JOIN SHOWS_BANDS ON SHOWS_BANDS.SHOW_ID = SHOWS.SHOW_ID LEFT JOIN BANDS ON BANDS.BAND_ID = SHOWS_BANDS.BAND_ID WHERE BAND_NAME LIKE '%$search_criteria%'";
		$r = mysqli_query($dbc,$q);
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<p><span>' . $row['show_description'] . ' </span><span> ' . $row['show_date'] . '</span></p>';
		}
	}
}
?>
<form action="search_results.php" method="post">
	<p>Search Criteria:<input type="text" name="search_criteria" size="30" /></p>
	<p><input type="submit" name="submit" value="Search" /></p>
</form>