<?php $this->Html->addCrumb('Metas', '/metas/index'); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?= $this->Html->link(__('Nova Meta'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
</nav>
<br />
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Metas</h3>       
    </div>
    <div class="box-body no-padding">
        <table cellpadding="0" cellspacing="0" class="table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('nome', 'Meta') ?></th>
                    <th><?= $this->Paginator->sort('categoria_id') ?></th>
                    <th><?= $this->Paginator->sort('vl_meta', 'Valor') ?></th>
                    <th><?= $this->Paginator->sort('tp_controle', 'Objetivo') ?></th>
                    <th><?= $this->Paginator->sort('dt_inicial', 'Data início') ?></th>
                    <th><?= $this->Paginator->sort('dt_final', 'Data alvo') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($metas as $meta): ?>
                    <tr>
                        <td><?= h($meta->nome) ?></td>
                        <td><?= $meta->categoria->nome ?></td>
                        <td><?= h($this->Number->precision($meta->vl_meta, 2)) ?></td>
                        <td><?= h($meta->tp_controle == 'D' ? 'Controlar despesa' : 'Controlar receita') ?></td>
                        <td><?= h($meta->dt_inicial) ?></td>
                        <td><?= h($meta->dt_final) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__("<i class='fa fa-edit '></i>Editar"), ['action' => 'edit', $meta->id], array('escape' => false)) ?>
                            <?= $this->Form->postLink(__("<i class='fa fa-remove '></i>Deletar"), ['action' => 'delete', $meta->id], ['confirm' => __('Confirma a exclusão do registro # {0}?', $meta->id), 'escape' => false]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>