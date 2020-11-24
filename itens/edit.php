<?php
		
		$urledit  = $_GET['editid'];
		$readEdit = read_mongodb(['sku' => $urledit], $collection);
		if(!$readEdit){
			header('Location: index.php?exe=itens/index');
		}else
			foreach($readEdit as $itemEdit);
?>
<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        Editar Item: <strong style="color:#900"><?php echo $itemEdit['nome'];?></strong>
        <a href="index.php?exe=itens/index" title="Páginas" class="btn btn-danger" style="float:right;"><i class="fas fa-list-ol"></i> Listar itens</a>
    </div>
       
    <?php
    if(isset($_POST['sendForm'])  && $_POST['cadastro'] == 'ok'){
      $f['sku'] 		        = htmlspecialchars(setUri($_POST['sku']));
      $f['nome'] 		        = htmlspecialchars(setUri($_POST['nome']));
      $f['descricao'] 			= htmlspecialchars(setUri($_POST['descricao']));
      $f['valor'] 		      = $_POST['valor'];
      $f['moeda'] 			    = htmlspecialchars($_POST['moeda']);
      $f['peso'] 	          = htmlspecialchars($_POST['peso']);

			if(in_array('',$f)){
				echo '<div class="alert alert-info" role="alert">Para uma boa alimentação, informe todos os campos!</div>';
			}else{
        if (update_mongodb(['sku' => $urledit],$f,$collection) && update('itens',$f,"sku = '$urledit'",$mysqli_connection)):
          $_SESSION['return'] = "<script>swal('Item', 'Atualizado com sucesso', 'success')</script>";
          header('Location: index.php?exe=itens/edit&editid='.$urledit);
        else:
          $_SESSION['cadastro'] = "<script>swal('Error', 'Error ao cadastrar no banco', 'error')</script>";
        endif;
			}
		}elseif(!empty($_SESSION['return'])){
			echo $_SESSION['return'];
			unset($_SESSION['return']);
		}
		if(!empty($_SESSION['cadastro'])){
			echo $_SESSION['cadastro'];
			unset($_SESSION['cadastro']);
		}
	?>
    
  <div class="col-md-12 mt-3">
      <form name="formulario" action="" method="post" enctype="multipart/form-data">
          <div class="row">

					<div class="col-md-2">
          <div class="form-group">
              <label>SKU:</label>
              <input type="text" class="form-control alpha" name="sku" maxlength="8" value="<?php echo $itemEdit['sku'];?>" readonly="readonly" />
          </div>
          </div>

          <div class="col-md-10">
          <div class="form-group">
              <label>Nome:</label>
              <input type="text" class="form-control" name="nome" value="<?php echo $itemEdit['nome'];?>" />
          </div>
          </div>

          <div class="col-md-4">
          <div class="form-group">
              <label>Valor:</label>
              <input type="text" name="valor" class="form-control money" value="<?php echo $itemEdit['valor'];?>" />
          </div>
          </div>

          <div class="col-md-4">
          <div class="form-group">
              <label>Moeda:</label>
							<select class="form-control" name="moeda">
                <option value="<?php echo $itemEdit['moeda'];?>" selected><?php echo $itemEdit['moeda'];?></option>
                <option value="USD">USD</option>
                <option value="BRL">BRL</option>
                <option value="EUR">EUR</option>
              </select>
          </div>
          </div>

          <div class="col-md-4">
          <div class="form-group">
              <label>Peso:</label>
              <input type="text" name="peso" class="form-control weight" value="<?php echo $itemEdit['peso'];?>" />
          </div>
          </div>
          
          <div class="col-md-12">
          <div class="form-group">
              <label>Descrição:</label>
              <textarea name="descricao" class="form-control" rows="15"><?php echo htmlspecialchars($itemEdit['descricao']);?></textarea>
          </div>
          </div>

					<div class="col-md-12">
						<input type="hidden" name="cadastro" value="ok" />
						<input type="submit" value="Publicar Item" name="sendForm" class="btn btn-success" />
					</div>

          </div>
      </form>    
    </div> 