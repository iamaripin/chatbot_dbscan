<?php
	include"config/koneksi.php";
	include "config/fungsi.php";
	include "config/stemming.php";
	include "config/sintakreplace.php";
	
	mysql_query("TRUNCATE table temp1");
	//mysql_query("TRUNCATE table indexing");
	mysql_query("TRUNCATE table temp3");
	
	/*
	$ceksample = mysql_query("SELECT pertanyaan,idSample FROM sample");
		
	while($rs = mysql_fetch_array($ceksample)){
		$pesan = $rs['pertanyaan'];
		$pesan2 = strip_tags($pesan);			
		$teks3 = strtolower($pesan2);
	 
		$tokenKarakter3=array('?','?',' ','/',',','?','.',':',';',',','!','[',']','{','}','(',')','-','_','+','=','<','>','\'','"','\\','@','#','$','%','^','&','*','`','~','0','1','2','3','4','5','6','7','8','9','â?','?','?','&nbsp;');
		$teks3= str_replace($tokenKarakter3,' ',$teks3);
		$tok3 = strtok($teks3, "\n\t");
		 
		while ($tok3 !== false) {
			$teks3 = $tok3;
			$tok3 = strtok(" \n\t");
		}
		$split3 = explode(' ',$teks3);
		foreach($split3 as $key3=>$kata3){
			$yusuf3 = NAZIEF(trim($kata3));
			
			$cektemp = mysql_fetch_array(mysql_query("SELECT no,tf FROM indexing WHERE kata = '$yusuf3' AND idSample = '$rs[idSample]'"));
			
			$cekstoplist = mysql_num_rows(mysql_query("SELECT idStoplist FROM stoplist WHERE stoplist = '$yusuf3'"));
			if($cekstoplist == 0){
				if($cektemp['no'] <> ''){
					$tf = $cektemp['tf']+1; 
					mysql_query("UPDATE indexing SET tf = '$tf'
										WHERE no = '$cektemp[no]'");
				}else{
					if($yusuf3 <> ''){
						mysql_query("INSERT INTO indexing(
												idSample,
												kata,
												tf
											)VALUES(
												'$rs[idSample]',
												'$yusuf3',
												'1'
										)");
					}
				}
			}
		}
		
	}*/
	
	$isi 	= $_GET['isi'];	
	$title = $_GET['isi'];
	$message = $_GET['isi'];
	
	if(get_magic_quotes_gpc()){
		$title = stripslashes($title);
		//$message = stripslashes($message);
	}
	$title = mysql_real_escape_string($title);
	//$message = mysql_real_escape_string(bbcode_to_html($message));
	
	$message2 = strip_tags($message);
	$message1 = $message;
	
	$teks = strtolower($message2);
 
	$tokenKarakter=array('?','?',' ','/',',','?','.',':',';',',','!','[',']','{','}','(',')','-','_','+','=','<','>','\'','"','\\','@','#','$','%','^','&','*','`','~','0','1','2','3','4','5','6','7','8','9','â?','?','?','&nbsp;');
	$teks= str_replace($tokenKarakter,' ',$teks);
	$tok = strtok($teks, "\n\t");
	 
	while ($tok !== false) {
		$teks = $tok;
		$tok = strtok(" \n\t");
	}
	$katahasil="";
	$split = explode(' ',$teks);
	foreach($split as $key=>$kata){
		
		$yusuf = NAZIEF(trim($kata));	
		$ceksample3 = mysql_query("SELECT idSample,tf FROM indexing WHERE kata = '$yusuf'");
		
		while($rs3 = mysql_fetch_array($ceksample3)){
			mysql_query("INSERT INTO temp1(
										idSample,
										kata,
										jumlah
									)VALUES(
										'$rs3[idSample]',
										'$yusuf',
										'$rs3[tf]'
									)");
		}
		
	}
	
	$cekhasil = mysql_query("SELECT idSample FROM temp1 GROUP BY idSample");
		
	while($rhasil = mysql_fetch_array($cekhasil)){
		$cekhasils = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) as total FROM temp1 WHERE idSample = '$rhasil[idSample]'"));
		mysql_query("INSERT INTO temp3(
										idSample,
										jumlah
									)VALUES(
										'$rhasil[idSample]',
										'$cekhasils[total]'
									)");
	}
	
	$cekpertanyaan = mysql_fetch_array(mysql_query("SELECT pertanyaan.jawaban, pertanyaan.idPertanyaan FROM temp3 
													INNER JOIN pertanyaan 
														ON pertanyaan.idPertanyaan = temp3.idSample 
													ORDER BY temp3.jumlah DESC LIMIT 1"));
	
	mysql_query("INSERT INTO chat(
									pertanyaan,
									jawaban,
									dateChat,
									idUser2
								)VALUES(
									'$isi',
									'$cekpertanyaan[jawaban]',
									'$date $time',
									'$_SESSION[idUser]'
								)");
								
	if($cekpertanyaan['idPertanyaan']==''){
		$jawaban = "Silahkan masukan pertanyaan yang sesuai dengan toko online kami, Terima Kasih";
	}else{
		$jawaban = $cekpertanyaan['jawaban'];
	}
								
	mysql_query("INSERT INTO chat(
									pertanyaan,
									idUser,
									jawaban,
									dateChat,
									idUser2
								)VALUES(
									'$isi',
									'1',
									'$jawaban',
									'$date $time',
									'$_SESSION[idUser]'
								)");	
								
								
	$query = mysql_query("SELECT * FROM chat WHERE idUser2 = '$_SESSION[idUser]'");
	while($r = mysql_fetch_array($query)){
		if($r['idUser']=='1'){
			echo"
				<div class='row msg_container base_sent'>
					<div class='col-md-2 col-xs-2 avatar'>
						<img src='upload/admin.png' class=' img-responsive '>
					</div>
					<div class='col-md-10 col-xs-10'>
						<div class='messages msg_sent'>
							<p>$r[jawaban]</p>
							<time datetime='2021-11-22'>Admin</time>
						</div>
					</div>
				</div>
			";
		}else{
			echo"
				<div class='row msg_container base_sent'>
					<div class='col-md-10 col-xs-10'>
						<div class='messages msg_sent'>
							<p>$r[pertanyaan]</p>
							<time datetime='2021-11-22'>Pengunjung</time>
						</div>
					</div>
					<div class='col-md-2 col-xs-2 avatar'>
						<img src='upload/pembeli.jpg' class=' img-responsive '>
					</div>
				</div>
			";
		}
	}
?>