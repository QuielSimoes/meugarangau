<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $lancamento->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $lancamento->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Lancamentos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Categoria'), ['controller' => 'Categorias', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Forma Pagamentos'), ['controller' => 'FormaPagamentos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Forma Pagamento'), ['controller' => 'FormaPagamentos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Contas'), ['controller' => 'Contas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Conta'), ['controller' => 'Contas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fornecedores'), ['controller' => 'Fornecedores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fornecedore'), ['controller' => 'Fornecedores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="lancamentos form large-9 medium-8 columns content">
    <?= $this->Form->create($lancamento) ?>
    <fieldset>
        <legend><?= __('Edit Lancamento') ?></legend>
        <?php
            echo $this->Form->input('categoria_id', ['options' => $categorias]);
            echo $this->Form->input('forma_pagamento_id', ['options' => $formaPagamentos]);
            echo $this->Form->input('conta_id', ['options' => $contas]);
            echo $this->Form->input('fornecedor_id', ['options' => $fornecedores]);
            echo $this->Form->input('valor');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
