<?php
/*****************************
GERA RESUMOS
*****************************/

	function lmWord($string, $words = '100'){
		$string 	= strip_tags($string);
		$count		= strlen($string);
		
		if($count <= $words){
			return $string;	
		}else{
			$strpos = strrpos(substr($string,0,$words),' ');
			return substr($string,0,$strpos).'...';
		}
		
	}
	
/*****************************
VALIDA O CPF
*****************************/	

	function valCpf($cpf){
		$cpf = preg_replace('/[^0-9]/','',$cpf);
		$digitoA = 0;
		$digitoB = 0;
		for($i = 0, $x = 10; $i <= 8; $i++, $x--){
			$digitoA += $cpf[$i] * $x;
		}
		for($i = 0, $x = 11; $i <= 9; $i++, $x--){
			if(str_repeat($i, 11) == $cpf){
				return false;
			}
			$digitoB += $cpf[$i] * $x;
		}
		$somaA = (($digitoA%11) < 2 ) ? 0 : 11-($digitoA%11);
		$somaB = (($digitoB%11) < 2 ) ? 0 : 11-($digitoB%11);
		if($somaA != $cpf[9] || $somaB != $cpf[10]){
			return false;	
		}else{
			return true;
		}
	}	

/*****************************
VALIDA O EMAIL
*****************************/	
	
	function valMail($email){
		if(preg_match('/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/',$email)){
			return true;
		}else{
			return false;
		}
	}
	
/*****************************
ENVIA O EMAIL
*****************************/	

	function sendMail($assunto,$mensagem,$remetente,$nomeRemetente,$destino,$nomeDestino, $reply = NULL, $replyNome = NULL){
		
		require_once('mail/class.phpmailer.php'); //Include pasta/classe do PHPMailer
		
		$mail = new PHPMailer(); //INICIA A CLASSE
		$mail->IsSMTP(); //Habilita envio SMPT
		$mail->SMTPAuth = true; //Ativa email autenticado
		$mail->IsHTML(true);
		
		$mail->Host = MAILHOST; //Servidor de envio
		$mail->Port = MAILPORT; //Porta de envio
		$mail->Username = MAILUSER; //email para smtp autenticado
		$mail->Password = MAILPASS; //seleciona a porta de envio
		
		$mail->From = utf8_decode($remetente); //remtente
		$mail->FromName = utf8_decode($nomeRemetente); //remtetene nome
		
		if($reply != NULL){
			$mail->AddReplyTo(utf8_decode($reply),utf8_decode($replyNome));	
		}
		
		$mail->Subject = utf8_decode($assunto); //assunto
		$mail->Body = utf8_decode($mensagem); //mensagem
		$mail->AddAddress(utf8_decode($destino),utf8_decode($nomeDestino)); //email e nome do destino
		
		if($mail->Send()){
			return true;
		}else{
			return false;
		}
	}	

/*****************************
FORMATA DATA EM TIMESTAMP
*****************************/	

	function formDate($data){
		$timestamp = explode(" ",$data);
		$getData = $timestamp[0];
		$getTime = $timestamp[1];
		
			$setData = explode('/',$getData);
			$dia = $setData[0];
			$mes = $setData[1];
			$ano = $setData[2];
			
		if(!$getTime):
			$getTime = date('H:i:s');
		endif;
			
		$resultado = $ano.'-'.$mes.'-'.$dia.' '.$getTime;
		
		return $resultado;
		
	}
	

/*****************************
Paginação de resultados
*****************************/

	function readPaginator($tabela, $cond, $mysqli_connection, $maximos, $link, $pag, $width = NULL, $maxlinks = 4){
		$readPaginator = read("$tabela","$cond", $mysqli_connection);
		$total = count($readPaginator);
		if($total > $maximos){
			$paginas = ceil($total/$maximos);
	
			echo '<nav aria-label="...">';
			echo '<ul class="pagination">';
			echo '<li class="page-item"><a href="'.$link.'1" class="page-link">Primeira Página</a></li>';
			for($i = $pag - $maxlinks; $i <= $pag - 1; $i++){
				if($i >= 1){
					echo '<li class="page-item"><a href="'.$link.$i.'" class="page-link">'.$i.'</a></li>';
				}
			}
			echo '<li class="page-item active"><a class="page-link" href="#">'.$pag.'</a></li>';
			for($i = $pag + 1; $i <= $pag + $maxlinks; $i++){
				if($i <= $paginas){
					echo '<li class="page-item"><a href="'.$link.$i.'" class="page-link">'.$i.'</a></li>';
				}
			}
			echo '<a href="'.$link.$paginas.'" class="page-link">Última Página</a></li>';
			echo '</ul><!-- ul/paginator -->';
			echo '</nav><!-- /paginator -->';
		}
	}

?>