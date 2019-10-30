<?php
include 'db_connection.php';

$conn = OpenCon();

echo "Connected Successfully";
?>

<!doctype html>
<html>
    <head>
        <?php
        if(isset($_POST['upload']))
        {
            $maxsize = 20971520; // 20mb limit
            
            $name = $_FILES['file']['name'];
            $target_dir = "videos/";
            $target_file = $target_dir . $_FILES["file"]["name"];
            $description = $_POST['descript'];

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
				$query = "INSERT INTO Videos(Filename,Fileloc,FileDescript) VALUES('".$name."','".$target_file."','".$description."')";

              			mysqli_query($conn,$query);
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
   </head>
   <body>
    <form method="post" action="" enctype='multipart/form-data'>
      <input type='file' name='file' />
      <input type='text' name='descript' />
      <input type='submit' value='Upload' name='upload'>
    </form>

  </body>
</html>
            			
        

