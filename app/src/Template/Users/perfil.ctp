<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $id ? 'Alterar' : 'Nova' ?> Perfil</h3>
    </div>
    <?= $this->Form->create($user, ['type' => 'file', 'action' => 'add']); ?>
    <div class="box-body">
        <div class="form-group">
            <?php
            echo $this->Form->hidden('id');
            echo $this->Form->input('username', ['class' => 'form-control', 'label' => 'Login']);
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->input('foto_id', ['type' => 'file']);
            ?>
        </div>
    </div>

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><?= $id ? 'Alterar' : 'Salvar' ?></button>
    </div>
    <?= $this->Form->end() ?>
</div>
