<?php $__env->startSection('content'); ?>

<?php if(session()->has('msg')): ?>
<div class="alert alert-success" role="alert">
  <p><b>CODE: D102 </b> - Dados dos clientes atualizados com sucesso.</p>
</div>
<hr>
<?php endif; ?>

<?php if(session()->has('D301')): ?>
<div class="alert alert-success" role="alert">
  <p><b>CODE: <?php echo e(session('D301')); ?>< </b> - Reserva efetuada com sucesso!</p>
</div>
<hr>
<?php endif; ?>


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