<?php
$q = "SELECT * FROM SHOWS ORDER BY show_date ASC";
$r = mysqli_query($dbc,$q);
$num = mysqli_num_rows($r);

if ($num > 0) {
	echo '<div id="upcoming_shows"><h3>Upcoming Shows</h3>';
	echo "<ul>";
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<li><span>' . $row['show_description'] . ' </span><span> ' . $row['show_date'] . '</span></li>';
	}
	echo "</ul></div>";
	mysqli_free_result($r);
}
//mysqli_close($dbc);
?>