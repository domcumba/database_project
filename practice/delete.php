<?php
include 'db_connection.php';
$conn = OpenCon();
echo "Connected Successfully";
?>

<!doctype html>
<html>
    
	<?php
	if(isset($_POST['delete']))
	{
		$target_id = $_POST['ID'];
		$query = "DELETE FROM videos WHERE ID = '".$target_id."'";
		mysqli_query($conn,$query);
	}
	?>
	<body>
		<form method="post" action="">
			<input type="text" name="ID">
			<input type="submit" value="Delete" name="delete">
		</form>
	</body>
</html>