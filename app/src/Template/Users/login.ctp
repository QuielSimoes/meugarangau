<div class="login-box">
    <div class="login-logo">
        <?php echo $this->Html->link("<b>Admin</b>LTE", "/", ['escape' => false]) ?>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <?= $this->Flash->render() ?>
        <p class="login-box-msg">Entre para iniciar sua sessão</p>
        <div class="users form">
            <?= $this->Form->create('Usuario', ["controller" => "Users", "action" => "login"]) ?>
            <div class="form-group has-feedback">
                <?= $this->Form->input('username', ['class' => 'form-control', 'placeholder' => 'Usuário']) ?>
            </div>
            <div class="form-group has-feedback">
                <?= $this->Form->input('password', ['class' => 'form-control', 'placeholder' => 'Senha']) ?>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Recordar dados
                        </label>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <?= $this->Form->button(__('Login'), ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat']); ?>
                </div><!-- /.col -->
            </div>
            <?= $this->Form->end() ?>

        </div>
        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div><!-- /.social-auth-links -->

        <a href="#">Esqueçi minha senha</a><br>

    </div>
</div>