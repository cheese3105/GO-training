<?php
session_start();
// If there is no session then redirect to login.php
if( !isset( $_SESSION['username'] ) ) {
	header('Location: http://localhost/web_app_development/login.php');
}
    
?>

<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="main welcome">  
		<div class="content">	
			<h2 id="greeting">Hello</h2>
			<?php echo "<h1 id=\"wc-name\">".$_SESSION['fullname']."</h1>" ?>
			<h2 id="greeting2">Welcome to my Webpage </h2>
		</div>
	</div>

	<script>
		let today = new Date();
		let time = today.toLocaleString('en-US', {
			hour12: false,
			hour: '2-digit',
		});

		function greeting(a){
			if(a < 12 && a >= 5){
				document.querySelector('#greeting').innerHTML = "Good morning!";
			} else if(a>= 12 && a < 17){
				document.querySelector('#greeting').innerHTML = "Good afternoon!";
			} else if( a >= 17 && a <= 22){
				document.querySelector('#greeting').innerHTML = "Good evening!";
			} else {
				document.querySelector('#greeting').innerHTML = "Welcome to my Webpage";
				document.querySelector('#greeting2').innerHTML = "It's late! Sleep Sleep!"
			}
		}
		
		greeting(time);


	</script>
</body>
</html>