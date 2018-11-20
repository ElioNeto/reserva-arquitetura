<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastro de quartos <a class="pull-right" href="<?php echo e(url('Quarto')); ?>">Voltar</a></div>
                

                <div class="panel-body">
                    <?php echo e(Form::open(['url' => '/Quarto/salvar'])); ?>


                        <?php echo e(Form::label('descricao', 'Descrição')); ?>

                        <?php echo e(Form::input('text', 'descricao', '', ['class' => 'form-control', 'autofocus', 'placeholder' => 'Descrição do Quarto'])); ?>

                        
                        <?php echo e(Form::label('valor', 'Valor da Diária')); ?>

                        <?php echo e(Form::input('number', 'valor', '', ['class' => 'form-control', 'autofocus', 'placeholder' => 'R$ 0,00', 'step' => '0.01'])); ?>


                        <?php echo e(Form::submit('Salvar', ['class' => 'btn btn-primary'])); ?>


                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>