<?php
require('vendor/autoload.php');

/*****************************
CONEXAO COM BANCO MYSQL
*****************************/

$mysqli_connection = mysqli_connect('172.17.0.1', 'root', '123456', 'shipsmart', '3306') or die('Conexão falhou, erro: '.mysqli_connect_error());

if (!$mysqli_connection) {
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	exit;
}
/*****************************
CONEXAO COM BANCO MONGODB
*****************************/

$client = new MongoDB\Client('mongodb://172.17.0.1:27017');
$collection = $client->shipsmart->itens;

/*****************************
FUNÇÃO DE CADASTRO NO BANCO
*****************************/

	function create_mongodb(array $datas, $conx){
		$result = $conx->insertOne($datas);
		if($result){
			return true;
		}
	}

	function create($tabela, array $datas, $conx){
		$fields = implode(", ",array_keys($datas));
		$values = "'".implode("', '",array_values($datas))."'";			
		$qrCreate = "INSERT INTO {$tabela} ($fields) VALUES ($values)";
		$stCreate = mysqli_query($conx, $qrCreate) or die ('Erro ao cadastrar em '.$tabela.' '.mysqli_error());
		
		if($stCreate){
			return true;
		}
	}
	
/*****************************
FUNÇÃO DE CADASTRO NO BANCO
*****************************/

	function read_mongodb($cond = NULL, $conx){	
		if ($cond):
			$result = $conx->find($cond)->toArray();
		else:
			$result = $conx->find()->toArray();
		endif;
		return $result;
	}

	function read($tabela, $cond = NULL, $conx){		
		$qrRead = "SELECT * FROM {$tabela} {$cond}";
		$stRead = mysqli_query($conx, $qrRead) or die ('Erro ao ler em '.$tabela.' '.mysqli_error($stRead->error));
		$cField = mysqli_num_fields($stRead);
		
		for($y = 0; $y < $cField; $y++){
			$names[$y] = mysqli_fetch_field_direct($stRead,$y);
		}
		for($x = 0; $res = mysqli_fetch_assoc($stRead); $x++){
			for($i = 0; $i < $cField; $i++){
				$resultado[$x][$names[$i]->name] = $res[$names[$i]->name];
			}
		}
		return $resultado;
	}

	
/*****************************
FUNÇÃO DE EDIÇÃO NO BANCO
*****************************/	
	function update_mongodb($where, array $datas, $conx){
		$result = $conx->updateOne($where, ['$set' => $datas]);
		if($result){
			return true;
		}
	}

	function update($tabela, array $datas, $where, $conx){
		foreach($datas as $fields => $values){
			$campos[] = "$fields = '$values'";
		}
		
		$campos = implode(", ",$campos);
		$qrUpdate = "UPDATE {$tabela} SET $campos WHERE {$where}";
		$stUpdate = mysqli_query($conx,$qrUpdate) or die ('Erro ao atualizar em '.$tabela.' '.mysql_error());

		if($stUpdate){
			return true;	
		}
		
	}
	
/*****************************
FUNÇÃO DE DELETAR NO BANCO
*****************************/

	function delete_mongodb($where, $conx){
		$result = $conx->deleteOne($where);
		if($result){
			return true;	
		}
	}

	function delete($tabela, $where, $conx){
		$qrDelete = "DELETE FROM {$tabela} WHERE {$where}";
		$stDelete = mysqli_query($conx,$qrDelete) or die ('Erro ao deletar em '.$tabela.' '.mysql_error());
		if($stDelete){
			return true;	
		}
	}

?>

