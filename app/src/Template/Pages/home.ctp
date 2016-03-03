<!-- Small boxes (Stat box) -->
<section>
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion-ios-time-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Contas a Pagar</span>
                    <span class="info-box-number">10</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-bell"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Contas a Receber</span>
                    <span class="info-box-number">2</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-flower"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Contas não pagas</span>
                    <span class="info-box-number">0</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-flame"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Contas não recebidas</span>
                    <span class="info-box-number">0</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.row -->
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-7 connectedSortable">       
        <iframe frameBorder="0" scrolling="no" seamless="seamless" style="width: 100%; overflow-y: hidden; height: 1207px;" src="<?php echo $this->Url->build(['controller' => 'tarefas', 'action' => 'index', 1]) ?>"></iframe>                    
    </section><!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5 connectedSortable">

        <!-- Calendar -->
        <div class="box box-solid bg-green-gradient">
            <div class="box-header">
                <i class="fa fa-calendar"></i>
                <h3 class="box-title">Calendar</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                        <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Add new event</a></li>
                            <li><a href="#">Clear events</a></li>
                            <li class="divider"></li>
                            <li><a href="#">View calendar</a></li>
                        </ul>
                    </div>
                    <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                </div><!-- /. tools -->
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
            </div><!-- /.box-body -->
            <div class="box-footer text-black">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- Progress bars -->
                        <div class="clearfix">
                            <span class="pull-left">Task #1</span>
                            <small class="pull-right">90%</small>
                        </div>
                        <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                        </div>

                        <div class="clearfix">
                            <span class="pull-left">Task #2</span>
                            <small class="pull-right">70%</small>
                        </div>
                        <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <div class="clearfix">
                            <span class="pull-left">Task #3</span>
                            <small class="pull-right">60%</small>
                        </div>
                        <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                        </div>

                        <div class="clearfix">
                            <span class="pull-left">Task #4</span>
                            <small class="pull-right">40%</small>
                        </div>
                        <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div><!-- /.box -->

    </section><!-- right col -->
</div><!-- /.row (main row) -->