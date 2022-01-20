<?php
	include"config/koneksi.php";
	
	//session_destroy();
	
	
	mysql_query("TRUNCATE table chat");
	
	echo"<script>
			window.location.assign('index.php')
		</script>";
?>
