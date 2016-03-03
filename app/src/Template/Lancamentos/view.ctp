<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Lancamento'), ['action' => 'edit', $lancamento->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Lancamento'), ['action' => 'delete', $lancamento->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lancamento->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Lancamentos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lancamento'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Categoria'), ['controller' => 'Categorias', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Forma Pagamentos'), ['controller' => 'FormaPagamentos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forma Pagamento'), ['controller' => 'FormaPagamentos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Contas'), ['controller' => 'Contas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Conta'), ['controller' => 'Contas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fornecedores'), ['controller' => 'Fornecedores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fornecedore'), ['controller' => 'Fornecedores', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="lancamentos view large-9 medium-8 columns content">
    <h3><?= h($lancamento->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Categoria') ?></th>
            <td><?= $lancamento->has('categoria') ? $this->Html->link($lancamento->categoria->id, ['controller' => 'Categorias', 'action' => 'view', $lancamento->categoria->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Forma Pagamento') ?></th>
            <td><?= $lancamento->has('forma_pagamento') ? $this->Html->link($lancamento->forma_pagamento->id, ['controller' => 'FormaPagamentos', 'action' => 'view', $lancamento->forma_pagamento->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Conta') ?></th>
            <td><?= $lancamento->has('conta') ? $this->Html->link($lancamento->conta->id, ['controller' => 'Contas', 'action' => 'view', $lancamento->conta->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Fornecedore') ?></th>
            <td><?= $lancamento->has('fornecedore') ? $this->Html->link($lancamento->fornecedore->id, ['controller' => 'Fornecedores', 'action' => 'view', $lancamento->fornecedore->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($lancamento->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Valor') ?></th>
            <td><?= $this->Number->format($lancamento->valor) ?></td>
        </tr>
    </table>
</div>
