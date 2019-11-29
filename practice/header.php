<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<title></title>
		<link rel="stylesheet" href="style.css">
	</head>

<body>
	<header>
		<nav>
			<a href="#">
			</a>
			<ul class="topnav">
				<a href="submit.php"> Home </a>
				<a href="upload.php"> Upload </a><
				<a href="display.php"> Display </a>
				<a href="search.php"> Advanced Search </a>
				<a href="update.php"> Update </a>
				<a href="delete.php"> Delete </a>
				<?php
					if (isset($_SESSION['username'])){
					echo '<form action="logoutphp.php" method="post">
							<button type="submit" name="logoutSubmit"> Logout </button>
							</form>';
					}
					else {
						echo '<a href="signup.php"> Signup </a>
								<form action="loginphp.php" method="post" align="right">
								<input type="text" name="userEmail" placeholder="Username...">
								<input type="password" name="password" placeholder="Password...">
								<button type="submit" name="loginSubmit"> Login </button>
								</form>';
					}
				?>	
			</ul>
			<div>
				
			</div>
		</nav>
	</header>