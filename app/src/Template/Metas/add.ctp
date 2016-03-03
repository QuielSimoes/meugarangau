<?php
$acao_breadcrumb = empty($id) ? 'add' : 'edit';
$txt_breadcrumb = empty($id) ? 'Nova Meta' : 'Alterar Meta';
$this->Html->addCrumb('Metas', '/metas/index');
$this->Html->addCrumb($txt_breadcrumb, ['controller' => 'metas', 'action' => $acao_breadcrumb, $id]);
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?= $this->Html->link(__('Listar Metas'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
</nav><br />

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $id ? 'Alterar' : 'Nova' ?> Meta</h3>
    </div>
    <?= $this->Form->create($meta, ['action' => 'add']) ?>
    <div class="box-body">
        <div class="form-group">
            <?php
            echo $this->Form->hidden('id');
            echo $this->Form->input('nome', ['class' => 'form-control', 'label' => 'Nome da Meta']);
            ?>
        </div>
        <div class="form-group">
            <label>Qual o objetivo da sua meta?</label>
            <div class="radio">
                <?php
                echo $this->Form->radio('tp_controle', ['D' => '<span class="label-danger">Controlar Despesa</span>&nbsp;&nbsp;&nbsp;', 'R' => '<span class="label-success">Controlar Receita</span>'], ['escape' => false]);
                ?>
            </div>            
        </div>
        <div class="form-group">
            <label>Informe a pretenção de alcançe do seu objetivo</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <?php echo $this->Form->text('periodo', ['class' => 'form-control pull-right', 'id' => 'periodo', 'required' => 'required']); ?>
            </div>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->input('categoria_id', ['class' => 'form-control', 'empty' => 'Selecione', 'required' => 'required']);
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->input('vl_meta', ['class' => 'form-control', 'label' => 'Valor da meta', 'type' => 'text', 'required' => 'required']);
            ?>
        </div>
    </div>

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><?= $id ? 'Alterar' : 'Salvar' ?></button>
    </div>
    <?= $this->Form->end() ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        var dp = $("#periodo");
        dp.daterangepicker({
            format: "DD/MM/YYYY",
            language: "pt-BR",
            autoclose: true,
            "locale": {
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                "fromLabel": "De",
                "toLabel": "Até",
                "daysOfWeek": [
                    "D",
                    "S",
                    "T",
                    "Q",
                    "Q",
                    "S",
                    "S"
                ],
                "monthNames": [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro"
                ]
            }        
        });

        $("#vl-meta").maskMoney({
            prefix: "R$: ",
            affixesStay: false,
            thousands: '.',
            decimal: ','
        });
    });
</script>