<?php $__env->startSection('content'); ?>

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
      <th scope="row"><?php echo e($value->id); ?></th>
      <td><?php echo e($value->nome); ?></td>
      <td><?php echo e($value->cpf); ?></td>
      <td><?php echo e($value->debito); ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php echo e($clientes->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>