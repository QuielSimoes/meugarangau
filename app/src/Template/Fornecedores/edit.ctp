<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $fornecedore->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $fornecedore->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Fornecedores'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="fornecedores form large-9 medium-8 columns content">
    <?= $this->Form->create($fornecedore) ?>
    <fieldset>
        <legend><?= __('Edit Fornecedore') ?></legend>
        <?php
            echo $this->Form->input('nome');
            echo $this->Form->input('cpf');
            echo $this->Form->input('cnpj');
            echo $this->Form->input('telefone');
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
