<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Forma Pagamento'), ['action' => 'edit', $formaPagamento->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Forma Pagamento'), ['action' => 'delete', $formaPagamento->id], ['confirm' => __('Are you sure you want to delete # {0}?', $formaPagamento->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Forma Pagamentos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forma Pagamento'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lancamentos'), ['controller' => 'Lancamentos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lancamento'), ['controller' => 'Lancamentos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="formaPagamentos view large-9 medium-8 columns content">
    <h3><?= h($formaPagamento->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($formaPagamento->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($formaPagamento->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Lancamentos') ?></h4>
        <?php if (!empty($formaPagamento->lancamentos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Categoria Id') ?></th>
                <th><?= __('Forma Pagamento Id') ?></th>
                <th><?= __('Conta Id') ?></th>
                <th><?= __('Fornecedor Id') ?></th>
                <th><?= __('Valor') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($formaPagamento->lancamentos as $lancamentos): ?>
            <tr>
                <td><?= h($lancamentos->id) ?></td>
                <td><?= h($lancamentos->categoria_id) ?></td>
                <td><?= h($lancamentos->forma_pagamento_id) ?></td>
                <td><?= h($lancamentos->conta_id) ?></td>
                <td><?= h($lancamentos->fornecedor_id) ?></td>
                <td><?= h($lancamentos->valor) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Lancamentos', 'action' => 'view', $lancamentos->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Lancamentos', 'action' => 'edit', $lancamentos->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Lancamentos', 'action' => 'delete', $lancamentos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lancamentos->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
