<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $meta->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $meta->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Metas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Categoria'), ['controller' => 'Categorias', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="metas form large-9 medium-8 columns content">
    <?= $this->Form->create($meta) ?>
    <fieldset>
        <legend><?= __('Edit Meta') ?></legend>
        <?php
            echo $this->Form->input('categoria_id', ['options' => $categorias]);
            echo $this->Form->input('nome');
            echo $this->Form->input('tp_controle');
            echo $this->Form->input('dt_inicial');
            echo $this->Form->input('dt_final');
            echo $this->Form->input('vl_meta');
            echo $this->Form->input('dt_cadastro');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
