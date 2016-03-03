<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Configuraco'), ['action' => 'edit', $configuraco->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Configuraco'), ['action' => 'delete', $configuraco->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configuraco->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Configuracoes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configuraco'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="configuracoes view large-9 medium-8 columns content">
    <h3><?= h($configuraco->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Google Agenda Id') ?></th>
            <td><?= h($configuraco->google_agenda_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($configuraco->id) ?></td>
        </tr>
    </table>
</div>
