<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Busca de cliente por nome</div>

                <div class="panel-body">
                    <form action="<?php echo e(url('/Cliente/busca')); ?>" method="post">
                        <div class="input-group">
                            <?php echo e(csrf_field()); ?>

                            <input type="text" class="form-control" name="nome" placeholder="Busca de Cliente">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Buscar!</button>
                            </span>
                        </div><!-- /input-group -->
                    </form>
                <br>

                <?php if(session()->has('Er404')): ?>
                <div class="alert alert-danger" role="alert">
                <b>CODE: <?php echo e(session('Er404')); ?></b>
                Cliente não encontrado!
                </div>
                <?php endif; ?>

                <?php if(session()->has('Er400')): ?>
                <div class="alert alert-danger" role="alert">
                <b>CODE: <?php echo e(session('Er400')); ?></b>
                Cliente desatualizado!
                </div>
                <?php endif; ?>

                <?php if(session()->has('Er101')): ?>
                <div class="alert alert-danger" role="alert">
                <b>CODE: <?php echo e(session('Er101')); ?></b>
                Endereço não preenchido!
                </div>
                <?php endif; ?>
                
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>