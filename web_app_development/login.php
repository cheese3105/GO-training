<?php
require 'user.php';
session_start();
session_destroy();

// If the request does not have an action parameter, the default action is login
$action = isset($_GET['action'])? $_GET['action'] : 'login';

// Controller handles signup action
if ($action == 'signup') {
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$username = $_POST['uname'];
		$password = $_POST['passwd'];
		$email = $_POST['email'];
		$fullname = $_POST['fname'];
		$user = new User($username, $password, $email, $fullname);	
		if (!$user->verifyPasswordLength()) {
			$message = "Password must be more than 8 characters !!!";
			echo "<script>alert('$message'); window.location = window.location.href.split(\"?\")[0];</script>";
		}
		elseif(!$user->verifyEmailFormat()) {
			$message = "Invalid email !!!";
			echo "<script>alert('$message'); window.location = window.location.href.split(\"?\")[0];</script>";
		}
		elseif($user->verifyUsername()) {
			$user->save();
		}
		else {
			$message = "Username already exists !!!";
			echo "<script>alert('$message'); window.location = window.location.href.split(\"?\")[0];</script>";
		}
	}
}
// Controller handles login action
elseif ($action == 'login') {
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$username = $_POST['uname'];
		$password = $_POST['passwd'];
		$user = new User($username, $password);
		if($user->login()) {
			echo "<script>window.location = '/web_app_development/index.php';</script>";
		}
		else {
			$message = "Invalid username or password!!!";
			echo "<script>alert('$message'); window.location = window.location.href.split(\"?\")[0];</script>";
		}
	}
}

// If the action is not signup or login then alert
else {
	$message = "Please Sign Up";
	echo "<script>alert('$message'); window.location = window.location.href.split(\"?\")[0];</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form method="post" action="login.php?action=signup">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="fname" placeholder="Fullname" required="">
					<input type="text" name="uname" placeholder="Username" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="passwd" placeholder="Password" pattern=".{8,}" title="Eight or more characters" required="">
					<button>Sign up</button>
				</form>
			</div>

			<div class="login">
				<form method="post" action="login.php?action=login">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="text" name="uname" placeholder="Username" required="">
					<input type="password" name="passwd" placeholder="Password" required="">
					<button type="submit">Login</button>
				</form>
			</div>
	</div>
</body>
</html>