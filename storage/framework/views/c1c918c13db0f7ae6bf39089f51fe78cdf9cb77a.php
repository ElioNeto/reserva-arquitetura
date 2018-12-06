<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Confirmar dados da reserva</div>
                <div class="panel-body">
                
                    <form class="form-horizontal" role="form" action="<?php echo e(url('/apiCliente/pagseguro')); ?>" method="post"><!--editar-->
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" value="FA5AD922C90243D3B03FAC6602798DC3" name="token" checked>
                        <input type="hidden" value="netoo.elio@hotmail.com" name="email" checked>
                        <input type="hidden" value="BRL" name="currency" checked>
                        <input type="hidden" value="<?php echo e($reserva->id); ?>" name="itemid" checked>
                        <input type="hidden" value="<?php echo e($cliente->id); ?>" name="id" checked>

                        <input type="hidden" value="<?php echo e($cliente->nome); ?>" name="cliente" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Cliente Selecionado: <?php echo e($cliente->nome); ?> </label></div>

                        <input type="hidden" value="<?php echo e($quarto->descricao); ?>" name="descricao" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Quarto Selecionado: <?php echo e($quarto->descricao); ?> </label></div>
                        
                        <input type="hidden" value="<?php echo e($dias); ?>" name="qtd" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Dias reservados: <?php echo e($dias); ?></label></div>

                        <input type="hidden" value="<?php echo e($quarto->valor); ?>" name="valor" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Diária: <?php echo e($quarto->valor); ?></label></div>

                                <?php   
                                    $unit = $quarto->valor;
                                    $total = $dias * $unit; 
                                ?>

                        <input type="hidden" value="<?php echo e($total); ?>" name="total" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Total: <?php echo e($total); ?></label></div>

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