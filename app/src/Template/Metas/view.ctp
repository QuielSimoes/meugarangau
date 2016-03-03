<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Meta'), ['action' => 'edit', $meta->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Meta'), ['action' => 'delete', $meta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $meta->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Metas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Meta'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Categoria'), ['controller' => 'Categorias', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="metas view large-9 medium-8 columns content">
    <h3><?= h($meta->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Categoria') ?></th>
            <td><?= $meta->has('categoria') ? $this->Html->link($meta->categoria->nome, ['controller' => 'Categorias', 'action' => 'view', $meta->categoria->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($meta->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('Tp Controle') ?></th>
            <td><?= h($meta->tp_controle) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($meta->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Vl Meta') ?></th>
            <td><?= $this->Number->format($meta->vl_meta) ?></td>
        </tr>
        <tr>
            <th><?= __('Dt Inicial') ?></th>
            <td><?= h($meta->dt_inicial) ?></tr>
        </tr>
        <tr>
            <th><?= __('Dt Final') ?></th>
            <td><?= h($meta->dt_final) ?></tr>
        </tr>
        <tr>
            <th><?= __('Dt Cadastro') ?></th>
            <td><?= h($meta->dt_cadastro) ?></tr>
        </tr>
    </table>
</div>
