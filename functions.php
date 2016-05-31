<?php

// This is the main file for the web application. It contains all of the
// functions that are called by the other files.

	// Class to describe a user.

	class UserInfo {
		var $userID;
		var $email;
		var $name;
		var $password;
		var $remember;
	}

	// This functions checks whether users can access a particular page.
	// Users do not actually log in (sign in) to the application. All
	// that happens is that each page can call this function, which checks
	// whether they have either entered an email and password, or whether
	// the email and password cookies have been set. The function creates
	// a User Info object, which is returned to the calling page if a valid
	// email and password are found.

	function userAccess() {

		// Include MySQL Server Connection Constants.
		include 'dbconnnect.php';

		// First check for a POST
		$email = $_POST['email'];
		$password = $_POST['password'];
		// If no POST, check for a cookie
		if ($email == NULL) {
			$email = $_COOKIE['nbemail'];
			$password = $_COOKIE['nbpassword'];
		}/*
		elseif (!$remember) {
			// If there was a POST, save the cookie
			// This will wipe out any long-term
			// cookies by this same name
			setcookie('nbemail', $email);
			setcookie('nbpassword', $password);
		}*/

		$okay = false;
		if ($email && $password) {
			mysql_connect("$hostName", "$dbusername", "$dbpassword");

			$newUserInfo = new UserInfo;

			$newUserInfo->userID = "1";
			$newUserInfo->email = $email;
			$newUserInfo->name = "john";
			$newUserInfo->telephone = "123456";
			$newUserInfo->password = $password; //non-encrypted password

			$result = mysql_query( "select * from $databaseName.users where email = '$email'" );
			if ($result) {
				if (mysql_num_rows($result) > 0) {
					$row = mysql_fetch_assoc($result);

					$newUserInfo->userID = $row['userID'];
					$newUserInfo->name = $row['name'];
					$pass = $row['password'];

					$passcrypt = crypt($password,
						substr($pass, 0, 12));

					if ($pass == $passcrypt) {
						$okay = true;
					}
				}
			}
			mysql_close();
		}
		if (!$okay) {
			header("location: login.php");
		}
		// If $remember is set, store in long-term cookie
		/*if ($remember) {
			// Remember until May 17, 2033.
			setcookie('nbemail', $email, 2000000000);
			setcookie('nbpassword', $password, 2000000000);
			setcookie('nbrememberme', 1, 2000000000);
		}
		return $newUserInfo;
	}*/


	// This function adds a new user. It checks the email address to see
	// whether the user is already signed up.

	function signup($email, $name, $password) {

		// Include MySQL Server Connection Constants.
		include 'db.php';

		mysql_connect("$hostName", "$dbusername", "$dbpassword");
		//$passcrypt = crypt($password);

		$result = mysql_query(
			"select * from $databaseName.users where email = '$email'");
		$found = false;
		if ($result) {
			if (mysql_num_rows($result) > 0) {
				print "<p>It looks like you're already registered.</p>";
				$found = true;
				return;
			}
		}
		if ($found == false) {
			$result = mysql_query(
			"insert into $databaseName.user_nbp
			(email, name, telephone, password) values
			('$email', '$name', '$passcrypt')"
		);

		}

		mysql_close();
		return $result;
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	// This function updates a user profile.

	function updateProfile() {

		// Include MySQL Server Connection Constants.
		include 'db.php';

		$userID = $_POST['userID'];
		$email = $_POST['email'];
		$name = $_POST['name'];
		$telephone = $_POST['telephone'];
		$password = $_POST['password'];

		mysql_connect("$hostName", "$dbusername", "$dbpassword");

		$passcrypt = crypt($password);

		$result = mysql_query(" UPDATE $databaseName.user_nbp  SET email='$email' ,name='$name' ,telephone='$telephone' ,password='$passcrypt' WHERE userID='$userID' ");

		if ($result) {

		return $result;

		}

		else {
			header("location: profilechangefailed.html");
		}

		mysql_close();
	}


	// This function generates a new password. The format of the password
	// is word.number.word. In a production environment, this would need to
	// be beefed up a bit (a lot).


	function GeneratePassword() {
		$wordlist = array("book", "down", "echo", "eat", "jack", "under", "upside", "wipe", "house", "man", "load", "car", "sound", "clown", "london", "paris", "texas", "benjamin", "matthew", "susannah");
		$firstword = $wordlist[rand(0,
			count($wordlist) - 1)];
		$secondword = $wordlist[rand(0,
			count($wordlist) - 1)];
		$number = rand(10,99);
		$newpass = $firstword.$number.$secondword;
		return $newpass;
	}


	// This function is used to generate the list of items when View All Items
	// is selected.


	function getItemList() {

		// Include MySQL Server Connection Constants.
		include 'db.php';

		$startnum=$_GET['startnum'];

		mysql_connect("$hostName", "$dbusername", "$dbpassword");

		$result = mysql_query(
				"select $databaseName.user_nbp.name,
				$databaseName.user_nbp.userID,
				$databaseName.user_nbp.email,
				$databaseName.user_nbp.telephone,
				$databaseName.notice_nbp.heading,
				$databaseName.notice_nbp.picture_name,
				$databaseName.notice_nbp.noticeID,
				$databaseName.category_nbp.category_name,
				$databaseName.notice_nbp.description,
				$databaseName.notice_nbp.expiration_date, UNIX_TIMESTAMP(expiration_date) as unixdate,
				$databaseName.notice_nbp.price,
				$databaseName.status_nbp.description as status_desc

				from $databaseName.user_nbp, $databaseName.notice_nbp, $databaseName.status_nbp, $databaseName.category_nbp

				where $databaseName.notice_nbp.userID = $databaseName.user_nbp.userID and
				($databaseName.status_nbp.statusID != '2' and $databaseName.status_nbp.statusID != '3' and  $databaseName.status_nbp.statusID = $databaseName.notice_nbp.status) and
				$databaseName.category_nbp.categoryID = $databaseName.notice_nbp.categoryID LIMIT $startnum,3");

		while ($row = mysql_fetch_assoc($result)){
				print "<h3>{$row['heading']}</h3>\n";

				$noticeID = $row['noticeID'];
				$picture_name = $row['picture_name'];

				if ($picture_name) {

					print "<img src = fetchPhoto.php?picture_name=$picture_name border=0 align=middle></a>\n";

				}

				print "<p><b>Category:</b> ";
				print "{$row['category_name']}</p>\n";

				print "<p><b>Description:</b> ";
				print "{$row['description']}</p>\n";

				print "<p><b>Expires on:</b> ";
				$UnixDate = $row['unixdate'];
				$RealDate = date("d M y", $UnixDate);
				print $RealDate;

				$UnixDate; // date of item in unix format
				$now = date("Y-m-d");
				$nowInUnixFormat = strtotime($now);

				print "<p><b>Price:</b> ";
				$price = $row['price'] / 100;
				print "£$price</p>\n";

				print "<p><b>Contact:</b> ";
				print "{$row['name']}</p>\n";

				print "<p><b>Email:</b> ";
				$email = $row['email'];
				print "<a href=\"mailto:$email\">$email</a><br>\n</p>";

				print "<p><b>Tel:</b> ";
				print "{$row['telephone']}</p>\n";

				$status = $row['status_desc'];
				$noticeID = $row['noticeID'];
				if ($nowInUnixFormat > $UnixDate and $status != 'cancelled') {

						$result1 = mysql_query("UPDATE $databaseName.notice_nbp  SET status=3 WHERE noticeID='$noticeID'");
				}

				print "<hr>";

		}

		// Determine whether Previous and Next links are required
			$findrows = mysql_query("select * from $databaseName.notice_nbp where status != '2' and status != '3'");
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

			print "</tr></table>";

		return $result;

		mysql_close();

	}



	// This function is used to generate the list of items when View Items
	// by Category is selected.

	function getItemListByCategory() {

		// Include MySQL Server Connection Constants.
		include 'db.php';

		$startnum=$_GET['startnum'];
		$accommodation=$_GET['accommodation'];
		$books=$_GET['books'];
		$computers=$_GET['computers'];
		$home_and_garden=$_GET['home_and_garden'];
		$photography=$_GET['photography'];
		$vehicles=$_GET['vehicles'];
		$other=$_GET['other'];

		mysql_connect("$hostName", "$dbusername", "$dbpassword");

		$result = mysql_query(
				"select
				$databaseName.user_nbp.name,
				$databaseName.user_nbp.userID,
				$databaseName.user_nbp.email,
				$databaseName.user_nbp.telephone,
				$databaseName.notice_nbp.heading,
				$databaseName.notice_nbp.picture_name,
				$databaseName.notice_nbp.noticeID,
				$databaseName.notice_nbp.description,
				$databaseName.notice_nbp.expiration_date, UNIX_TIMESTAMP(expiration_date) as unixdate,
				$databaseName.notice_nbp.price,
				$databaseName.category_nbp.category_name,
				$databaseName.status_nbp.description as status_desc

				from $databaseName.user_nbp, $databaseName.notice_nbp, $databaseName.category_nbp, $databaseName.status_nbp

				where
				$databaseName.notice_nbp.userID = $databaseName.user_nbp.userID AND

				(($databaseName.notice_nbp.categoryID = '$accommodation' AND $databaseName.category_nbp.category_name = 'accommodation') OR
				($databaseName.notice_nbp.categoryID = '$books' AND $databaseName.category_nbp.category_name = 'books') OR
				($databaseName.notice_nbp.categoryID = '$computers' AND $databaseName.category_nbp.category_name = 'computers') OR
				($databaseName.notice_nbp.categoryID = '$home_and_garden' AND $databaseName.category_nbp.category_name = 'home and garden') OR
				($databaseName.notice_nbp.categoryID = '$photography' AND $databaseName.category_nbp.category_name = 'photography') OR
				($databaseName.notice_nbp.categoryID = '$vehicles' AND $databaseName.category_nbp.category_name = 'vehicles') OR
				($databaseName.notice_nbp.categoryID = '$other' AND $databaseName.category_nbp.category_name = 'other')) AND
				($databaseName.status_nbp.statusID != '2' AND $databaseName.status_nbp.statusID != '3' AND  $databaseName.status_nbp.statusID = $databaseName.notice_nbp.status)  LIMIT $startnum,3");

				print "<p><a href=\"viewByCategory.html\">Back to Categories</a></p>\n";

		while ($row = mysql_fetch_assoc($result)){
				print "<h3>{$row['heading']}</h3>\n";

				$noticeID = $row['noticeID'];
				$picture_name = $row['picture_name'];

				if ($picture_name) {

					print "<img src = fetchPhoto.php?picture_name=$picture_name border=0 align=middle></a>\n";

				}

				print "<p><b>Category:</b> ";
				print "{$row['category_name']}</p>\n";

				print "<p><b>Description:</b> ";
				print "{$row['description']}</p>\n";

				print "<p><b>Expires on:</b> ";
				$UnixDate = $row['unixdate'];
				$RealDate = date("d M y", $UnixDate);
				print $RealDate;

				$UnixDate; // date of item in unix format
				$now = date("Y-m-d");
				$nowInUnixFormat = strtotime($now);

				print "<p><b>Price:</b> ";
				$price = $row['price'] / 100;
				print "£$price</p>\n";

				print "<p><b>Contact:</b> ";
				print "{$row['name']}</p>\n";

				print "<p><b>Email:</b> ";
				$email = $row['email'];
				print "<a href=\"mailto:$email\">$email</a><br>\n</p>";

				print "<p><b>Tel:</b> ";
				print "{$row['telephone']}</p>\n";


				$status = $row['status_desc'];
				$noticeID = $row['noticeID'];
				if ($nowInUnixFormat > $UnixDate and $status != 'cancelled') {

					$result1 = mysql_query("UPDATE $databaseName.notice_nbp  SET status=3 WHERE noticeID='$noticeID'");
				}

				print "<hr>";

		}

		// Determine whether Previous and Next links are required
		$findrows = mysql_query(
				"select
				$databaseName.user_nbp.name,
				$databaseName.user_nbp.userID,
				$databaseName.user_nbp.email,
				$databaseName.user_nbp.telephone,
				$databaseName.notice_nbp.heading,
				$databaseName.notice_nbp.picture_name,
				$databaseName.notice_nbp.noticeID,
				$databaseName.notice_nbp.description,
				$databaseName.notice_nbp.expiration_date,
				$databaseName.notice_nbp.price,
				$databaseName.category_nbp.category_name,
				$databaseName.status_nbp.description as status_desc

				from $databaseName.user_nbp, $databaseName.notice_nbp, $databaseName.category_nbp, $databaseName.status_nbp

				where
				$databaseName.notice_nbp.userID = $databaseName.user_nbp.userID AND

				(($databaseName.notice_nbp.categoryID = '$accommodation' AND $databaseName.category_nbp.category_name = 'accommodation') OR
				($databaseName.notice_nbp.categoryID = '$books' AND $databaseName.category_nbp.category_name = 'books') OR
				($databaseName.notice_nbp.categoryID = '$computers' AND $databaseName.category_nbp.category_name = 'computers') OR
				($databaseName.notice_nbp.categoryID = '$home_and_garden' AND $databaseName.category_nbp.category_name = 'home and garden') OR
				($databaseName.notice_nbp.categoryID = '$photography' AND $databaseName.category_nbp.category_name = 'photography') OR
				($databaseName.notice_nbp.categoryID = '$vehicles' AND $databaseName.category_nbp.category_name = 'vehicles') OR
				($databaseName.notice_nbp.categoryID = '$other' AND $databaseName.category_nbp.category_name = 'other')) AND
				($databaseName.status_nbp.statusID != '2' AND $databaseName.status_nbp.statusID != '3' AND  $databaseName.status_nbp.statusID = $databaseName.notice_nbp.status) ");

		$numrows = mysql_num_rows($findrows);

		if ($numrows == 0) {
			print "<p>Sorry, there are no items to display.</p>";

			}

				print "<table border=\"0\"><tr>\n";

				//Calculate if Previous button is needed
				if($startnum > 1) {
				$backnum = $startnum - 3;
				print "<td valign=\"top\">\n";
				print "<p><a href=\"viewByCategory.php?startnum=$backnum&accommodation=$accommodation&books=$books&computers=$computers&home_and_garden=$home_and_garden&photography=$photography&other=$other&vehicles=$vehicles\"><img border='0' src='images/arrowb.gif' width='8' height='11'> Previous Page</a>&nbsp;</p>";
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
				print "<p>&nbsp;<a href=\"viewByCategory.php?startnum=$nextnum&accommodation=$accommodation&books=$books&computers=$computers&home_and_garden=$home_and_garden&photography=$photography&other=$other&vehicles=$vehicles\">Next Page <img border='0' src='images/arrow.gif' width='8' height='11'></a></p>";
				print "</td>\n";
				} else {
				print "<td>\n";
				print " ";
				print "</td>\n";
				}

				print "</tr></table>";


		return $result;

		mysql_close();

	}


	// This function displays the list of items for the signed-in user.

	function myItemList($userID) {

		// Include MySQL Server Connection Constants.
		include 'db.php';

		$startnum=$_GET['startnum'];

		mysql_connect("$hostName", "$dbusername", "$dbpassword");

		$result = mysql_query(
				"select $databaseName.notice_nbp.heading,
				$databaseName.notice_nbp.picture_name,
				$databaseName.notice_nbp.noticeID,
				$databaseName.notice_nbp.description,
				$databaseName.notice_nbp.expiration_date, UNIX_TIMESTAMP(expiration_date) as unixdate,
				$databaseName.notice_nbp.price,
				$databaseName.category_nbp.category_name,
				$databaseName.status_nbp.description as status_desc

				from $databaseName.notice_nbp, $databaseName.status_nbp, $databaseName.category_nbp

				where $databaseName.notice_nbp.userID = '$userID' and
				$databaseName.status_nbp.statusID = $databaseName.notice_nbp.status and
				$databaseName.category_nbp.categoryID = $databaseName.notice_nbp.categoryID LIMIT $startnum,3");

		while ($row = mysql_fetch_assoc($result)){
				print "<h3>{$row['noticeID']} {$row['heading']}</h3>\n";

				$picture_name = $row['picture_name'];

				if ($picture_name) {

					print "<img src = fetchPhoto.php?picture_name=$picture_name border=0 align=middle></a>\n";
				}

				print "<p><b>Category:</b> ";
				print "{$row['category_name']}</p>\n";

				print "<p><b>Description:</b> ";
				print "{$row['description']}</p>\n";

				print "<p><b>Expires on:</b> ";
				$UnixDate = $row['unixdate'];
				$RealDate = date("d M y", $UnixDate);
				print $RealDate;

				$UnixDate; // date of item in unix format
				$now = date("Y-m-d");
				$nowInUnixFormat = strtotime($now);

				print "<p><b>Price:</b> ";
				$price = $row['price'] / 100;
				print "£$price</p>\n";

				print "<p><b>Status:</b> ";
				$status = $row['status_desc'];
				$noticeID = $row['noticeID'];
				if ($nowInUnixFormat > $UnixDate and $status != 'cancelled') {
					print "expired</p>";
					$result1 = mysql_query("UPDATE $databaseName.notice_nbp  SET status=3 WHERE noticeID='$noticeID'");
				}
				else {
					print "{$row['status_desc']}</p><br>\n";
				}
				print "<hr>";

		}

		// Determine whether Previous and Next links are required
			$findrows = mysql_query("select * from $databaseName.notice_nbp where userID = '$userID'");
			$numrows = mysql_num_rows($findrows);

		if ($numrows == 0) {
			print "<p>Sorry, there are no items to display.</p>";

			}

			print "<table border=\"0\"><tr>\n";

			//Calculate if Previous button is needed
			if($startnum > 1) {
			$backnum = $startnum - 3;
			print "<td valign=\"top\">\n";
			print "<p><a href=\"viewMyItems.php?startnum=$backnum\"><img border='0' src='images/arrowb.gif' width='8' height='11'> Previous Page</a>&nbsp;</p>";
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
			print "<p>&nbsp;<a href=\"viewMyItems.php?startnum=$nextnum\">Next Page <img border='0' src='images/arrow.gif' width='8' height='11'></a></p>";
			print "</td>\n";
			} else {
			print "<td>\n";
			print " ";
			print "</td>\n";
			}

			print "</tr></table>";

		//Edit an item
		print "<form method=\"GET\" action=\"editItem.php\">\n";
		print "<p>To edit an item, enter its number and click Edit: <input type=\"text\" name=\"noticeID\" size=\"3\">\n";
		print "<input type=\"submit\" value=\"Edit\"></p>\n";
		print "<input type=\"hidden\" name=\"userID\" value=\"$userID\">\n";
		print "</form>\n";

		//Delete an item
		print "<form method=\"GET\" action=\"deleteItem3.php\">\n";
		print "<p>To delete an item, enter its number and click Delete: <input type=\"text\" name=\"noticeID\" size=\"3\">\n";
		print "<input type=\"submit\" value=\"Delete\"></p>\n";
		print "<input type=\"hidden\" name=\"userID\" value=\"$userID\">\n";
		print "</form>\n";


			$result1 = mysql_query(
				"select heading, noticeID from $databaseName.notice_nbp where $databaseName.notice_nbp.userID = '$userID' and $databaseName.notice_nbp.status = 2");

				$i=0;
				while ($row = mysql_fetch_assoc($result1)){

					while ($i < 1) {

					print "<br><br>";
					print "<p><b>NOTE</b></p>";
					print "<p>Looking at the above list, the following item(s) have been cancelled. If you want to remove them, click <a href=\"deleteItem1.php?userID=$userID\">here</a>.</p>";
					++$i;
					}

				print "<p>{$row['noticeID']} {$row['heading']}</p>\n";
			}

			$result2 = mysql_query(
				"select heading, noticeID from $databaseName.notice_nbp where $databaseName.notice_nbp.userID = '$userID' and $databaseName.notice_nbp.status = 3");

				$i=0;
				while ($row = mysql_fetch_assoc($result2)){

					while ($i < 1) {

					print "<br><br>";
					print "<p><b>NOTE</b></p>";
					print "<p>Looking at the above list, the following item(s) have expired. If you want to remove them, click <a href=\"deleteItem2.php?userID=$userID\">here</a>.</p>";
					++$i;
					}

				print "<p>{$row['noticeID']} {$row['heading']}</p>\n";
			}


		return $result;

		mysql_close();

	}


	// This function creates a new item.

	function newItem() {

		// Include MySQL Server Connection Constants.
		include 'db.php';

		$heading = $_POST['heading'];
		$picture=$_REQUEST['picture'];
		$category = $_POST['category'];
		$description = $_POST['description'];
		$price1 = $_POST['price'];
		$price = $price1 * 100; //Convert to pence
		$expirationstr = $_POST['expiration_date'];
		$expirationnum = strtotime($expirationstr);
		$expiration = date("Y-m-d", $expirationnum);
		$status = $_POST['status'];
		$userID = $_POST['userID'];
		$now = date("Y-m-d");


		// The following few lines are for debugging purposes. They should be commented out in the production version of the application.

		// Debugging for uploaded picture
		//print "<pre>";
		//print "File name   = ". $_FILES['picture']['name'] . "<br>\n";
		//print "Mime type   = ". $_FILES['picture']['type'] . "<br>\n";
		//print "File size   = ". $_FILES['picture']['size'] . "<br>\n";
		//print "Local name  = ". $_FILES['picture']['tmp_name'] . "<br>\n";
		//print "Error code  = ". $_FILES['picture']['error'] . "<br>\n";
		//print "</pre>";


		// Check to see if a picture has been uploaded

		if ($_FILES['picture']['name'] == '') {

			mysql_connect("$hostName", "$dbusername", "$dbpassword");

			$result = mysql_query("insert into $databaseName.notice_nbp (categoryID, heading, description, price, create_date, expiration_date, status, userID)
			values ('$category', '$heading', '$description', '$price', '$now', '$expiration', '$status', '$userID')");

		}

		// Yes - a picture has been uploaded - try to process it

		else {

			// Check that user has uploaded a JPEG image and not something else
			if ($_FILES['picture']['type'] != 'image/pjpeg' && $_FILES['picture']['type'] != 'image/jpeg' && $_FILES['picture']['error'] != '4' && $_FILES['picture']['error'] != '1' && $_FILES['picture']['error'] != '2') {

			?>
			<table border="0" cellpadding="0" cellspacing="0"><tr><td align="left">
				<img src="images/attention.gif" border="0" alt="Caution" align="left">
				</td>
				<td>
				<p style="font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 10pt;margin-left:10">The photo you are trying to upload either does not exist, or  is not the correct type. It must be a JPEG image.</p>
				</td>
				</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
				<td colspan="2" align="middle">
				<form>
				<input type=button value="<- Back to Create Item Form" onClick="javascript:history.back();">
				</form>
				</td>
				</tr>
			</table>
			<?php

			exit;
			}

			// Check that the file is not too big
			if ($_FILES['picture']['error'] == '1' || $_FILES['picture']['error'] == '2') {

			?>
			<table border="0" cellpadding="0" cellspacing="0"><tr><td align="left">
				<img src="images/attention.gif" border="0" alt="Caution" align="left">
				</td>
				<td>
				<p style="font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 10pt;margin-left:10">The photo you are trying to upload is too big. The maximum size allowed is 500KB.</p>
				</td>
				</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
				<td colspan="2" align="middle">
				<form>
				<input type=button value="<- Back to Create Item Form" onClick="javascript:history.back();">
				</form>
				</td>
				</tr>
			</table>
			<?php

			exit;
			}

			// Make a note of the file type
			$file_type = $_FILES['picture']['type'];

			// Make a note of the file size
			$file_size = $_FILES['picture']['size'];

			// Check whether a photo having the same name has already been uploaded
  			$upfile = 'photos/'.$_FILES['picture']['name'];

 	 		mysql_connect("$hostName", "$dbusername", "$dbpassword");

			$checkname = @mysql_query("select noticeID from $databaseName.notice_nbp WHERE picture_name='$upfile'");

			$numrows = mysql_num_rows($checkname);
			if ($numrows != 0){
			?>
				<table border="0" cellpadding="0" cellspacing="0"><tr><td align="left">
				<img src="images/attention.gif" border="0" alt="Caution" align="left">
				</td>
				<td>
				<p style="font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 10pt;margin-left:10">A picture already exists that has the same name as the one you are trying to upload. Please change the name of your photo and try again.</p>
				</td>
				</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
				<td colspan="2" align="middle">
				<form>
				<input type=button value="<- Try Again" onClick="javascript:history.back();">
				</form>
				</td>
				</tr>
				</table>
			<?php
			exit;
			}

 			// put the file into a folder

  			if (is_uploaded_file($_FILES['picture']['tmp_name']))
  			{
    			 if (!move_uploaded_file($_FILES['picture']['tmp_name'], $upfile))
     			{
        			echo 'Problem: Could not move file to destination directory';

       				 exit;
     			}
  			}
  			else
  			{
   				echo 'Problem: Possible file upload attack. Filename: ';
    			echo $_FILES['picture']['name'];

    		exit;
  			}

			$result = mysql_query("insert into $databaseName.notice_nbp (categoryID, heading, picture_name, file_type, file_size, description, price, create_date, expiration_date, status, userID)
			values ('$category', '$heading', '$upfile', '$file_type', '$file_size', '$description', '$price', '$now', '$expiration', '$status', '$userID')");

		}


		if ($result) {

		return $result;

		}

		else {
			header("location: newitemfailed.html");
		}

		mysql_close();
	}

?>
