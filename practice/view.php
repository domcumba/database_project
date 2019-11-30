<?php
	require "header.php";
?>

<main>
<div class="view-video">
	<?php

	if(isset($_POST['view'])){

	    include 'db_connection.php';

	    $conn = OpenCon();
        if(isset($_POST['video-id'])){
            $video_id = $_POST['video-id'];
            $view_query = "UPDATE videos SET views = views + 1 WHERE ID = '".$video_id."'";
            mysqli_query($conn, $view_query);

		    $query = "SELECT * FROM videos WHERE ID = '".$video_id."'";
		    $video = mysqli_query($conn, $query);

            while($row = mysqli_fetch_array($video))
			{
                echo "<table class='view-table'>";
					echo "<tr>
                            <td width='1280'><video width ='1280' height ='720' controls='controls'>
                            <source src='videos/".$row['Filename']."'> Your browser does not support the video element</audio></td>
                            <td>
                            </td>
                            </tr>
				</table>";

                echo "<a class='video-title'>".$row['FileDescript']."</a>";
                echo "<p class='video-atts'>Views: ".$row['views']."</p>";


                if (isset($_SESSION['username']))
	            {
                    echo "
                        <form action='flag.php' method='post'>
                        <button type='submit' name='flag'> Flag </button>
                        <input type='hidden' name='video-id' value = '".$row['ID']."'/>";
                    if(isset($_GET["ID"]))
		            {
			            $id = (int)$_GET['ID'];
			            $query = "INSERT INTO flagged(ID) VALUES({$id})";
                        mysqli_query($conn,$query);
		            }
	            } 
            }
	    } 
    }
    ?>
</div>
</main>
<?php
	require "displayFooter.php";
?>