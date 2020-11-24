<?php
/*****************************
SETA URL DA HOME
*****************************/

	function setHome(){
		echo BASE;	
	}
	
/*****************************
INCLUE ARQUIVOS
*****************************/

	function setArq($nomeArquivo){
		if(file_exists($nomeArquivo.'.php')){
			include($nomeArquivo.'.php');
		}else{
			echo 'Erro ao incluir <strong>'.$nomeArquivo.'.php</strong>, arquivo ou caminho não conferem!';	
		}
	}

/*****************************
TRANFORMA STRING EM URL
*****************************/

	function setUri($string){
		$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
		$b = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';	
		$string = utf8_decode($string);
		$string = strtr($string, utf8_decode($a), $b);
		$string = strip_tags(trim($string));
		return strtolower(utf8_encode($string));
	}

?>