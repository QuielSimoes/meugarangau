<?php
$this->Html->addCrumb('Calendário', ['controller' => 'pages', 'action' => 'calendario']);
?>

<div class="box box-danger">
    <div class="box-header with-border">
    </div>
    <div class="box-body">
        <div class="form-group text-danger">            
            <?php
            echo $calendario_error;
            ?>
        </div>
    </div>

    <div class="box-footer">
        <button class="btn btn-success" type="button" onclick="renovarAcesso()">Renovar acesso</button>
    </div>
    <?= $this->Form->end() ?>
</div>

<script type="text/javascript">
    function renovarAcesso() {
        $.ajax({
           url: '<?php echo $this->Url->build(['controller' => 'pages', 'action' => 'renovarAcessoGoogleApi']) ?>',
           type: 'POST',
           dataType: 'json',
           success: function(data) {
               if(data.sucesso) {
                   location.href = "<?php echo $this->Url->build(['controller' => 'pages', 'action' => 'calendario']) ?>";
               } else {
                   alert(data.msg);
               }
           }
        });
    }
</script>