<?php
	require "header.php";
?>

	<main>
		<?php
			if (isset($_SESSION['username'])){
				echo '<p> You are logged in </p>';
			}
			else {
				echo '<p> You are logged out </p>';
			}
		?>
	</main>






<?php
include 'db_connection.php';

$conn = OpenCon();
?>

<!DOCTYPE html>
<html>
	<body>
		<form method="post" action="">
			Type keyword to search:
			<input type="text" name="input">
			<input type="submit" name="submit" value="Search">
		</form>
		
		<?php
			if(isset($_POST['submit']))
			{
				
				$input = $_POST['input'];
				$query = "SELECT * FROM videos WHERE Filename LIKE '%".$input."%'";
				$result = mysqli_query($conn, $query);
				
				echo "<table border='1' style='width:100%'>";
				
				while($row = mysqli_fetch_array($result))
				{
					echo "<tr><td><video width ='320' height ='200' controls='controls'><source src='videos/".$row['Filename']."'> Your browser does not support the video element</audio></td><td>".$row['Filename']."</td><td>".$row['FileDescript']."</td><td>".$row['ID']."</td></tr>";
				}
				echo "</table>";
			}
		?>
		
	</body>
</html>