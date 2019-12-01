<?php
	require "header.php";
?>

    <form action="viewphp.php" method="post">
        <div class="search-box-view">
            <input class="search-txt-view" type="text" name="searchBox" method="post" placeholder="Type to search">
            <a class="search-btn-view" href="#">
            <i class="fas fa-search" type="submit" name="searchSubmitBtn" action="viewphp.php" method="post"></i>
            </a>
        </div>
    </form>

<div class="view-body">
    <?php
        if(isset($_POST['searchBox']) || isset($_POST['searchSubmitBtn'])){

            include 'db_connection.php';

	        $conn = OpenCon();
            $search = $_POST['searchBox'];

            if (empty($search)){
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
            }
            else {
                $query = "SELECT * FROM videos WHERE Filename LIKE '%".$search."%'";
				$result = mysqli_query($conn, $query);
				$numberOfVideos = mysqli_num_rows($result);

                if ($numberOfVideos > 0) {
                    echo "<table border='1' style='width:100%'>";
				
				    while($row = mysqli_fetch_array($result))
				    {
					    echo "<tr><td><video width ='320' height ='200' controls='controls'>
                                <source src='videos/".$row['Filename']."'> Your browser does not support the video element</audio></td>
                                <td>".$row['Filename']."</td>
                                <td>".$row['FileDescript']."</td>
                                <td>".$row['ID']."</td></tr>";
				    }
				    echo "</table>";
                }
                else {
                    echo '<div>
                            <p> There are no results for that search </p>
                        </div>';
                }
            }
        }
    ?>
</div>
<?php
	require "footer.php";
?>