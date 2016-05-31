<?php

//get the db config file
require_once "db.php";

$conn = mysql_connect($hostName, $dbuserName, $dbpassword);
if(!$conn)
{
     die('oops connection problem ! --> '.mysql_error());
}
if(!mysql_select_db($databaseName))
{
     die('oops database selection problem ! --> '.mysql_error());
}
?>