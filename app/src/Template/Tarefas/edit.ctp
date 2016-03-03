<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?=
            $this->Form->postLink(
                    __('Delete'), ['action' => 'delete', $tarefa->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tarefa->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('List Tarefas'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tarefas form large-9 medium-8 columns content">
    <?= $this->Form->create($tarefa) ?>
    <fieldset>
        <legend><?= __('Edit Tarefa') ?></legend>
        <?php
        echo $this->Form->input('nome');
        echo $this->Form->input('lido');
        echo $this->Form->input('dt_cadastro');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>