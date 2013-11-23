<?php
include("includes/site_header.php");

require_once("../db_connect.php");
$q = "SELECT * FROM SHOWS ORDER BY show_date ASC";
$r = mysqli_query($dbc,$q);
$num = mysqli_num_rows($r);

if ($num > 0) {
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<p><span>' . $row['show_description'] . ' </span><span> ' . $row['show_date'] . '</span></p>';
	}
	mysqli_free_result($r);
}
mysqli_close($dbc);

include("includes/site_footer.php")
?>