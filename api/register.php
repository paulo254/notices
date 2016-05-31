<?php

require_once "db.php";

require_once "../dbconnect.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(empty($_POST)){
		//get the data from the incoming json request and save it in post array
		$_POST = json_decode(file_get_contents("php://input"), true);
	}

	$username = mysql_real_escape_string($_POST['username']);
	$email = mysql_real_escape_string($_POST['email']);
	$password = md5(mysql_real_escape_string($_POST['password']));

	//insert the user into the database
	$register = mysql_query("INSERT INTO users (username, email, password) VALUE ('$username', '$email', '$password')");

	if($register){
		$register_success = array('success' => true, 'message' => 'You have successfully registered');

		//set the header to ensure only json responses.
		header('Content-type: application/json');
		
		//convert the error message to json and respond
		echo json_encode($register_success);
	} else {
		$register_fail = array('success' => false, 'message' => 'Registration failed.');

		//set the header to ensure only json responses.
		header('Content-type: application/json');
		
		//convert the error message to json and respond
		echo json_encode($register_fail);
	}

} else {

	$error = array('success' => false, 'message' => 'This route is only accessible via a "POST" request');

	//set the header to ensure only json responses.
	header('Content-type: application/json');

	//set the error response code 
	http_response_code(404);

	//convert the error message to json and respond
	echo json_encode($error);
}

?>