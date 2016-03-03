<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $configuraco->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $configuraco->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Configuracoes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="configuracoes form large-9 medium-8 columns content">
    <?= $this->Form->create($configuraco) ?>
    <fieldset>
        <legend><?= __('Edit Configuraco') ?></legend>
        <?php
            echo $this->Form->input('google_agenda_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
