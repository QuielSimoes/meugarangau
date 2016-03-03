<?php
$this->Html->addCrumb('Lançamentos', '/lancamentos/index');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?= $this->Html->link(__("<i class='fa fa-arrow-circle-up'></i>&nbsp;Nova despesa"), ['action' => 'add/d'], ['class' => 'btn btn-danger', 'escape' => false]) ?>
    <?= $this->Html->link(__("<i class='fa fa-arrow-circle-down'></i>&nbsp;Nova receita"), ['action' => 'add/r'], ['class' => 'btn btn-success', 'escape' => false]) ?>
</nav>
<br />

<?= $this->Form->create($lancamentos) ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Localizar Lançamento(s)</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <?= $this->Form->input('categoria_id', ['class' => 'form-control', 'multiple' => 'multiple']) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->input('forma_pagamento_id', ['class' => 'form-control', 'multiple' => 'multiple', 'label' => 'Forma de Pagamento']) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->input('conta_id', ['class' => 'form-control', 'multiple' => 'multiple']) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->input('fornecedor_id', ['class' => 'form-control', 'multiple' => 'multiple', 'label' => 'Fornecedores', 'options' => $fornecedores]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">

                        <label>Data</label>
                        <div class="input-group">
                            <button id="daterange-btn" class="btn btn-default pull-right" type="button">
                                <i class="fa fa-calendar"></i> Selecione o período
                                <i class="fa fa-caret-down"></i>
                            </button>
                            <?= $this->Form->input('data1', ['type' => 'hidden']) ?>
                            <?= $this->Form->input('data2', ['type' => 'hidden']) ?>
                        </div>
                    </div>                    
                </div>
            </div>

            <div class="box-footer">
                <button class="btn btn-primary" type="submit"><i class='fa fa-search'></i>&nbsp;Pesquisar</button>
            </div>
        </div>

    </div>
</div>
<?= $this->Form->end() ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('data') ?></th>
                            <th><?= $this->Paginator->sort('categoria_id', 'Categoria') ?></th>
                            <th><?= $this->Paginator->sort('descricao', 'Descrição') ?></th>
                            <th><?= $this->Paginator->sort('valor') ?></th>
                            <th>Saldo anterior</th>
                            <th>Saldo posterior</th>
                            <th class="actions" colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $saldo = 0;
                        $saldo_anterior = 0;
                        foreach ($lancamentos as $lancamento):
                            $saldo += $lancamento->valor;
                            $saldo_anterior += $lancamento->saldo_anterior;
                            ?>
                            <tr>
                                <td><?= $lancamento->data ?></td>
                                <td><?= $lancamento->categoria->nome ?></td>
                                <td><?= $lancamento->descricao ?></td>
                                <td align="right"><span class="<?= $lancamento->valor < 0 ? 'debito' : 'credito' ?>"><?= $this->Number->precision($lancamento->valor, 2) ?></span></td>
                                <td align="right"><span class="<?= $lancamento->saldo_anterior < 0 ? 'debito' : 'credito' ?>"><?= $this->Number->precision($lancamento->saldo_anterior, 2) ?></span></td>
                                <td align="right"><span class="<?= ($lancamento->saldo_anterior + $lancamento->valor) < 0 ? 'debito' : 'credito' ?>"><?= $this->Number->precision($lancamento->saldo_anterior + $lancamento->valor, 2) ?></span></td>
                                <td class="actions" align="center">
                                    <?php
                                    $param = $lancamento->valor < 0 ? 'd' : 'r';
                                    echo $this->Html->link(__("<i class='fa fa-edit '></i>Editar"), ['action' => 'edit', $param, $lancamento->id], array('escape' => false))
                                    ?>
                                </td>
                                <td class="actions" align="center">
                                    <?= $this->Form->postLink(__("<i class='fa fa-remove '></i>Deletar"), ['action' => 'delete', $lancamento->id], ['confirm' => __('Confirma a exclusão do registro # {0}?', $lancamento->id), 'escape' => false]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">&nbsp;</td>
                            <td align="right"><span class="<?= $saldo_anterior < 0 ? 'debito' : 'credito' ?>"><?= $this->Number->precision($saldo_anterior, 2) ?></span></td>
                            <td align="right"><span class="<?= $saldo < 0 ? 'debito' : 'credito' ?>"><?= $this->Number->precision($saldo, 2) ?></span></td>
                            <td>&nbsp;</td>
                        </tr>
                    </tfoot>
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
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#daterange-btn').daterangepicker(
                {
                    ranges: {
                        'Hoje': [moment(), moment()],
                        'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
                        'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
                        'Este Mês': [moment().startOf('month'), moment().endOf('month')],
                        'Mês passado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment(),
                    opens: 'right',
                    drops: 'up',
                    format: 'DD/MM/YYYY',
                    locale: {
                        applyLabel: 'Confirmar',
                        cancelLabel: 'Cancelar'
                    }
                },
        function (start, end) {
            $('#data1').val(start.format('YYYY-MM-DD'));
            $('#data2').val(end.format('YYYY-MM-DD'));
        }
        );
    });
</script>