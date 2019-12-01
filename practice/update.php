<?php
include 'db_connection.php';
$conn = OpenCon();
require "header.php";
?>

<!doctype html>
<html>
    
	<?php
        if(isset($_POST['update']))
        {
            $maxsize = 20971520; // 20mb limit
            
            $name = $_FILES['file']['name'];
            $target_dir = "videos/";
            $target_file = $target_dir . $_FILES["file"]["name"];
            $description = $_POST['descript'];
			$target_id = $_POST['ID'];

            // Select file type
       	    $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("mp4","avi","3gp","mov","mpeg");
            
            if(in_array($videoFileType, $extensions_arr))
            {
				if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0))
				{
					echo "File too large. File must be less than 5MB.";
				}
				else
				{
          			if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file))
					{
					$query = "UPDATE Videos SET Filename='".$name."', Fileloc='".$target_file."', FileDescript='".$description."' WHERE ID='".$target_id."'";
								mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
              					mysqli_query($conn,$query);
								mysqli_commit($conn);
              					echo "Upload successfully.";
					}
				}
			} 
			else
			{
				echo "Invalid Extension";
			}
		}
        ?>
	<body>
		<form method="post" action="" enctype='multipart/form-data'>
			ID of record to update:
			<input type="text" name="ID">
			<br>
			Updated file:
			<form method="post" action="" enctype='multipart/form-data'>
				<input type='file' name='file' />
				<br>
				Description of file
				<input type='text' name='descript' />
				<input type="submit" value="Update" name="update">
			</form>
		</form>
	</body>
</html>
<?php
	require "footer.php";
?>