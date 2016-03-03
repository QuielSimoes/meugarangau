<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?= $this->Html->link(__("<i class='fa fa-search'></i>&nbsp;Procurar Lançamento"), ['action' => 'index'], ['class' => 'btn btn-primary', 'escape' => false]) ?>
    
    <?php
    $acao_breadcrumb = empty($id) ? 'add' : 'edit';
    if($tpLancamento === 'd') {
        $txt_breadcrumb = empty($id) ? 'Nova Despesa' : 'Alterar Despesa';
        echo $this->Html->link(__("<i class='fa fa-arrow-circle-down'></i>&nbsp;Nova receita"), ['action' => 'add/r'], ['class' => 'btn btn-success', 'escape' => false]);
    } else {
        $txt_breadcrumb = empty($id) ? 'Nova Receita' : 'Alterar Receita';
        echo $this->Html->link(__("<i class='fa fa-arrow-circle-up'></i>&nbsp;Nova despesa"), ['action' => 'add/d'], ['class' => 'btn btn-danger', 'escape' => false]);
    }
    ?>
</nav><br />
<?php
$this->Html->addCrumb('Lançamentos', '/lancamentos/index');
$this->Html->addCrumb($txt_breadcrumb, ['controller' => 'lancamentos', 'action' => $acao_breadcrumb, $tpLancamento, $id]);
?>

<div class="box <?= ($tpLancamento === 'd') ? 'box-danger' : 'box-success' ?>">
    <?= $this->Form->create($lancamento, ['action' => "add/$tpLancamento"]) ?>
    <div class="box-header with-border">
        <h3 class="box-title">
            <?php
            if ($tpLancamento === 'd') {
                echo ($id ? 'Alterar ' : 'Nova ') . 'Despesa';
            } elseif ($tpLancamento === 'r') {
                echo ($id ? 'Alterar ' : 'Nova ') . 'Receita';
            }
            ?>
        </h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <?php
                echo $this->Form->hidden('id');
                echo $this->Form->input('data', ['class' => 'form-control', 'type' => 'text', 'autocomplete' => false, 'default' => date('d/m/Y')]);
                ?>
                <label for="consolidado">
                <?php
                echo $this->Form->checkbox('consolidado', ['id' => 'consolidado','value' => 'S', 'hiddenField' => 'N', 'default' => 'S']);
                ?>
                    Lançamento consolidado ?
                </label>
            </div>
            <div class="col-md-6">
                <?php
                echo $this->Form->input('descricao', ['class' => 'form-control', 'label' => 'Descrição', 'rows' => 3]);
                ?>
            </div>
            <div class="col-md-3">
                <?php
                echo $this->Form->input('valor', ['class' => 'form-control', 'type' => 'text']);
                
                if(empty($id)) { ?>
                    <label for="repetir">
                        <?php
                        echo $this->Form->checkbox('repetir', ['id' => 'repetir','value' => 'S', 'hiddenField' => 'N', 'default' => 'N']);
                        ?>
                        Repetir
                    </label>
                    <div class="bloco-repeticao" style="display: none;">
                    <?php
                        echo $this->Form->input('parcelas', ['class' => 'form-control', 'label' => 'Nº de parcelas', 'style' => 'width: 70px', 'type' => 'number']);
                    ?>
                    <?php echo $this->Form->input('frequencia', ['class' => 'form-control', 'options' => [1 => 'Semanal', 2 => 'Quinzenal', 3 => 'Mensal', 4 => 'Semetral',  5 => 'Anual'], 'empty' => 'Selecione', 'label' => 'Frequência']); ?>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <?php
                echo $this->Form->input('categoria_id', ['class' => 'form-control', 'options' => $categorias, 'empty' => 'Selecione']);
                ?>
            </div>
            <div class="col-md-3">
                <?php
                echo $this->Form->input('forma_pagamento_id', ['class' => 'form-control', 'options' => $formaPagamentos, 'empty' => 'Selecione', 'label' => 'Forma de Pagamento']);
                ?>
            </div>
            <div class="col-md-3">
                <?php
                echo $this->Form->input('conta_id', ['class' => 'form-control', 'options' => $contas, 'empty' => 'Selecione']);
                ?>
            </div>
            <div class="col-md-3">
                <?php
                echo $this->Form->input('fornecedor_id', ['class' => 'form-control', 'options' => $fornecedores, 'empty' => 'Selecione']);
                ?>
            </div>
        </div>
    </div>

    <div class="box-footer">
        <?php
        if ($tpLancamento === 'd') {
            $iconClass = "fa fa-arrow-circle-up";
            if ($id) {
                ?>
                <button class="btn btn-danger" type="submit"><i class="<?= $iconClass ?>"></i>&nbsp;Alterar Despesa</button>
            <?php } else { ?>
                <button class="btn btn-danger" type="submit"><i class="<?= $iconClass ?>"></i>&nbsp;Cadastrar Despesa</button>
                <?php
            }
        } elseif ($tpLancamento === 'r') {
            $iconClass = "fa fa-arrow-circle-down";
            if ($id) {
                ?>
                <button class="btn btn-success" type="submit"><i class="<?= $iconClass ?>"></i>&nbsp;Alterar Receita</button>
            <?php } else { ?>
                <button class="btn btn-success" type="submit"><i class="<?= $iconClass ?>"></i>&nbsp;Cadastrar Receita</button>
                <?php
            }
        }
        ?>
    </div>
    <?= $this->Form->end() ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $('#descricao').focus();
        
        var dp = $("#data");

        dp.datepicker({
            format: "dd/mm/yyyy",
            language: "pt-BR",
            autoclose: true
        });

        dp.on('changeDate', function (ev) {
            dp.val(ev.target.value);
            
        var splitDate = ev.target.value.split('/');
            var dtSelecionada = splitDate[2] + splitDate[1] + splitDate[0];
            var utc = new Date().toJSON().slice(0,10).split('-');
            var dataAtual = utc[0] + utc[1] + utc[2];
            
            if(dtSelecionada > dataAtual) {
                $( "#consolidado" ).prop( "checked", false );
            } else {
                $( "#consolidado" ).prop( "checked", true );
            }
        });

        $("#valor").maskMoney({
            prefix: "R$: ",
            affixesStay: false,
            thousands: '.',
            decimal: ','
        });
        
        $('#repetir').change(function() {
            var check = $(this).prop('checked');
            $('.bloco-repeticao').toggle('blind', [], 500);
        });
    });
</script>