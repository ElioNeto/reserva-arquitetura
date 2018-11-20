<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Finalizar Reserva</div>
                <div class="panel-body">
                    <form action="<?php echo e(url('/Reserva/finalizar')); ?>" method="post">
                        <div class="input-group">
                            <?php echo e(csrf_field()); ?>

                            <input type="radio" value="<?php echo e($clientes); ?>" name="cliente" checked>&nbsp;
                            <label>Cliente Selecionado </label>
                            <hr>
                            <input type="radio" value="<?php echo e($quartos); ?>" name="quarto" checked>&nbsp;
                            <label>Quarto Selecionado</label>
                            <hr>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>