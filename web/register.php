<?php
	include"config/koneksi.php";
	
	$nama 	= $_GET['nama'];	
	$email 	= $_GET['email'];
	
	
	mysql_query("INSERT INTO user(
									nameUser,
									emailUser,
									statusUser
								)VALUES(
									'$nama',
									'$email',
									'Pengunjung'
								)");
								
	$rEmployee	= mysql_fetch_array(mysql_query("SELECT *
												FROM user 
												WHERE user.usernameUser ='$_GET[email]'"));
	
	session_start();		
	$_SESSION['idUser']   			= $rEmployee['idUser'];
	
	echo "<script>
			location.reload();
		</script>";
	exit;	
	
?>