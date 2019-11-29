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
	</main>
<?php
	require "footer.php";
?>
