<?php
	require "header.php";
?>
	<main>
		<?php
			if (isset($_SESSION['username'])){
				echo '';
			}
			else {
				echo '';
			}
		?>
        <form action="searchphp.php" method="post">
            <div class="search-box">
                <input class="search-txt" type="text" name="searchBox" method="post" placeholder="Type to search">
                <a class="search-btn" href="#">
                <i class="fas fa-search" type="submit" name="searchSubmitBtn" action="searchphp.php" method="post"></i>
                </a>
            </div>
        </form>
	</main>
<?php
	require "footer.php";
?>
