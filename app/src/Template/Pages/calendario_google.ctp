<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Calendar</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->          
        <?php echo $this->Html->css('bootstrap/bootstrap.min') ?>
        <!-- Font Awesome -->
        <?php echo $this->Html->css('font-awesome.min') ?>
        <!-- Ionicons -->
        <?php echo $this->Html->css('ionicons.min') ?>
        <!-- fullCalendar 2.2.5-->
        <?php echo $this->Html->css('plugins/fullcalendar/fullcalendar.min') ?>
        <?php echo $this->Html->css('plugins/fullcalendar/fullcalendar.print', ['media' => 'print', 'rel' => 'stylesheet']) ?>
        <!-- Theme style -->
        <?php echo $this->Html->css('AdminLTE.min') ?>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <?php echo $this->Html->css('skins/_all-skins.min') ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
            .content-wrapper, .right-side, .main-footer {
                margin-left: 0px !important;
            }
            #interacao {
                display:    none;
                position:   fixed;
                z-index:    9999;
                top:        0;
                left:       0;
                height:     100%;
                width:      100%;
                background: rgba( 255, 255, 255, .8 ) 
                    url('../img/loading.gif') 
                    50% 50% 
                    no-repeat;
            }
        </style>        
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div id="interacao"></div>
        <!-- Formulário para consulta dos eventos (POST) -->
        <form method="post" name="FormCaledarioConsulta" id="FormCaledarioConsultaId">
            <input type="hidden" name="minDate" id="minDate" /> <!-- For find data in post request -->
        </form>
        <!-- Formulário para persistência dos eventos (Ajax POST) -->
        <form method="post" name="FormCaledarioPersistencia" id="FormCaledarioPersistenciaId">
            <input type="hidden" name="nmEvento" id="nmEvento" /> <!-- nome do evento -->
            <input type="hidden" name="dtEvento" id="dtEvento" /> <!-- data do evento -->
        </form>
        <div class="wrapper">           
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h4 class="box-title">Contas a pagar</h4>
                                </div>
                                <div class="box-body">
                                    <!-- the events -->
                                    <div id="external-events">
                                        <?php foreach($lancamentos as $lancamento): ?>
                                            <?php if($lancamento->consolidado = 'N' && $lancamento->valor < 0): ?>
                                                <div class="external-event bg-red"><?php echo $lancamento->descricao  . ' - R$ ' . $this->Number->precision($lancamento->valor, 2) ?></div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /. box -->
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h4 class="box-title">Contas a receber</h4>
                                </div>
                                <div class="box-body">
                                    <!-- the events -->
                                    <div id="external-events">
                                        <?php foreach($lancamentos as $lancamento): ?>
                                            <?php if($lancamento->consolidado = 'N' && $lancamento->valor >= 0): ?>
                                                <div class="external-event bg-green"><?php echo $lancamento->descricao . ' - ' . $this->Number->precision($lancamento->valor, 2); ?></div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>                                      
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /. box -->                            
                        </div><!-- /.col -->
                        <div class="col-md-9">
                            <div class="box box-primary">
                                <div class="box-body no-padding">
                                    <!-- THE CALENDAR -->
                                    <div id="calendar"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /. box -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <?php echo $this->Html->script('plugins/jQuery/jQuery-2.1.4.min'); ?>
        <!-- Bootstrap 3.3.5 -->
        <?php echo $this->Html->script('bootstrap.min'); ?>
        <!-- jQuery UI 1.11.4 -->
        <?php echo $this->Html->script('plugins/jQueryUI/jquery-ui.min'); ?>
        <!-- Slimscroll -->
        <?php echo $this->Html->script('plugins/slimScroll/jquery.slimscroll.min'); ?>
        <!-- FastClick -->
        <?php echo $this->Html->script('plugins/fastclick/fastclick.min'); ?>
        <!-- AdminLTE App -->
        <?php echo $this->Html->script('app.min'); ?>
        <!-- AdminLTE for demo purposes -->
        <?php echo $this->Html->script('demo'); ?>
        <!-- fullCalendar 2.2.5 -->
        <?php echo $this->Html->script('moment.min'); ?>
        <?php echo $this->Html->script('plugins/fullcalendar/fullcalendar.min'); ?>
        <!-- Page specific script -->
        <script type="text/javascript">
            function mostraLoading() {
                $('#interacao').show();
            }

            function ocultaLoading() {
                $('#interacao').hide();
            }

            $(function () {

                /* initialize the external events
                 -----------------------------------------------------------------*/
                function ini_events(ele) {
                    ele.each(function () {

                        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                        // it doesn't need to have a start or end
                        var eventObject = {
                            title: $.trim($(this).text()) // use the element's text as the event title
                        };

                        // store the Event Object in the DOM element so we can get to it later
                        $(this).data('eventObject', eventObject);

                        // make the event draggable using jQuery UI
                        $(this).draggable({
                            zIndex: 1070,
                            revert: true, // will cause the event to go back to its
                            revertDuration: 0, //  original position after the drag
                            start: function (e, ui) {
                            },
                            stop: function (e, ui) {
                            }
                        });

                    });
                }
                ini_events($('#external-events div.external-event'));

                /* initialize the calendar
                 -----------------------------------------------------------------*/
                //Date for the calendar events (dummy data)
                var date = new Date();
                var d = date.getDate(),
                        m = date.getMonth(),
                        y = date.getFullYear();
                var caledario = $('#calendar');
                caledario.fullCalendar({
                    header: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'month'
                    },
                    buttonText: {
                        today: 'Hoje',
                        month: 'Mês',
                        week: 'week',
                        day: 'day'
                    },
                    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
                    //Random default events
                    events: [
                        <?php
                        if (count($eventos->getItems()) > 0) {
                            foreach ($eventos->getItems() as $event):
                                if($event->start != null) {
                                $dtInicio = $event->start->dateTime;
                                $objInicio = new \DateTime($dtInicio);
                                $titulo = $event->getSummary();
                                ?>
                                {
                                    id: '<?= $event->getId(); ?>',
                                    title: '<?= $titulo ?>',
                                    start: '<?php echo $objInicio->format('Y-m-d') ?>'
                                },
                                <?php
                                }
                            endforeach;
                        }
                        ?>
                    ],
                    editable: true,
                    droppable: true, // this allows things to be dropped onto the calendar !!!
                    drop: function (date, allDay) { // this function is called when something is dropped
                        // retrieve the dropped element's stored Event Object
                        var originalEventObject = $(this).data('eventObject');

                        // we need to copy it, so that multiple events don't have a reference to the same object
                        var copiedEventObject = $.extend({}, originalEventObject);
                        // assign it the date that was reported
                        copiedEventObject.start = date;
                        copiedEventObject.allDay = allDay;
                        copiedEventObject.backgroundColor = $(this).css("background-color");
                        copiedEventObject.borderColor = $(this).css("border-color");

                        // render the event on the calendar
                        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                        // is the "remove after drop" checkbox checked?
                        if ($('#drop-remove').is(':checked')) {
                            // if so, remove the element from the "Draggable Events" list
                            $(this).remove();
                        }

                        $('#nmEvento').val(copiedEventObject.title);
                        $('#dtEvento').val(date.format());

                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "<?= $this->Url->build(['controller' => 'pages', 'action' => 'registrarEvento']) ?>",
                            data: $('#FormCaledarioPersistenciaId').serialize(),
                            success: function (data) {
                                console.log(data);
                            }
                        });

                    }
                });
            });

            $(document).ready(function () {
                $('.fc-prev-button,.fc-next-button,.fc-today-button').click(function () {
                    var minDate = $("#calendar").fullCalendar('getDate').format();
                    $('#minDate').val(minDate);
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "<?= $this->Url->build(['controller' => 'pages', 'action' => 'calendarioGoogle', '1']) ?>",
                        data: $('#FormCaledarioConsultaId').serialize(),
                        success: function (events) {
                            $('#calendar').fullCalendar('removeEvents');
                            $('#calendar').fullCalendar('addEventSource', events);
                            $('#calendar').fullCalendar('rerenderEvents');
                        }
                    });
                });

                $body = $("body");
                $(document).on({
                    ajaxStart: function () {
                        mostraLoading();
                    },
                    ajaxStop: function () {
                        ocultaLoading();
                    }
                });
            });


        </script>
    </body>
</html>
