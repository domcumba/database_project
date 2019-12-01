<?php

	if(isset($_POST['signupSubmit'])){

	include 'db_connection.php';

	$conn = OpenCon();

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];

		if (empty($username) || empty($email) || empty($password) || empty($password2)){
			header("Location: signup.php?error=emptyfields&uid=".$username."&mail=".$email);
			exit();
		}

		else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
			header("Location: signup.php?error=invaliduseridemail");
			exit();
		}

		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header("Location: signup.php?error=invalidemail&uid=".$username."&mail=".$email);
			exit();
		}

		else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
			header("Location: signup.php?error=invaliduserid&uid=".$username."&mail=".$email);
			exit();
		}

		else if ($password !== $password2){
			header("Location: signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
			exit();
		}

		/* check using prepared statements for security*/
		else {
			mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
			$sql = "SELECT username FROM users WHERE username=?";

			$statement = mysqli_stmt_init($conn);

			if(!mysqli_stmt_prepare($statement, $sql)){
				header("Location: signup.php?error=sqlerror");
				exit();
			}

			mysqli_stmt_bind_param($statement, "s", $username);

			mysqli_stmt_execute($statement);

			mysqli_stmt_store_result($statement);

			$resultCheck = mysqli_stmt_num_rows($statement);

			if ($resultCheck > 0) {
				header("Location: signup.php?error=usertaken&email=".$email);
				exit();
			}
			else {
				$sql = "INSERT INTO users (username, user_email, user_password) VALUES (?, ?, ?)";
				$statement = mysqli_stmt_init($conn);

				if(!mysqli_stmt_prepare($statement, $sql)){
					header("Location: signup.php?error=sqlerror");
					exit();
				}

				else {

					$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($statement, "sss", $username, $email, $password);

					mysqli_stmt_execute($statement);

					header("Location: signup.php?signup=success");
					exit();
				}
			}
		}
			mysqli_commit($conn);
			mysqli_stmt_close($statement);
			mysqli_close($conn);
	}
?>