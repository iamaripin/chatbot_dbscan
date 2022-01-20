<?php
include "koneksi.php";
function wordtotext($teks){
	$word = new COM("word.application") or die ("Could not initialise MS Word object.");
	//$word->visible = true;
	$word->Documents->Open($teks);
	// Extract content.
	$content = (string) $word->ActiveDocument->Content;
	// save the document as HTML
	//$word->Documents[1]->SaveAs("E:/dokumen/sample.txt",2);
	$word->ActiveDocument->Close(false);
	$word->Quit();
	$word = null;
	unset($word);
	//echo $teks;
	return $content;
}

function tokenisasi($teks){
	$teks5 = strtolower($teks);
	$trim=trim($teks5);
	$tokenKarakter=array('’',chr(7),chr(150),chr(124),chr(133),chr(1),chr(0),'±','‘','—',' ','/','?','.',':',';',',','!','[',']','{','}','(',')','-','_','+','=','<','>','\'','"','\\','#','$','%','^','&','*','`','~','â€','”','“');
	$string = str_replace($tokenKarakter," ",$trim);
	$split=preg_split("/[\s]+/", $string) ;
	//print_r($split);
	return $split;
}

function stopword($teks){
	$qry = 'SELECT stoplist FROM stoplist';
	$query = mysql_query($qry);
	$i=0;
	while($result=mysql_fetch_array($query)){
	$stopword[$i] =$result[0];
	$i++;}
	$hapus = array_diff($teks,$stopword);
	//print($stoplist);
	$gabung = implode(" ",$hapus);
	return $gabung;
}

function stem($teks){

}
?>