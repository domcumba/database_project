<?php
	require "header.php";
    include 'db_connection.php';

    $conn = OpenCon();
?>

<div id="container">
    <?php
		$query = "SELECT * FROM videos";
		$result = mysqli_query($conn, $query);
		
		echo "<table border='1' style='width:100%'>";
		
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr><td><video width ='320' height ='200' controls='controls'><source src='videos/".$row['Filename']."'> Your browser does not support the video element</audio></td><td>".$row['Filename']."</td><td>".$row['FileDescript']."</td><td>".$row['ID']."</td><td><a href='display.php?ID=".$row['ID']."'>Flag Video</a></td></tr>";
		}
		echo "</table>";
		
		if(isset($_GET["ID"]))
		{
			$id = (int)$_GET['ID'];
			$query = "INSERT INTO flagged(ID) VALUES({$id})";
            mysqli_query($conn,$query);
		}
	?>
</div>
<?php
	require "displayFooter.php";
?>
