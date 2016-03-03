<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
                <?= $this->Html->image($fotoUsuario, ['class' => 'img-circle', 'alt' => 'User Image']); ?>
        </div>
        <div class="pull-left info">
            <p><?= $login ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Lançamentos, Agendamentos, Tarefas...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">MENU DE NAVEGAÇÃO</li>

        <li class="active treeview">
            <a href="#">
                <i class="fa fa-money"></i> <span>Lançamentos</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="/lancamentos/index"><i class="fa fa-search"></i> Localizar</a></li>
                <li><a href="/lancamentos/add/d"><i class="fa fa-meh-o text-red"></i> Registrar despesa</a></li>
                <li><a href="/lancamentos/add/r"><i class="fa fa-smile-o text-green"></i> Registrar receita</a></li>
            </ul>
        </li>
        
        <li class="treeview">
            <a href="#">
                <i class="fa fa-table"></i> <span>Dados Básicos</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <?= $this->Html->link("<i class='fa fa-wrench'></i> Categorias", 'categorias', array('escape' => false)) ?>
                    <?= $this->Html->link("<i class='fa fa-money'></i> Formas de Pagamento", 'forma_pagamentos', array('escape' => false)) ?>
                    <?= $this->Html->link("<i class='glyphicon glyphicon-usd'></i> Contas", 'contas', array('escape' => false)) ?>
                    <?= $this->Html->link("<i class='fa fa-group'></i> Fornecedores", 'fornecedores', array('escape' => false)) ?>
            </ul>
        </li>
        
        <li class="treeview">
            <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Relatórios</span>
                <span class="label label-primary pull-right">2</span>
            </a>
            <ul class="treeview-menu">
                <li><a href="pages/layout/top-nav.html"><i class="fa fa-th"></i> Tabulares</a></li>
                <li><a href="pages/layout/boxed.html"><i class="fa fa-pie-chart"></i> Gráfico</a></li>
            </ul>
        </li>                
        
        <li>
            <?= $this->Html->link("<i class='fa fa-calendar'></i> Calendário <small class='label pull-right bg-red'>3</small>", ['controller' => 'pages', 'action' => 'calendario'], array('escape' => false)) ?>            
        </li>
<!--         <li>
            <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
            </a>
        </li>
       <li class="treeview">
            <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li>
                    <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                        <li>
                            <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            </ul>
        </li>-->
        <li><a href="documentation/index.html"><i class="fa fa-caret-square-o-down"></i> <span>Importar/Exportar</span></a></li>
        <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentatação</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
    </ul>
</section>