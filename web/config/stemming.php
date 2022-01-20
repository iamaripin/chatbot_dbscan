<?php
require_once('koneksi.php');
// fungsi-fungsi
/*

DP + DP + root word + DS + PP + P

DP : Derivation Prefix
DS : Derivation Suffix
PP : Possessive Pronoun (Inflection) [ku,mu,nya]
P : Particle (Inflection) [lah,kah,]

Affik = Imbuhan
Prefik = Awalan
Suffix = Akhiran
Infix = Sisipan 
Konfix = Awalan dan Akhiran


Prefix Disallowed suffixes
be- -i
di- -an
ke- -i, -kan [kecuali: ke-tahu-i]
me- -an
se- -i,-kan
te- -an

Nazief and Adriani’s Algorithm 

*/
					
function cekKamus($kata){
	// cari di database	
	$sql = "SELECT * FROM stopword WHERE kataStopword ='$kata' LIMIT 1";
	//echo $sql.'<br/>';
	$result = mysql_query($sql) or die(mysql_error());  
	if(mysql_num_rows($result)==1){
		return true; // True jika ada
	}else{
		return false; // jika tidak ada FALSE
	}
}

/*============= Stemming dengan Metode Nazief and Adriani’s Algorithm ===============================*/
/*
DP + DP + DP + root word + DS + PP + P

DP : Derivation Prefix
DS : Derivation Suffix
PP : Possessive Pronoun (Inflection) [ku,mu,nya]
P : Particle (Inflection) [lah,kah,]
*/

// Hapus Inflection Suffixes (“-lah”, “-kah”, “-ku”, “-mu”, atau “-nya”)
function Del_Inflection_Suffixes($kata){ 
	$kataAsal = $kata;
	if(eregi('([km]u|nya|[kl]ah|pun)$',$kata)){ // Cek Inflection Suffixes
		$__kata = eregi_replace('([km]u|nya|[kl]ah|pun)$','',$kata);
		if(eregi('([klt]ah|pun)$',$kata)){ // Jika berupa particles (“-lah”, “-kah”, “-tah” atau “-pun”)
			if(eregi('([km]u|nya)$',$__kata)){ // Hapus Possesive Pronouns (“-ku”, “-mu”, atau “-nya”)
				$__kata__ = eregi_replace('([km]u|nya)$','',$__kata);
				return $__kata__;
			}
		}
		return $__kata;	
	}
	return $kataAsal;
}


// Cek Prefix Disallowed Sufixes (Kombinasi Awalan dan Akhiran yang tidak diizinkan)
function Cek_Prefix_Disallowed_Sufixes($kata){
	if(eregi('^(be)[[:alpha:]]+(i)$',$kata)){ // be- dan -i
		return true;
	}
	if(eregi('^(di)[[:alpha:]]+(an)$',$kata)){ // di- dan -an				
		return true;
		
	}
	if(eregi('^(ke)[[:alpha:]]+(i|kan)$',$kata)){ // ke- dan -i,-kan
		return true;
	}
	if(eregi('^(me)[[:alpha:]]+(an)$',$kata)){ // me- dan -an
		return true;
	}
	if(eregi('^(se)[[:alpha:]]+(i|kan)$',$kata)){ // se- dan -i,-kan
		return true;
	}
	return false;
}

// Hapus Derivation Suffixes (“-i”, “-an” atau “-kan”)
function Del_Derivation_Suffixes($kata){
	$kataAsal = $kata;
	if(eregi('(i|an)$',$kata)){ // Cek Suffixes
		$__kata = eregi_replace('(i|an)$','',$kata);		
		if(cekKamus($__kata)){ // Cek Kamus			
			return $__kata;
		}
		/*-- Jika Tidak ditemukan di kamus --*/
		if(eregi('(kan)$',$kata)){ // cek -kan 				
			$__kata__ = eregi_replace('(kan)$','',$kata);
			if(cekKamus($__kata__)){ // Cek Kamus
				return $__kata__;
			}
		}
		if(Cek_Prefix_Disallowed_Sufixes($kata)){
			return $kataAsal;
		}
		
	}
	return $kataAsal;
}

// Hapus Derivation Prefix (“di-”, “ke-”, “se-”, “te-”, “be-”, “me-”, atau “pe-”)
function Del_Derivation_Prefix($kata){
	$kataAsal = $kata;	
		
	/* ------ Tentukan Tipe Awalan ------------*/
	if(eregi('^(di|[ks]e)',$kata)){ // Jika di-,ke-,se-
		$__kata = eregi_replace('^(di|[ks]e)','',$kata);
		if(cekKamus($__kata)){			
			return $__kata; // Jika ada balik
		}
		$__kata__ = Del_Derivation_Suffixes($__kata);
		if(cekKamus($__kata__)){
			return $__kata__;
		}
		/*------------end “diper-”, ---------------------------------------------*/
		if(eregi('^(diper)',$kata)){			
			$__kata = eregi_replace('^(diper)','',$kata);
			if(cekKamus($__kata)){			
				return $__kata; // Jika ada balik
			}
			$__kata__ = Del_Derivation_Suffixes($__kata);
			if(cekKamus($__kata__)){
				return $__kata__;
			}
			/*-- Cek luluh -r ----------*/
			$__kata = eregi_replace('^(diper)','r',$kata);
			if(cekKamus($__kata)){			
				return $__kata; // Jika ada balik
			}
			$__kata__ = Del_Derivation_Suffixes($__kata);
			if(cekKamus($__kata__)){
				return $__kata__;
			}
		}
		/*------------end “diper-”, ---------------------------------------------*/
	}
	if(eregi('^([tmbp]e)',$kata)){ //Jika awalannya adalah “te-”, “me-”, “be-”, atau “pe-”
		
		/*------------ Awalan “te-”, ---------------------------------------------*/
		if(eregi('^(te)',$kata)){ // Jika awalan “te-”,
			/* Cara Menentukan Tipe Awalan Untuk Kata Yang Diawali Dengan “te-”
			Following Characters
			Set 1 					Set 2 					Set 3 		Set 4 		Tipe Awalan
		1.	“-r-“ 					“-r-“ 					- 			- 			none
		2.	“-r-“ 					Vowel (aiueo) 			- 			- 			ter-luluh
		3.	“-r-“ 					not(vowel or “-r-”) 	“-er-“ 		vowel 		ter
		4.	“-r-“ 					not(vowel or “-r-”) 	“-er-“ 		not vowel 	ter-
		5.	“-r-“ 					not(vowel or “-r-”) 	not “-er-“ 	- 			ter
		6.	not(vowel or “-r-”) 	“-er-“ 					vowel 		- 			none
		7.	not(vowel or “-r-”) 	“-er-“ 					not vowel 	- 			te
			*/
			if(eregi('^(terr)',$kata)){ // 1.
				return $kata;
			}
			if(eregi('^(ter)[aiueo]',$kata)){ // 2.
				$__kata = eregi_replace('^(ter)','',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
			}
			if(eregi('^(ter[^aiueor]er[aiueo])',$kata)){ // 3.
				$__kata = eregi_replace('^(ter)','',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
			}
			if(eregi('^(ter[^aiueor]er[^aiueo])',$kata)){ // 4.
				$__kata = eregi_replace('^(ter)','',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
			}
			if(eregi('^(ter[^aiueor][^(er)])',$kata)){ // 5.
				$__kata = eregi_replace('^(ter)','',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
			}
			if(eregi('^(te[^aiueor]er[aiueo])',$kata)){ // 6.
				return $kata; // return none
			}
			if(eregi('^(te[^aiueor]er[^aiueo])',$kata)){ // 7.
				$__kata = eregi_replace('^(te)','',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
			}
		}
		/*------------end “te-”, ---------------------------------------------*/
		/*------------ Awalan “me-”, ---------------------------------------------*/
		if(eregi('^(me)',$kata)){ // Jika awalan “me-”,
			/* Cara Menentukan Tipe Awalan Untuk Kata Yang Diawali Dengan “me-”
			Following Characters
			Set 1 					Set 2 					Set 3 		Set 4 		Tipe Awalan
		1.	“-ng-“ 					Vowel [kghq] 			- 			- 			meng-
		2.	“-ny-“ 					Vowel (aiueo) 			- 			- 			meny-s
		3.	“-m-“ 					[bfpv]				 	- 			- 			mem-
		4.	“-n-“ 					[cdjsz] 				- 			- 			men-
		5.	- 						- 						- 			-			me-

			*/
			if(eregi('^(meng)[aiueokghq]',$kata)){ // 1.
				$__kata = eregi_replace('^(meng)','',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}				
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
				/*--- cek luluh k- --------*/
				$__kata = eregi_replace('^(meng)','k',$kata); // luluh k-
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
			}
			
			if(eregi('^(meny)',$kata)){ // 2.
				$__kata = eregi_replace('^(meny)','s',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
			}
			if(eregi('^(mem)[bfpv]',$kata)){ // 3.
				$__kata = eregi_replace('^(mem)','',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
				/*--- cek luluh p- --------*/
				$__kata = eregi_replace('^(mem)','p',$kata); // luluh p-
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
			}
			if(eregi('^(men)[cdjsz]',$kata)){ // 4.
				$__kata = eregi_replace('^(men)','',$kata);	
				
				if(cekKamus($__kata)){
					
					return $__kata; // Jika ada balik
				}				
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){					
					return $__kata__;
				}				
			}
			if(eregi('^(me)',$kata)){ // 5.
				$__kata = eregi_replace('^(me)','',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
				/*--- cek luluh t- --------*/
				$__kata = eregi_replace('^(men)','t',$kata); // luluh t-
				
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
				
			}
		}
		/*------------end “me-”, ---------------------------------------------*/
		/*------------ Awalan “be-”, ---------------------------------------------*/
		if(eregi('^(be)',$kata)){ // Jika awalan “be-”,
			/* Cara Menentukan Tipe Awalan Untuk Kata Yang Diawali Dengan “be-”
			Following Characters
			Set 1 					Set 2 					Set 3 		Set 4 		Tipe Awalan
		1.	“-r-“ 					Vowel 					- 			- 			ber-
		2.	“-r-“ 					Not Vowel 	 			- 			- 			ber-
		3.	“-k-“ 					-				 		- 			- 			be-


			*/
			if(eregi('^(ber)[aiueo]',$kata)){ // 1.
				$__kata = eregi_replace('^(ber)','',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata = eregi_replace('^(ber)','r',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}				
			}
			
			if(eregi('(ber)[^aiueo]',$kata)){ // 2.
				$__kata = eregi_replace('(ber)','',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
			}
			if(eregi('^(be)[k]',$kata)){ // 3.
				$__kata = eregi_replace('^(be)','',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
			}
		}
		/*------------end “be-”, ---------------------------------------------*/
		/*------------ Awalan “pe-”, ---------------------------------------------*/
		
		if(eregi('^(pe)',$kata)){ // Jika awalan “pe-”,
			/* Cara Menentukan Tipe Awalan Untuk Kata Yang Diawali Dengan “pe-”
			Following Characters
			Set 1 					Set 2 					Set 3 		Set 4 		Tipe Awalan
		1.	“-ng-“ 					Vowel [kghq] 			- 			- 			peng-
		2.	“-ny-“ 					Vowel (aiueo) 			- 			- 			peny-s
		3.	“-m-“ 					[bfpv]				 	- 			- 			pem-
		4.	“-n-“ 					[cdjsz] 				- 			- 			pen-
		5.	“-r-“ 					- 						- 			-			per-
		6.	- 						- 						- 			-			pe-

			*/			
			if(eregi('^(peng)[aiueokghq]',$kata)){ // 1.
				$__kata = eregi_replace('^(peng)','',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}				
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}				
			}
			
			
			
			if(eregi('^(peng)',$kata)){ // 1.
				$__kata = eregi_replace('^(peng)','k',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}				
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}				
			}
			
			if(eregi('^(peny)',$kata)){ // 2.
				$__kata = eregi_replace('^(peny)','s',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
			}
			if(eregi('^(pem)[bfpv]',$kata)){ // 3.
				$__kata = eregi_replace('^(pem)','',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}

				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
			}
			if(eregi('^(pen)[cdjsz]',$kata)){ // 4.
				$__kata = eregi_replace('^(pen)','',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
				
				/*-- Cek luluh -p ----------*/
				$__kata = eregi_replace('^(pem)','p',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
			}
			
			if(eregi('^(pen)',$kata)){ // 4.
				$__kata = eregi_replace('^(pen)','t',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
			}
			
			if(eregi('^(per)',$kata)){ // 5.				
				$__kata = eregi_replace('^(per)','',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
				/*-- Cek luluh -r ----------*/
				$__kata = eregi_replace('^(per)','r',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
			}
			if(eregi('^(pe)',$kata)){ // 6.
				$__kata = eregi_replace('^(pe)','',$kata);
				if(cekKamus($__kata)){			
					return $__kata; // Jika ada balik
				}
				$__kata__ = Del_Derivation_Suffixes($__kata);
				if(cekKamus($__kata__)){
					return $__kata__;
				}
			}
		}
		/*------------end “pe-”, ---------------------------------------------*/
		/*------------ Awalan “memper-”, ---------------------------------------------*/
		
		if(eregi('^(memper)',$kata)){				
			$__kata = eregi_replace('^(memper)','',$kata);
			if(cekKamus($__kata)){			
				return $__kata; // Jika ada balik
			}
			$__kata__ = Del_Derivation_Suffixes($__kata);
			if(cekKamus($__kata__)){
				return $__kata__;
			}
			/*-- Cek luluh -r ----------*/
			$__kata = eregi_replace('^(memper)','r',$kata);
			if(cekKamus($__kata)){			
				return $__kata; // Jika ada balik
			}
			$__kata__ = Del_Derivation_Suffixes($__kata);
			if(cekKamus($__kata__)){
				return $__kata__;
			}
		}		
		
	}
	
	/* --- Cek Ada Tidaknya Prefik/Awalan (“di-”, “ke-”, “se-”, “te-”, “be-”, “me-”, atau “pe-”) ------*/
	if(eregi('^(di|[kstbmp]e)',$kata) == FALSE){
		return $kataAsal;
	}
	
	return $kataAsal;
}

function NAZIEF($kata){
	
	$kataAsal = $kata;
	
	/* 1. Cek Kata di Kamus jika Ada SELESAI */
	if(cekKamus($kata)){ // Cek Kamus
		return $kata; // Jika Ada kembalikan
	}
	
	/* 2. Buang Infection suffixes (\-lah", \-kah", \-ku", \-mu", atau \-nya") */
	$kata = Del_Inflection_Suffixes($kata);
	
	/* 3. Buang Derivation suffix (\-i" or \-an") */
	$kata = Del_Derivation_Suffixes($kata);
	
	/* 4. Buang Derivation prefix */
	$kata = Del_Derivation_Prefix($kata);
	
	
	return $kata;

}
?>