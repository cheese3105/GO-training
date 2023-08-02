<!DOCTYPE html>
<html>
<head>
	<title>My profile</title>
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/stylesheets/style.css">
	
</head>
<body>
	<header>
		<div class="profile" onclick="menuToggle();">
			<?php echo "<img src = \"./assets/images/avatars/".$avatar."\">"?>
		</div>
		<div class="menu">
			<?php echo "<h3>".$fullname."<br><br><span>@".$username."</span></h3>" ?>
			<!-- Amanda is username -->
			<ul>
				<li><a href="index.php?controller=pages&action=home">Home</a></li>
				<li><a href="index.php?controller=authen&action=logout">Logout</a></li>
			</ul>
		</div>
	</header>

	<!-- Main section -->
	<div class="main flex-container">

		<div class="upload-container">
			<?php echo "<img src=\"./assets/images/avatars/".$avatar."\" alt=\"Upload Picture\" id=\"avatar\" />" ?>
			<form action="index.php?controller=profile&action=update" method="POST" enctype="multipart/form-data">
				<input type="file" id="image-upload" name="uploadfile" accept=".jpg, .jpeg, .png">
				<label for="image-upload" class="upload-button">Change Picture</label>
				<button type="submit" name="submit">Update</button>
			</form>
		</div>
		  <!--  -->
		<div class="user-info">
			<div class="info-wrap">
			<?php echo "<h3>FULLNAME: ".$fullname."</h3>" ?>
			</div>

			<div class="info-wrap">
				<?php echo "<h3>EMAIL: ".$email."</h3>" ?>
			</div>
			
		</div>
		
	</div>
	<script>
		function menuToggle(event) {
			const toggleMenu = document.querySelector('.menu');
			toggleMenu.classList.toggle('hidden');
			event.stopPropagation();
		}

		document.addEventListener('click', function (event) {
			const menu = document.querySelector('.menu');
			const profile = document.querySelector('.profile');

			if (!menu.classList.contains('hidden') && event.target !== profile && !profile.contains(event.target)) {
				menu.classList.add('hidden');
			}
		});


	</script>
</body>
</html>