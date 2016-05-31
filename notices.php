
<?php
	// This function is used to generate the list of items when View All Items
	// is selected.


	

		// Include MySQL Server Connection Constants.
		include 'dbconnect.php';
		
		$result = mysql_query("select * from notice");

		while ($row = mysql_fetch_assoc($result)){
				print "<h3>{$row['name']}</h3>\n";

				$noticeID = $row['noticeID'];
				$picture_name = $row['picture_name'];

				if ($picture_name) {

					print "<img src = fetchPhoto.php?picture_name=$picture_name border=0 align=middle></a>\n";

				}

				print "<p><b>Category:</b> ";
				print "{$row['category']}</p>\n";

				print "<p><b>Description:</b> ";
				print "{$row['description']}</p>\n";

				print "<p><b>Expires on:</b> ";
				$UnixDate = $row['edate'];
				$RealDate = date("d M y", $UnixDate);
				print $RealDate;

				$UnixDate; // date of item in unix format
				$now = date("Y-m-d");
				$nowInUnixFormat = strtotime($now);

				/*print "<p><b>Price:</b> ";
				$price = $row['price'] / 100;
				print "£$price</p>\n";
				*/

				print "<p><b>Contact:</b> ";
				print "{$row['name']}</p>\n";

				print "<p><b>Email:</b> ";
				$email = $row['email'];
				print "<a href=\"mailto:$email\">$email</a><br>\n</p>";

				/*print "<p><b>Tel:</b> ";
				print "{$row['telephone']}</p>\n";
				*/

				/*$status = $row['status_desc'];
				$noticeID = $row['noticeID'];
				if ($nowInUnixFormat > $UnixDate and $status != 'cancelled') {

						$result1 = mysql_query("UPDATE $databaseName.notice_nbp  SET status=3 WHERE noticeID='$noticeID'");
				}*/

				print "<hr>";

		}

		/*Determine whether Previous and Next links are required
			$findrows = mysql_query("select * notice where status != '2' and status != '3'");
			$numrows = mysql_num_rows($findrows);

		if ($numrows == 0) {
			print "<p>Sorry, there are no items to display.</p>";

			}

			print "<table border=\"0\"><tr>\n";

			//Calculate if Previous button is needed
			if($startnum > 1) {
			$backnum = $startnum - 3;
			print "<td valign=\"top\">\n";
			print "<p><a href=\"viewAll.php?startnum=$backnum\"><img border='0' src='images/arrowb.gif' width='8' height='11'> Previous Page</a>&nbsp;</p>";
			print "</td>\n";
			} else {
			print "<td>\n";
			print " ";
			print "</td>\n";
			}

			//Calculate if next button is needed
			$nextnum = $startnum + 3;
			if($nextnum < $numrows) {
			print "<td valign=\"top\">\n";
			print "<p>&nbsp;<a href=\"viewAll.php?startnum=$nextnum\">Next Page <img border='0' src='images/arrow.gif' width='8' height='11'></a></p>";
			print "</td>\n";
			} else {
			print "<td>\n";
			print " ";
			print "</td>\n";
			}
			*/

			print "</tr></table>";

		return $result;

		mysql_close();


	?>
