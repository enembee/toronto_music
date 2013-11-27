<?php
$q = "SELECT * FROM SHOWS ORDER BY date_posted DESC";
$r = mysqli_query($dbc,$q);
$num = mysqli_num_rows($r);

if ($num > 0) {
	echo '<div id="recently_added"><h3>Recently Added</h3>';
	echo '<ul>';
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<li><span>' . $row['show_description'] . ' </span><span> ' . $row['show_date'] . '</span></li>';
	}
	echo "</ul></div>";
	mysqli_free_result($r);
}
//mysqli_close($dbc);
?>