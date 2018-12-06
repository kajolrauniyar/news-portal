<?php
if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
	echo "<p class='alert-danger'>".$_SESSION['error']."</p>";
	unset($_SESSION['error']);
}


?>