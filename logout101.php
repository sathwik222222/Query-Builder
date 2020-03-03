<?php
	session_start();
	echo $_SESSION["userid"];
	unset($_SESSION["userid"]);
	session_destroy();
	header("Location: login101QB.php");
?>