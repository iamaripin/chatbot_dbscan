<?php
	include "config/koneksi.php";
	include "config/stemming.php";
	
	$truncate2 ="TRUNCATE TABLE indexing";
	mysql_query($truncate2);
					
	$cekpertanyaan = mysql_query("SELECT * FROM pertanyaan");
	//$preprocesing="";
	while($r = mysql_fetch_array($cekpertanyaan)){
		//preprocesing
		$message = $r['pertanyaan'];
				
		$message2 = strip_tags($message);
		//casefolding
		$teks = strtolower($message2);
		//cleaning
		$tokenKarakter=array('?','?',' ','/',',','?','.',':',';',',','!','[',']','{','}','(',')','-','_','+','=','<','>','\'','"','\\','@','#','$','%','^','&','*','`','~','0','1','2','3','4','5','6','7','8','9','â?','?','?','&nbsp;');
		$teks= str_replace($tokenKarakter,' ',$teks);
		$tok = strtok($teks, "\n\t");
		 
		//while ($tok !== false) {
			//$teks = $tok;
			//$tok = strtok(" \n\t");
		//}
		
		//tokenization,normalisasi,filtering	 
		$split = explode(' ',$teks);
		$preprocesing="";
		foreach($split as $key=>$katae){
			//$preprocesing = "$preprocesing $katae";
										
			//$ceknormal = mysql_query("SELECT * FROM normalisasi WHERE kata_tidakbaku = '$katae'");
			//$ceknormals = mysql_fetch_array($ceknormal);
			//$rownormals = mysql_num_rows($ceknormal);
			//if($rownormals>0){
				//$kata = "$ceknormals[kata_baku]";
			//}else{
				$kata = "$katae";
			//}
			
			
			
			//if ($cekstop==0) {
				$yayat = NAZIEF(trim($kata));				
				//$yayat = $kata;		
				
				$cekstop = mysql_num_rows(mysql_query("SELECT stoplist FROM stoplist WHERE lower(stoplist) = '$yayat'"));
				if($cekstop  == 0){				
					$preprocesing = "$preprocesing $yayat";
					
					$status = strtolower($r['status']);					
					$cekposneg = mysql_fetch_array(mysql_query("SELECT no,tf FROM indexing WHERE kata = '$yayat' AND idSample = '$r[idPertanyaan]'"));
					if($cekposneg['no']==''){
						if($yayat <> ''){
							mysql_query("INSERT INTO indexing(
													kata,
													status,
													tf,
													idSample
												)VALUES(
													'$yayat',
													'$status',
													'1',
													'$r[idPertanyaan]'
												)");
						}
					}else{
						$tf = $cekposneg['tf'] + 1;
						
						mysql_query("UPDATE indexing SET tf = '$tf'
													WHERE no = '$cekposneg[no]'");
					}
				}	
			//}
			
		}
		//mysql_query("UPDATE pertanyaan SET preprocesing = '$preprocesing' WHERE idPertanyaan = '$r[idPertanyaan]'");						
	}		

	
		
	echo"<script>
			location.assign('/chatbot/admin/admin/pertanyaans');
		</script>";
	exit;
	
?>