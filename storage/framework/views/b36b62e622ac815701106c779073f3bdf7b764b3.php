<?php $__env->startSection('content'); ?>
<div class="col-lg-6">
    <form action="<?php echo e(url('/Cliente/busca')); ?>" method="post">
        <div class="input-group">
<?php echo e(csrf_field()); ?>

            <input type="text" class="form-control" name="nome" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Go!</button>
            </span>
        </div><!-- /input-group -->
    </form>
</div><!-- /.col-lg-6 -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>