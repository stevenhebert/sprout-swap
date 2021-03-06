<?php

require_once dirname(__DIR__, 3) . "/php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once ("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\SproutSwap\Profile;

/**
 * api for signin
 *
 * @author Zak Abad <abad.zacaria@gmail.com>; adapted from project flek
 **/

//prepare an empty reply

$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
try {
	//start session
	if(session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}

	//grab mySQL statement

	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/sprout-swap.ini");

	//determine which HTTP method was used

	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];
	if($method === "GET"){
		//set xsrf token
		setXsrfCookie();
	}

	//perform the post

	else if($method === "POST") {
		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//check that the necessary fields have been sent and filter

		if(empty($requestObject->profileEmail) === true) {
			throw(new \InvalidArgumentException("Wrong email address.", 401));
		} else {
			$profileEmail = filter_var($requestObject->profileEmail, FILTER_SANITIZE_EMAIL);
		}
		if(empty($requestObject->profilePassword) === true) {
			throw(new \InvalidArgumentException("Must enter a password."));
		} else {
			$profilePassword = $requestObject->profilePassword;
		}

		//create a profile

		$profile = Profile::getProfileByProfileEmail($pdo, $profileEmail);
		if(empty($profile) === true) {
			throw(new \InvalidArgumentException("Invalid Email"));
		}

		//hash for $profilePassword

		$hash = hash_pbkdf2("sha512", $profilePassword, $profile->getProfileSalt(), 262144);

		//verify hash is correct

		if($hash !== $profile->getProfilePasswordHash()) {
			throw(new \InvalidArgumentException("Password or email is incorrect."));
		}

		//grab profile from database and put into a session
		$profile = Profile::getProfileByProfileId($pdo, $profile->getProfileId());
		$_SESSION["profile"] = $profile;

		$reply->message = "Sign in was successful.";

	} else {
		throw(new \InvalidArgumentException("Invalid HTTP method request."));
	}

} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}
header("Content-type: application/json");
echo json_encode($reply);