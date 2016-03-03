<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tarefa'), ['action' => 'edit', $tarefa->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tarefa'), ['action' => 'delete', $tarefa->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tarefa->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tarefas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tarefa'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tarefas view large-9 medium-8 columns content">
    <h3><?= h($tarefa->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($tarefa->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('Lido') ?></th>
            <td><?= h($tarefa->lido) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($tarefa->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Dt Cadastro') ?></th>
            <td><?= h($tarefa->dt_cadastro) ?></tr>
        </tr>
    </table>
</div>
