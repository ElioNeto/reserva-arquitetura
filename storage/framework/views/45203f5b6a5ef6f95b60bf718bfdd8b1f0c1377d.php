<?php $__env->startSection('content'); ?>

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Reserva de Quarto</div>
        <div class="panel-body">

          <form action="<?php echo e(url('/Reserva/finalizar')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" value="<?php echo e($clientes); ?>" name="cliente" checked>&nbsp;
            <div class="alert alert-info" role="alert"><label>Cliente OK </label></div>
            <hr>
            <h3>Quartos</h3>
            <br>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($quartos as $key => $value): ?>
                  <tr>
                    <?php if($value->status=='0'): ?>
                    <th scope="row"><input type="radio" value="<?php echo e($value->id); ?>" name="quarto"></th>
                    <?php else: ?>
                    <th scope="row"><input type="radio" value="<?php echo e($value->id); ?>" name="id" disabled></th>
                    <?php endif; ?>
                    <td><?php echo e($value->descricao); ?></td>
                    <td><?php echo e($value->valor); ?></td>
                    <?php if($value->status=='0'): ?>
                      <td>Livre</td>
                    <?php else: ?>
                      <td>Ocupado</td>
                    <?php endif; ?>
                    <?php if($value->status=='0'): ?>
                    <td><button class="btn btn-default" type="submit">Prosseguir!</button></td>
                    <?php else: ?>
                    <td><button class="btn btn-default" type="submit" disabled>Ocupado!</button></td>
                    <?php endif; ?>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
  
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>