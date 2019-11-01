<?php
	require "header.php";
?>

	<main>
		<h1> Signup </h1>
		<form action="signupphp.php" method="post">
			<input type="text" name="username" placeholder="Username">
			<input type="text" name="email" placeholder="E-mail">
			<input type="password" name="password" placeholder="Password">
			<input type="password" name="password2" placeholder="Repeat Password">
			<button type="submit" name="signupSubmit"> Signup </button>
		</form>
	</main>

<?php
	require "footer.php";
?>