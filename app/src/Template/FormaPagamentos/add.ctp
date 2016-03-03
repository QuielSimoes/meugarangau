<?php
$acao_breadcrumb = empty($id) ? 'add' : 'edit';
$txt_breadcrumb = empty($id) ? 'Nova Forma de Pagamento' : 'Alteração de Forma de Pagamento';
$this->Html->addCrumb('Formas de Pagamento', '/forma_pagamentos/index');
$this->Html->addCrumb($txt_breadcrumb, ['controller' => 'forma_pagamentos', 'action' => $acao_breadcrumb, $id]);
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?= $this->Html->link(__('Listar Formas de Pagamento'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
</nav><br />

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $id ? 'Alterar' : 'Nova' ?> Forma de Pagamento</h3>
    </div>
    <?= $this->Form->create($formaPagamento, ['action' => 'add']) ?>
    <div class="box-body">
        <div class="form-group">
            <?php
            echo $this->Form->hidden('id');
            echo $this->Form->input('nome', ['class' => 'form-control']);
            ?>
        </div>
    </div>

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><?= $id ? 'Alterar' : 'Salvar' ?></button>
    </div>
    <?= $this->Form->end() ?>
</div>
