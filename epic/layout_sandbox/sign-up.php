<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<!-- Latest compiled and minified CSS for Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
				integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript for Bootstrap -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
				  integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
				  crossorigin="anonymous"></script>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

		<!--Custom CSS -->
		<link rel="stylesheet" href="../../style/public-style.css">

		<meta charset="utf-8">
		<title>Sprout-Swap</title>
	</head>


	<div class="container">
		<div class="col-xs-12 col-md-6" id="signin-modal">

			<button id="cancel">
				<!-- closes form -->
			</button>
			<div class="logo">
				<img src="../../images/sprout-swap-favi.png" alt="Welcome to Sprout-Swap!">
			</div>
			<!--instructions for users -->
			<div id="login-text">
				<p>Please enter your information to sign-up for Sprout-Swap</p>
			</div>

			<!--actual form-->
			<form action="POST" id="signup-form">
				<!--user's email-->
				<div class="formgroup">
					<p>Email:</p>
					<input type="email" id="signup-email">
				</div>
				<!--user enters password-->
				<div class="formgroup">
					<p>Password:</p>
					<input type="password" id="signup-password">
				</div>
				<!--confirm password-->
				<div class="formgroup">
					<p>Confirm Password:</p>
					<input type="password" id="signup-password-confirm">
				</div>
				<!--set a handle-->
				<div class="formgroup">
					<p>Choose a unique username:</p>
					<input type="text" id="signup-handle">
				</div>
				<!--submit the information-->
				<div class="formgroup" id="signin-final-formgroup">
					<button id="submit">Submit</button>
				</div>
			</form>

		</div>
	</div>
</html>