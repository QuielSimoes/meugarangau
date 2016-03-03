<?php $this->Html->addCrumb('Fornecedores', '/fornecedores/index'); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?= $this->Html->link(__('Novo Fornecedor'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
</nav>
<br />
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?= __('Fornecedores') ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('nome') ?></th>
                    <th><?= $this->Paginator->sort('cpf', 'CPF') ?></th>
                    <th><?= $this->Paginator->sort('cnpj', 'CNPJ') ?></th>
                    <th><?= $this->Paginator->sort('telefone') ?></th>
                    <th><?= $this->Paginator->sort('email', 'E-mail') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>    
            <tbody>
                <?php foreach ($fornecedores as $fornecedor): ?>
                    <tr>
                        <td><?= $this->Number->format($fornecedor->id) ?></td>
                        <td><?= h($fornecedor->nome) ?></td>
                        <td><?= h($fornecedor->cpf) ?></td>
                        <td><?= h($fornecedor->cnpj) ?></td>
                        <td><?= h($fornecedor->telefone) ?></td>
                        <td><?= h($fornecedor->email) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__("<i class='fa fa-edit '></i>Editar"), ['action' => 'edit', $fornecedor->id], array('escape' => false)) ?>
                            <?= $this->Form->postLink(__("<i class='fa fa-remove '></i>Deletar"), ['action' => 'delete', $fornecedor->id], ['confirm' => __('Confirma a exclusão do registro # {0}?', $fornecedor->id), 'escape' => false]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
        <div class="paginator">
            <ul class="pagination pagination-sm no-margin pull-right">
                <?= $this->Paginator->prev('«') ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('»')) ?>
            </ul>
        </div>
    </div>
</div>