<?php

	function cek_backup($search)
	{
		// the following line prevents the browser from parsing this as HTML.
		header('Content-Type: text/plain');
		//path dimana file txt berada (server linux) anda bisa tentukan sendiri
		$check_file_backup = '../stopword.txt';
		// get the file contents, assuming the file to be readable (and exist)
		$contents = file_get_contents($check_file_backup);
		// escape special characters in the query
		$pattern = preg_quote($search, '/');
		// finalise the regular expression, matching the whole line
		$pattern = "/^.*$pattern.*\$/m";
		// search, and store all matching occurences in $matches
		if(preg_match_all($pattern, $contents, $matches)){
		  $hasil=1;
		}
		else{    
			 $hasil=0;
		}
		return $hasil;
	}
?>