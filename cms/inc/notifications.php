<?php
if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
	echo "<p class='alert-success'>".$_SESSION['success']."</p>";
	unset($_SESSION['success']);
}

if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
	echo "<p class='alert-danger'>".$_SESSION['error']."</p>";
	unset($_SESSION['error']);
}
if(isset($_SESSION['warning']) && !empty($_SESSION['warning'])){
	echo "<p class='alert-warning'>".$_SESSION['warning']."</p>";
	unset($_SESSION['warning']);
}

?>