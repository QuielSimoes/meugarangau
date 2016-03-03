<?php
$acao_breadcrumb = empty($id) ? 'add' : 'edit';
$txt_breadcrumb = empty($id) ? 'Nova Categoria' : 'Alteração de Categoria';
$this->Html->addCrumb('Categorias', '/categorias/index');
$this->Html->addCrumb($txt_breadcrumb, ['controller' => 'categorias', 'action' => $acao_breadcrumb, $id]);
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?= $this->Html->link(__('Listar Categorias'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
</nav><br />
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $id ? 'Alterar' : 'Nova' ?> Categoria</h3>
    </div>
    <?= $this->Form->create($categoria, ['action' => 'add']) ?>
    <div class="box-body">
        <div class="form-group">
            <?php
            echo $this->Form->hidden('id');
            echo $this->Form->input('nome', ['class' => 'form-control']);
            ?>
        </div>
        <div class="form-group">
            <?= $this->Form->input('categoria_id', ['class' => 'form-control', 'empty' => 'Selecione', 'label' => 'Categoria Pai']) ?>
        </div>
    </div>

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><?= $id ? 'Alterar' : 'Salvar' ?></button>
    </div>
    <?= $this->Form->end() ?>
</div>