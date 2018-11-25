<?php $__env->startSection('content'); ?>
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Resultado da busca</div>
        <div class="panel-body">

          <form action="<?php echo e(url('/Reserva/quarto')); ?>" method="post">
            <div class="input-group">
            <?php echo e(csrf_field()); ?>

              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($clientes as $key => $value): ?>
                  <tr>
                    <?php if($value->debito=='0'): ?>
                    <th scope="row"><input type="radio" value="<?php echo e($value->id); ?>" name="id"></th>
                    <?php else: ?>
                    <th scope="row"><input type="radio" value="<?php echo e($value->id); ?>" name="id" disabled></th>
                    <?php endif; ?>
                    <td><?php echo e($value->nome); ?></td>
                    <td><?php echo e($value->cpf); ?></td>
                    <?php if($value->debito == '0'): ?>
                    <td>Cliente Liberado</td>
                    <?php else: ?>
                    <td>Cliente com Pendências</td>
                    <?php endif; ?>
                    <?php if($value->debito=='0'): ?>
                    <td><button class="btn btn-default" type="submit">Prosseguir!</button></td>
                    <?php else: ?>
                    <td><b>Indisponível para reserva</b></td>
                    <?php endif; ?>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div><!-- /input-group -->
          </form>
        </div>
      </div> 
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>