<?php
$this->Html->addCrumb('Categorias', '/categorias/index');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?= $this->Html->link(__('Nova Categoria'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
</nav>
<br />
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Categorias</h3>       
    </div>
    <div class="box-body no-padding">
        <?php        
        $this->Tree->montarArvore($categorias);
        ?>
    </div>
</div>
