<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/stylesheets/style.css">
</head>
<body>
	<header>
		<div class="profile" onclick="menuToggle();">
			<?php echo "<img src = \"./assets/images/avatars/".$avatar."\">"?>
		</div>
		<div class="menu hidden">
			<?php echo "<h3>".$fullname."<br><br><span>@".$username."</span></h3>" ?>
			<!-- Amanda is username -->
			<ul>
				
				<li><a href="index.php?controller=profile&action=view">My Profile</a></li>
				<li><a href="index.php?controller=authen&action=logout">Logout</a></li>
			</ul>
		</div>
	</header>

	<!-- Main section -->
	<div class="main welcome">  
		<div class="content">	
			<h2 id="greeting">Hello</h2>
			<?php echo "<h1 id=\"wc-name\">".$fullname."</h1>" ?>
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

		function menuToggle(){
			const toggleMenu = document.querySelector('.menu');
			toggleMenu.classList.toggle('hidden')
		}

	</script>
</body>
</html>