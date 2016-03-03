<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fornecedore'), ['action' => 'edit', $fornecedore->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fornecedore'), ['action' => 'delete', $fornecedore->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fornecedore->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fornecedores'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fornecedore'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="fornecedores view large-9 medium-8 columns content">
    <h3><?= h($fornecedore->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($fornecedore->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('Cpf') ?></th>
            <td><?= h($fornecedore->cpf) ?></td>
        </tr>
        <tr>
            <th><?= __('Cnpj') ?></th>
            <td><?= h($fornecedore->cnpj) ?></td>
        </tr>
        <tr>
            <th><?= __('Telefone') ?></th>
            <td><?= h($fornecedore->telefone) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($fornecedore->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($fornecedore->id) ?></td>
        </tr>
    </table>
</div>
