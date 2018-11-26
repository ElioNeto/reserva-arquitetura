<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Finalizar Reserva</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="<?php echo e(url('/Reserva/salvar')); ?>" method="post"><!--editar-->
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" value="<?php echo e($clientes); ?>" name="cliente" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Cliente Selecionado </label></div>
                        <input type="hidden" value="<?php echo e($quartos); ?>" name="quarto" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Quarto Selecionado</label></div>
                        <hr>

                        <div class="form-group">
                            <label for="in" class="col-md-4 control-label">Data de Entrada</label>
                            <div class="col-md-6">
                                <input id="in" type="text" class="form-control" name="checkin" placeholder="24-04-2018">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="out" class="col-md-4 control-label">Data de Saída</label>
                            <div class="col-md-6">
                                <input id="out" type="text" class="form-control" name="checkout" placeholder="26-04-2018">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Finalizar
                                </button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>