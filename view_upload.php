<?php
session_start();
include 'dbconnect.php';

$res=mysql_query("SELECT * FROM admins WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);

#array to select data and loop through all results		
		$result = mysql_query("select * from notice");
		$notices = array();
		while ($row = mysql_fetch_assoc($result)) {
			 array_push($notices, $row);
		}



		echo $notices;
		mysql_close();
		?>
