<?php
	require "header.php";
?>

<?php
    if(isset($_POST['flag'])){

	    include 'db_connection.php';

	    $conn = OpenCon();

        if(isset($_POST['video-id'])){
            $video_id = $_POST['video-id'];
            $query = "INSERT INTO flagged(ID) VALUES({$video_id})";

		    mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
            mysqli_query($conn,$query);
		    mysqli_commit($conn);

            echo "
                <p> This video has been flagged </p>";
        }
    }
?>
<?php
	require "footer.php";
?>