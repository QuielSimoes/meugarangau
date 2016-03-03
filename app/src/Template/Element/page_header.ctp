<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= isset($title) ? $title : "Dashboard" ?>
        <small>Painel de Controle</small>
    </h1>
    <?php
    echo $this->Html->getCrumbList(
        [
            'firstClass' => false,
            'lastClass' => 'active',
            'class' => 'breadcrumb'
        ],
        [
            'text' => $this->Html->tag('i', '', ['class' => 'fa fa fa-home']) . '&nbsp;Home',
            'url' => ['controller' => 'pages', 'action' => 'home'],
            'escape' => false
        ]
    ); ?>
</section>