<?php $__env->startSection('content'); ?>
<div class="col-lg-6">
    <form action="<?php echo e(url('/Cliente/busca')); ?>" method="post">
        <div class="input-group">
<?php echo e(csrf_field()); ?>

            <input type="text" class="form-control" name="nome" placeholder="Busca de Cliente">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Buscar!</button>
            </span>
        </div><!-- /input-group -->
    </form>
</div><!-- /.col-lg-6 -->
<br>
<?php if(session()->has('msg')): ?>
<div
  id="st"
  class="alert alert-sucess">
  <p><?php echo e(session('msg')); ?></p>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>