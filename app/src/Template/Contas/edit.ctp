<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $conta->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $conta->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Contas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Lancamentos'), ['controller' => 'Lancamentos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lancamento'), ['controller' => 'Lancamentos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contas form large-9 medium-8 columns content">
    <?= $this->Form->create($conta) ?>
    <fieldset>
        <legend><?= __('Edit Conta') ?></legend>
        <?php
            echo $this->Form->input('nome');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
