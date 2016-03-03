<?php
$acao_breadcrumb = empty($id) ? 'add' : 'edit';
$txt_breadcrumb = empty($id) ? 'Novo Fornecedor' : 'Alteração de Fornecedor';
$this->Html->addCrumb('Fornecedores', '/fornecedores/index');
$this->Html->addCrumb($txt_breadcrumb, ['controller' => 'fornecedores', 'action' => $acao_breadcrumb, $id]);
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?= $this->Html->link(__('Listar Fornecedores'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
</nav><br />

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $id ? 'Alterar' : 'Novo' ?> Fornecedor</h3>
    </div>
    <?= $this->Form->create($fornecedor, ['action' => 'add']) ?>
    <div class="box-body">
        <div class="form-group">
            <?php
            echo $this->Form->hidden('id');
            echo $this->Form->input('nome', ['class' => 'form-control']);
            ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input('cpf', ['class' => 'form-control', 'label' => 'CPF', 'data-mask' => '', 'data-inputmask' => '"mask": "999.999.999-99"']) ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input('cnpj', ['class' => 'form-control', 'label' => 'CNPJ', 'data-mask' => '', 'data-inputmask' => '"mask": "99.999.999/9999-99"']) ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input('telefone', ['class' => 'form-control', 'data-mask' => '', 'data-inputmask' => '"mask": "(99) 99999-9999"']) ?>
        </div>
        <div class="form-group">
            <?php echo $this->Form->input('email', ['class' => 'form-control', 'label' => 'E-mail', 'type' => 'email']) ?>
        </div>
    </div>

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><?= $id ? 'Alterar' : 'Salvar' ?></button>
    </div>
    <?= $this->Form->end() ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
       $("[data-mask]").inputmask(); 
    });
</script>