<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form method="post" action="index.php?controller=authen&action=signup">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="fname" placeholder="Fullname" required="">
					<input type="text" name="uname" placeholder="Username" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="passwd" placeholder="Password" pattern=".{8,}" title="Eight or more characters" required="">
					<button>Sign up</button>
				</form>
			</div>

			<div class="login">
				<form method="post" action="index.php?controller=authen&action=login">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="text" name="uname" placeholder="Username" required="">
					<input type="password" name="passwd" placeholder="Password" required="">
					<button type="submit">Login</button>
				</form>
			</div>
	</div>
</body>
</html>