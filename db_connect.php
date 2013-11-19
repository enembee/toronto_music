<?php
DEFINE ('DB_USER', 'music_admin');
DEFINE ('DB_PASSWORD', 'kXpH7Kyy');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'toronto_music');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die("Could not connect to MySQL:" . mysqli_connect_error());

?>