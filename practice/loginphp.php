<?php
	
	if (isset($_POST['loginSubmit'])){
		
		include 'db_connection.php';

		$conn = OpenCon();

		$userEmail = $_POST['userEmail'];
		$userPassword = $_POST['password'];

		if(empty($userEmail) || empty($userPassword)){
			header("Location: index.php?error=emptyfields");
			exit();
		}
		else{
			$sql = "SELECT * FROM users WHERE username=? OR user_email =?;";
			$statement = mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($statement, $sql)){
				header("Location: index.php?error=sqlerror");
				exit();
			}

			else {
				mysqli_stmt_bind_param($statement, "ss", $userEmail, $userEmail);
				mysqli_stmt_execute($statement);
				$result = mysqli_stmt_get_result($statement);

				if ($row = mysqli_fetch_assoc($result)){
					$passwordCheck = password_verify($userPassword, $row['user_password']);

					if ($userPassword = $row['user_password']){
						session_start();
						$_SESSION['user_ID'] = $row['user_ID'];
						$_SESSION['username'] = $row['username'];

						header("Location: index.php?login=success");
						exit();
					}
					else if ($passwordCheck == false){
						header("Location: index.php?error=incorrectPassword");
						exit();
					}

					else if($passwordCheck == true){
						session_start();
						$_SESSION['user_ID'] = $row['user_ID'];
						$_SESSION['username'] = $row['username'];

						header("Location: index.php?login=success");
						exit();
					}
				}

				else {
					header("Location: index.php?error=nouser");
					exit();
				}
			}
		}
	}

	else {
		header("Location: index.php");
	
    }

	
?>