<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Quartos 
                <?php if(session()->has('message')): ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;====><b>Mensagem do Sistema: </b><?php echo e(session('message')); ?><====
                    <?php endif; ?>
                    <a class="pull-right" href="<?php echo e(url('Quarto')); ?>">Voltar</a>
                </div>

                <div class="panel-body">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($quartos as $key => $value): ?>
                        <tr>
                        <th scope="row"><?php echo e($value->id); ?></th>
                        <td><?php echo e($value->descricao); ?></td>
                        <td><?php echo e($value->valor); ?></td>
                        <td><?php echo e($value->status); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </table>
                    <?php echo e($quartos->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>