<!-- Bootstrap 3.3.5 -->
<?php echo $this->Html->css('bootstrap/bootstrap.min') ?>
<!-- Theme style -->
<?php echo $this->Html->css('AdminLTE.min') ?>
<!-- Font Awesome -->
<?php echo $this->Html->css('font-awesome.min') ?> 

<div class="box box-primary">
    <?= $this->Form->create($tarefa, ['action' => 'add']) ?>
    <div class="box-header">
        <i class="ion ion-clipboard"></i>
        <h3 class="box-title"><?= $id ? 'Alterar' : 'Nova' ?> Tarefa</h3>
        <nav class="large-3 medium-4 columns pull-right" id="actions-sidebar">
            <?= $this->Html->link(__('Listar Tarefas'), ['action' => 'index', 1], ['class' => 'btn btn-primary']) ?>
        </nav>
    </div><!-- /.box-header -->

    <div class="box-body">
        <div class="form-group">
            <?php
            echo $this->Form->hidden('id');
            echo $this->Form->input('nome', ['class' => 'form-control']);
            ?>
        </div>
    </div>

    <div class="box-footer clearfix no-border">
        <button class="btn btn-primary" type="submit"><?= $id ? 'Alterar' : 'Salvar' ?></button>
    </div>
    <?= $this->Form->end() ?>
</div>