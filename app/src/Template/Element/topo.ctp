<!-- Logo -->
<?php
echo $this->Html->link("<span class='logo-mini'><b>$$</b></span><span class='logo-lg'><b>Meu</b>Garangau</span>", "/", ['escape' => false, 'class' => 'logo']);
?>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- Notifications: style can be found in dropdown.less -->
            <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <span class="label label-warning"><?= count($lancamentos) ?></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">Você tem <?= count($lancamentos) ?> notificações</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <?php foreach($lancamentos as $lancamento) :?>
                            <li>
                                <a href="#">
                                    <i class="<?= ($lancamento->valor >= 0) ? 'fa fa-smile-o text-green' :  'fa fa-meh-o text-red' ?>"></i> <?= $lancamento->descricao . ' - R$ ' . $this->Number->precision($lancamento->valor, 2) ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="footer"><a href="#">View all</a></li>
                </ul>
            </li>
            <!-- Tasks: style can be found in dropdown.less -->
            <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-flag-o"></i>
                    <span class="label label-danger"><?= count($progresso_metas) ?></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">Você tem <?php echo count($progresso_metas) ?> meta(s)</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <?php
                            foreach ($progresso_metas as $meta) : 
                                $percentual = round(($meta->percentual < 0) ? ($meta->percentual * -1) : $meta->percentual);
                                $class = $meta->tp_controle == 'D' ? 'progress-bar-red' : 'progress-bar-green';
                            ?>
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            <?= $meta->nome ?>
                                            <small class="pull-right"><?= $percentual ?>%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar <?= $class ?>" style="width: <?= $percentual ?>%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only"><?= $percentual ?>% Completo</span>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- end task item -->

                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="footer">
                        <?php echo $this->Html->link('Listar metas', ['controller' => 'metas', 'action' => 'index']) ?>
                        <?php echo $this->Html->link('Nova meta', ['controller' => 'metas', 'action' => 'add']) ?>
                    </li>
                </ul>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?= $this->Html->image($fotoUsuario, ['class' => 'user-image', 'alt' => 'User Image']); ?>
                    <span class="hidden-xs"><?= $login ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                      <?= $this->Html->image($fotoUsuario, ['class' => 'img-circle', 'alt' => 'User Image']); ?>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <?= $this->Html->link('Perfil', ['controller' => 'Users', 'action' => 'perfil'], ['class' => 'btn btn-default btn-flat']) ?>
                        </div>
                        <div class="pull-right">
                            <?php echo $this->Html->link('Sair', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'btn btn-default btn-flat']) ?>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
        </ul>
    </div>
</nav>