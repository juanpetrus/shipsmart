    <div class="col-md-12 mt-3 mb-3">
      <h3>Publicar novo item:
      <a href="index.php?exe=itens/index" title="Itens" class="btn btn-danger" style="float:right;"><i class="fas fa-list-ol"></i> Listar Itens</a></h3>
    </div>
       <hr>

    <?php
    if(isset($_POST['sendForm'])  && $_POST['cadastro'] == 'ok'){
      $f['sku'] 		        = htmlspecialchars(setUri($_POST['sku']));
      $f['nome'] 		        = htmlspecialchars(setUri($_POST['nome']));
      $f['descricao'] 			= htmlspecialchars(setUri($_POST['descricao']));
      $f['valor'] 		      = $_POST['valor'];
      $f['moeda'] 			    = htmlspecialchars($_POST['moeda']);
      $f['peso'] 	          = htmlspecialchars($_POST['peso']);
      
      $itens = read_mongodb(['sku' => $f['sku']], $collection);
      if ($itens):
        echo '<div class="alert alert-danger" role="alert">Esse registro ja existe na base de dados!</div>';
        echo "<script>swal('Item', 'Já exiteste esse registro', 'error')</script>";
      else:
        if(in_array('',$f)){
          echo '<div class="alert alert-info" role="alert">Para uma boa alimentação, informe todos os campos!</div>';
          echo "<script>swal('Item', 'error ao cadastradar', 'error')</script>";
        }else{
          if (create_mongodb($f, $collection) && create('itens',$f,$mysqli_connection)):
            $_SESSION['cadastro'] = "<script>swal('Item', 'Cadastrado com sucesso', 'success')</script>";
            header('Location: index.php?exe=itens/index');
          else:
            $_SESSION['cadastro'] = "<script>swal('Error', 'Error ao cadastrar no banco', 'error')</script>";
          endif;
        }
      endif;
	  }
	?>
    <div class="col-md-12 mt-3">
      <form name="formulario" action="" method="post" enctype="multipart/form-data">
          <div class="row">

          <div class="col-md-2">
          <div class="form-group">
              <label>SKU:</label>
              <input type="text" class="form-control alpha" name="sku" maxlength="8" value="<?php echo ($f['sku']) ?  $f['sku'] : sprintf('%07X', mt_rand(0, 0xFFFFFFFF)); ?>" />
          </div>
          </div>

          <div class="col-md-10">
          <div class="form-group">
              <label>Nome:</label>
              <input type="text" class="form-control" name="nome" value="<?php if($f['nome']) echo $f['nome'];?>" />
          </div>
          </div>

          <div class="col-md-4">
          <div class="form-group">
              <label>Valor:</label>
              <input type="text" name="valor" class="form-control money" value="<?php if($f['valor']) echo $f['valor'];?>" />
          </div>
          </div>

          <div class="col-md-4">
          <div class="form-group">
              <label>Moeda:</label>
              <select class="form-control" name="moeda">
                <option value="<?php echo ($f['moeda']) ? $f['moeda'] : ''; ?>" selected><?php echo ($f['moeda']) ? $f['moeda'] : 'Ecolher...'; ?></option>
                <option value="USD">USD</option>
                <option value="BRL">BRL</option>
                <option value="EUR">EUR</option>
              </select>
          </div>
          </div>

          <div class="col-md-4">
          <div class="form-group">
              <label>Peso:</label>
              <input type="text" name="peso" class="form-control weight" value="<?php if($f['peso']) echo $f['peso'];?>" />
          </div>
          </div>
          
          <div class="col-md-12">
          <div class="form-group">
              <label>Descrição:</label>
              <textarea name="descricao" class="form-control" rows="15"><?php if($f['descricao']) echo htmlspecialchars($f['descricao']);?></textarea>
          </div>
          </div>

          <div class="col-md-12">
          <input type="hidden" name="cadastro" value="ok" />
          <input type="submit" value="Publicar Item" name="sendForm" class="btn btn-success" />
          </div>
          </div>
      </form>    
    </div>    
