<!-- Bootstrap 3.3.5 -->
<?php echo $this->Html->css('bootstrap/bootstrap.min') ?>
<!-- Theme style -->
<?php echo $this->Html->css('AdminLTE.min') ?>
<!-- Font Awesome -->
<?php echo $this->Html->css('font-awesome.min') ?>

<div class="box box-primary" style="height: 207px;">

    <div class="box-header">
        <i class="ion ion-clipboard"></i>
        <h3 class="box-title">Tarefas</h3>
        <?php echo $this->Html->link('<i class="fa fa-plus"></i> Nova Tarefa', ['controller' => 'tarefas', 'action' => 'add', 1], ['escape' => false, 'class' => 'btn btn-default']) ?>
        <div class="box-tools pull-right paginator">
            <ul class="pagination pagination-sm inline">
                <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('Próximo') . ' >') ?>
            </ul>
        </div>
    </div><!-- /.box-header -->
    
    <div class="box-body no-padding">
        <ul class="todo-list">
            <?php
            $agora = new \DateTime('now');
            foreach ($tarefas as $tarefa):
                $diff = $agora->diff($tarefa->dt_cadastro);
                
                $time = "";
                if($diff->y > 0) {
                    $time = $diff->y . " ano(s)";
                } elseif($diff->m > 0) {
                    $time = $diff->m . " mes(ses)";
                } elseif($diff->d >= 7) {
                    $time = intval($diff->d / 7) . " semana(s)";
                } elseif($diff->d < 7 && $diff->d > 0) {
                    $time = $diff->d . " dia(s)";
                } elseif($diff->h > 0) {
                    $time = $diff->h . " hora(s)";
                } elseif($diff->i > 0) {
                    $time = $diff->i . " minuto(s)";
                } elseif($diff->s > 0) {
                    $time = $diff->s . " segundo(s)";
                }
            ?>
                <li>
                    <!-- drag handle -->
                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <input type="checkbox" value="" name="">
                    <!-- todo text -->
                    <span class="text"><?php echo $tarefa->nome ?></span>
                    <!-- Emphasis label -->
                    <small class="label label-danger"><i class="fa fa-clock-o"></i> <?php echo $time ?></small>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                        <?= $this->Html->link(__('<i class="fa fa-edit"></i>&nbsp;Edit'), ['action' => 'edit', $tarefa->id, 1], ['escape' => false]) ?>
                        &nbsp;
                        <?= $this->Form->postLink(__('<i class="fa fa-trash-o"></i>&nbsp;Delete'), ['action' => 'delete', $tarefa->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $tarefa->id)]) ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div><!-- /.box-body -->
</div>