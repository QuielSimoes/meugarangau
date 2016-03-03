<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Categoria'), ['action' => 'edit', $categoria->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Categoria'), ['action' => 'delete', $categoria->id], ['confirm' => __('Are you sure you want to delete # {0}?', $categoria->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Categorias'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Categoria'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Categoria'), ['controller' => 'Categorias', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="categorias view large-9 medium-8 columns content">
    <h3><?= h($categoria->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($categoria->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($categoria->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Categoria Id') ?></th>
            <td><?= $this->Number->format($categoria->categoria_id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Categorias') ?></h4>
        <?php if (!empty($categoria->categorias)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Categoria Id') ?></th>
                <th><?= __('Nome') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($categoria->categorias as $categorias): ?>
            <tr>
                <td><?= h($categorias->id) ?></td>
                <td><?= h($categorias->categoria_id) ?></td>
                <td><?= h($categorias->nome) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Categorias', 'action' => 'view', $categorias->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Categorias', 'action' => 'edit', $categorias->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Categorias', 'action' => 'delete', $categorias->id], ['confirm' => __('Are you sure you want to delete # {0}?', $categorias->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
