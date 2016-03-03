<!DOCTYPE html>
<html>
    <head>
    <?= $this->Html->charset() ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $this->fetch('title') ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?= $this->element('estilos') ?>
        <?= $this->element('scripts') ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        
        <div id="interacao"></div>

        <div class="wrapper">
            
            <header class="main-header">
                <?= $this->element('topo') ?>
            </header>

            <aside class="main-sidebar">
                <?= $this->element('menu') ?>
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?= $this->element('page_header') ?>

                <section class="content">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </section>
            </div>
            <footer class="main-footer">
                <?= $this->element('rodape') ?>
            </footer>

            <aside class="control-sidebar control-sidebar-dark">
                <?= $this->element('configuracoes') ?>
            </aside>

            <div class="control-sidebar-bg"></div>
        </div>        
    </body>
</html>
