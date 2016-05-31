<?php

require_once "../db.php";

//get the file that queries the database to get all the notices
require_once "../noticefunc.php";

//check the request method to ensure that only valid requests are allowed.
if($_SERVER['REQUEST_METHOD'] == "GET" && !isset($_GET['noticeID'])){

	//set the header to ensure only json responses.
	header('Content-type: application/json');

	//convert the array to json and respond.
	echo json_encode($notices);

//if the get method comes with a parameter, use it to select the noticeID
} else if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['noticeID'])) {

	$noticeID = $_GET['noticeID'];

	//set the header to ensure only json responses.
	header('Content-type: application/json');

	//convert the array to json and respond.
	echo json_encode($notices[$noticeID-1]);
} else {
	//create an error message in an array.
	$error = array('success' => false, 'message' => 'Only "GET" method allowed');

	//set the header to ensure only json responses.
	header('Content-type: application/json');

	//set the error response code 
	http_response_code(404);

	//convert the error message to json and respond
	echo json_encode($error);
}

?>