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
	require "footer.php";
?>




<?php
include 'db_connection.php';

$conn = OpenCon();
?>

<!DOCTYPE html>

<body>
<?php
		$query = "SELECT * FROM videos";
		$result = mysqli_query($conn, $query);
		
		echo "<table border='1' style='width:100%'>";
		
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr><td><video width ='320' height ='200' controls='controls'><source src='videos/".$row['Filename']."'> Your browser does not support the video element</audio></td><td>".$row['Filename']."</td><td>".$row['FileDescript']."</td><td>".$row['ID']."</td></tr>";
		}
		echo "</table>";
	?>
</body>
