<?php $this->Html->addCrumb('Contas', '/contas/index'); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?= $this->Html->link(__('Nova Conta'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
</nav>
<br />
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Contas</h3>       
    </div>
    <div class="box-body no-padding">
        <table cellpadding="0" cellspacing="0" class="table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('nome') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contas as $conta): ?>
                    <tr>
                        <td><?= h($conta->nome) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__("<i class='fa fa-edit '></i>Editar"), ['action' => 'edit', $conta->id], array('escape' => false)) ?>
                            <?= $this->Form->postLink(__("<i class='fa fa-remove '></i>Deletar"), ['action' => 'delete', $conta->id], ['confirm' => __('Confirma a exclusão do registro # {0}?', $conta->id), 'escape' => false]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>