<?php

require_once "../db.php";

require_once "../dbconnect.php";

require_once "../vendor/autoload.php";

use \Firebase\JWT\JWT;

$size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);

$secretKey =  base64_encode(mcrypt_create_iv($size, MCRYPT_DEV_URANDOM));

if($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){

	//get the data from the incoming json request and save it in post array
	$_POST = json_decode(file_get_contents("php://input"), true);

	//get the email and password 
	$email = mysql_real_escape_string($_POST['email']);
	$password = md5(mysql_real_escape_string($_POST['password']));

	//query the database to get the user with the specified email address
	$user = mysql_query("SELECT user_id, username, email FROM users WHERE email='$email' AND password='$password'");
	$user_array = mysql_fetch_array($user);

	if(!is_array($user_array)){
		$credentials = array('success' => false, 'message' => 'The provided email address or password is invalid');
		
		//set the header to ensure only json responses.
		header('Content-type: application/json');
		
		//convert the error message to json and respond
		echo json_encode($credentials);

	} else {

		//variables to hold token data
		$tokenId = $secretKey;
		$issuedAt = time();
		$notBefore = $issuedAt;
		$expire = $issuedAt + 86400;
		$serverName = $_SERVER['SERVER_NAME'];

		//create the token as an array
		$data = array(
			'iat' => $issuedAt,
			'jti' => $tokenId,
			'iss' => $serverName,
			'nbf' => $notBefore,
			'exp' => $expire,
			'data' => [
				'user_id' => $user_array['user_id'],
				'username' => $user_array['username'],
				'email' => $user_array['email']
				]
			);

		//create the token using the data array
		$jwt = JWT::encode($data, $secretKey);
	
		$user_data = array(
			'id' => $user_array['user_id'],
			'username' => $user_array['username'],
			'email' => $user_array['email'],
			'token' => $jwt,
			'success' => true
			 );


		//set the application header to json
		header('Content-type: application/json');

		//encode the array to json and return it
		echo json_encode($user_data);
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