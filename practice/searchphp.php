<?php
	require "header.php";
?>

<form action="searchphp.php" method="post">
    <div class="search-box-view">
        <input class="search-txt-view" type="text" name="searchBox" method="post" placeholder="Type to search">
        <a class="search-btn-view" href="#">
        <i class="fas fa-search" type="submit" name="searchSubmitBtn" action="searchphp.php" method="post"></i>
        </a>
    </div>
</form>

<div class="view-body">
    <?php

        if(isset($_POST['searchBox']) || isset($_POST['searchSubmitBtn'])){

            include 'db_connection.php';

	        $conn = OpenCon();
            $search = $_POST['searchBox'];
            $query = '';

            // get the query depending on what was in the search bar
            if (strpos($search, ':views descending') !== false){
                $subSearch = substr($search, 0, -17);
                
                $query = "SELECT * FROM videos WHERE Filename LIKE '%".$subSearch."%' ORDER BY views DESC";
            }
            elseif (strpos($search, ':views ascending') !== false){
                $subSearch = substr($search, 0, -16);
                
                $query = "SELECT * FROM videos WHERE Filename LIKE '%".$subSearch."%' ORDER BY views ASC";
            }
            elseif (strpos($search, ':id descending') !== false){
                $subSearch = substr($search, 0, -14);

                $query = "SELECT * FROM videos WHERE Filename LIKE '%".$subSearch."%' ORDER BY id DESC";
            }
            elseif (strpos($search, ':id ascending') !== false){
                $subSearch = substr($search, 0, -13);

                $query = "SELECT * FROM videos WHERE Filename LIKE '%".$subSearch."%' ORDER BY id ASC";
            }
            elseif (empty($search)){
                $query = "SELECT * FROM videos";
            }
            else {
                $query = "SELECT * FROM videos WHERE Filename LIKE '%".$search."%'";
            }

            // perform the qeury and display the results
            $result = mysqli_query($conn, $query);
			$numberOfVideos = mysqli_num_rows($result);

            if ($numberOfVideos > 0) {
                echo "<table class='video-table'>";			
				while($row = mysqli_fetch_array($result))
				{
                    $video_id = $row['ID'];
					echo "<tr>
                            <td width='330'><video width ='320' height ='200' controls='controls'>
                            <source src='videos/".$row['Filename']."'> Your browser does not support the video element</audio></td>
                            <td>
                                <table>
                                    <form action='view.php' method='post'>
                                        <tr>
                                            <td>
                                                <a class='video-title' name='description'>".$row['FileDescript']."</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class='video-atts'>".$row['Filename']."</a>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td>
                                                <a class='video-atts'> Views: ".$row['views']."</a>
                                            </td>
                                            </tr>
                                        <tr>
                                            <td>
                                                <a class='video-atts'> Video ID: ".$row['ID']."</a>
                                                <input type='hidden' name='video-id' value = '".$row['ID']."'/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button class='video-atts' method='post' type='submit' name='view'> View </button>
                                            </td>
                                        </tr>
                                    </form>
                                </table>
                            </td>
                            </tr>";
				}
				echo "</table>";
            }
            else {
                echo '<div>
                        <p> There are no results for that search </p>
                    </div>';
            }	
        }
    ?>
</div>
<?php
	require "displayFooter.php";
?>