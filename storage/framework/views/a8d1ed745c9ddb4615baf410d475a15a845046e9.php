<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(url('/Cliente/test')); ?>" method="post">
        <div class="input-group">
        <?php echo e(csrf_field()); ?>

            <div class="col-lg-6">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Enviar!</button>
            </span></div>
       
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
      <th scope="row"><input type="radio" value="<?php echo e($value->id); ?>" name="id"></th>
      <td><?php echo e($value->nome); ?></td>
      <td><?php echo e($value->cpf); ?></td>
      <td><?php echo e($value->debito); ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div><!-- /input-group -->
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>