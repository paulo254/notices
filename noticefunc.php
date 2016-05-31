
<?php
	// This function is used to generate the list of items when View All Items
	// is selected.


	

		// Include MySQL Server Connection Constants.
		include 'dbconnect.php';
		
		
		$result = mysql_query("select * from notice");
		$notices1 = array();
		$notices = array();
		while ($row = mysql_fetch_assoc($result)) {
			 array_push($notices1, $row);
		}

		foreach ($notices1 as $key => $value) {
			if($value['edate'] > time()){
				array_push($notices, $value);
			}
		}

		return $result;

		mysql_close();


	?>
