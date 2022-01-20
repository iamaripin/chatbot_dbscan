<?php
	error_reporting(0);
	session_start();
	date_default_timezone_set("Asia/Jakarta");	
	$date	= date("Y-m-d");
	$time 	= date("H:i:s"); 
	
	$server 	= "localhost";
	$username	= "root";
	$password 	= ""; 
	$database 	= "chatbot";

	// Koneksi dan memilih database di server
	mysql_connect($server,$username,$password) or die("Koneksi gagal");
	mysql_select_db($database) or die("Database tidak bisa dibuka");
?>