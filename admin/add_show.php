<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Add Show</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
</head>
<body>
<?php
require("../../db_connect.php");

function load_locations($dbc){
$q = "SELECT location_id, location_name FROM locations";
$r = mysqli_query($dbc, $q);

echo "<select name='location_id'>";
while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
								echo "<option value=\"$row[0]\">$row[1]</option>\n";
							}
echo "</select>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$errors = array();

	if (empty($_POST["show_desc"])) {
		$errors[] = "Please enter a show description";
	} else {
		$sdesc = mysqli_real_escape_string($dbc, trim($_POST["show_desc"]));
	}

	if (empty($_POST["show_date"])) {
		$errors[] = "Please enter the date of the show";
	} else {
		$sdate = strtotime($_POST["show_date"]);
		$sdate = date('Y-m-d', $sdate);
	}

	if (empty($_POST["show_start_time"])) {
		$errors[] = "Please enter the start time";
	} else {
		$sstart = $_POST["show_start_time"];
	}

	if (empty($_POST["show_end_time"])) {
		$errors[] = "Please enter the start time";
	} else {
		$send = $_POST["show_end_time"];
	}

	if (empty($_POST["location_id"])) {
		$errors[] = "Please select a venue";
	} else {
		$lid = $_POST["location_id"];
	}

	if (empty($errors)) {
		$q = "INSERT INTO shows (location_id, show_description, show_date, show_start, show_end) VALUES ('$lid', '$sdesc', '$sdate', '$sstart', '$send')";
		$r = mysqli_query($dbc, $q);
		if ($r) {
			echo "Success! Show added.";
		} else {
			echo mysqli_error($dbc);
		}

		//mysqli_close($dbc);
	} else {
		foreach ($errors as $msg) {
			echo "- $msg<br />\n";
			echo $q;
		}
	}
}

echo '<form action="add_show.php" method="post">
		<p>Show Description:<input type="text" name="show_desc" size="20" maxlength="40" /></p>
		<p>Show Date:<input type="text" name="show_date" id="datepicker" size="20" /></p>
		<p>Start Time:<input type="text" name="show_start_time" size="20" maxlength="10" /></p>
		<p>End Time:<input type="text" name="show_end_time" size="20" maxlength="10" /></p>';;
		load_locations($dbc);
		echo '<p><input type="submit" name="submit" value="Add Show" /></p>
	  </form>';
?>
</body>
</html>