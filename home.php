<h1 class="mt-3 mb-3">Dashboard</h1>
<div class="alert alert-info" role="alert">Olá! Seja bem vindo ao sitema ShipSmart! Qualidade é aqui.</div>
<?php $itens = read_mongodb('', $collection); ?>
<div class="card">
  <div class="card-body">
    <div class="row align-items-center">
      <div class="col">

        <!-- Title -->
        <h6 class="text-uppercase text-muted mb-2">
          Itens Cadastrados
        </h6>

        <!-- Heading -->
        <span class="h2 mb-0">
          <?php echo count($itens); ?>
        </span>

      </div>
      <div class="col-auto">

        <!-- Icon -->
        <span class="h2 fe fe-dollar-sign text-muted mb-0"></span>

      </div>
    </div> <!-- / .row -->
  </div>
</div>
