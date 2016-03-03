<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Meu Garangau | Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <?php echo $this->Html->css('bootstrap/bootstrap.min') ?>
        <!-- Font Awesome -->
        <?php echo $this->Html->css('font-awesome.min') ?>
        <!-- Ionicons -->    
        <?php echo $this->Html->css('ionicons.min') ?>

        <!-- Theme style -->
        <?php echo $this->Html->css('AdminLTE.min') ?>
        <!-- iCheck -->
        <?php echo $this->Html->css('plugins/iCheck/square/blue.css') ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        
        <?= $this->fetch('content') ?>

        <!-- jQuery 2.1.4 -->
        <?php echo $this->Html->script('plugins/jQuery/jQuery-2.1.4.min'); ?>
        <!-- Bootstrap 3.3.5 -->
        <?php echo $this->Html->script('bootstrap.min'); ?>
        <!-- iCheck -->
        <?php echo $this->Html->script('plugins/iCheck/icheck.min'); ?>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>