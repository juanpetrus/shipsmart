
		<div class="col-md-12 mt-3 mb-3">
      <h3>Itens:
      <a href="index.php?exe=itens/create" title="Itens" class="btn btn-primary" style="float:right;"><i class="fas fa-plus"></i> Novo Item</a></h3>
    </div>

    <?php
			if(!empty($_SESSION['cadastro'])){
				echo $_SESSION['cadastro'];
				unset($_SESSION['cadastro']);
			}

			//REMOVE O ITEM
			if(!empty($_GET['delid'])){
				$delId = $_GET['delid'];
				if (delete_mongodb(['sku' => $delId], $collection) && delete('itens',"sku = '$delId'", $mysqli_connection)):
					$_SESSION['trash'] = "<script>swal('Item', 'Item excluido com sucesso', 'success')</script>";
				endif;
			}
			
			$itens = read_mongodb('', $collection);

			if(!$itens){
				echo '<div class="alert alert-primary" role="alert">Não existem registros!</div>';
			}else{
				echo '<table class="table" cellspacing="0" cellpadding="0">
					<tr>
						<th>SKU</td>
						<th>Item</td>
						<th>Descrição:</td>
						<th>Valor:</td>
						<th>Moeda:</td>
						<th>Peso:</td>
						<th colspan="2">ações:</td>
					</tr>';
					foreach($itens as $item):
					echo '<tr>';
					echo '<td>'.$item['sku'].'</td>';
					echo '<td>'.lmWord($item['nome'],20).'</td>';
					echo '<td>'.lmWord($item['descricao'],30).'</td>';
					echo '<td>'.lmWord($item['valor'],30).'</td>';
					echo '<td>'.lmWord($item['moeda'],30).'</td>';
					echo '<td>'.lmWord($item['peso'],30).'</td>';
					echo '<td align="center"><a href="index.php?exe=itens/edit&editid='.$item['sku'].'" title="editar" class="btn btn-primary">';
						echo '<i class="fas fa-edit"></i></a></a></td>';
					echo '<td align="center"><a href="index.php?exe=itens/index&delid='.$item['sku'].'"';
						echo 'title="excluir" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>';
					echo '</tr>';
				endforeach;
				echo '</table>';
			}

	?>

    </div><!-- /paginator -->
</div><!-- /bloco list -->
