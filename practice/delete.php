<?php
include 'db_connection.php';
$conn = OpenCon();
echo "Connected Successfully";
require "header.php";
?>

<!doctype html>
<html>



	<?php
	if (isset($_SESSION['username']) && $_SESSION['username'] == "admin")
	{
		echo '<p> Welcome to the members area </p';
	} 
	else 
	{
		/*header("Location: http://localhost/database_project/practice/submit.php"); 
		exit();*/
	} 
	
	if(isset($_POST['delete']))
	{
		$target_id = $_POST['ID'];
		$query = "DELETE FROM videos WHERE ID = '".$target_id."'";
		mysqli_query($conn,$query);
	}
	
	$query = "SELECT * FROM videos INNER JOIN flagged ON videos.ID=flagged.ID";
	$result = mysqli_query($conn, $query);
		
	echo "<table border='1' style='width:100%'>";
		
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr><td><video width ='320' height ='200' controls='controls'><source src='videos/".$row['Filename']."'> Your browser does not support the video element</audio></td><td>".$row['Filename']."</td><td>".$row['FileDescript']."</td><td>".$row['ID']."</td></tr>";
	}
	echo "</table>";
	?>
	<body>
		<form method="post" action="">
			<input type="text" name="ID">
			<input type="submit" value="Delete" name="delete">
		</form>
	</body>
</html>
<?php
	require "footer.php";
?>