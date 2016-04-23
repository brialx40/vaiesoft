<?php include 'config.php' ?>
<!DOCTYPE html>
<html lang="es">
<head>
    
    <meta charset="utf-8">
    <title>Vicerrectoria Asistente de Investigaci&oacute;n y Extensi&oacute;n</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Diana Calderon">

    <!-- The styles 
    <link id="bs-css" href="../css/bootstrap-united.min.css" rel="stylesheet">-->

    <link href="../../css/bootstrap-united.min.css" rel="stylesheet">
    

    <link href="../../css/charisma-app.css" rel="stylesheet">
    <link href='../../bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='../../bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='../../bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='../../bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='../../bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='../../bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='../../css/jquery.noty.css' rel='stylesheet'>
    <link href='../../css/noty_theme_default.css' rel='stylesheet'>
    <link href='../../css/elfinder.min.css' rel='stylesheet'>
    <link href='../../css/elfinder.theme.css' rel='stylesheet'>
    <link href='../../css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='../../css/uploadify.css' rel='stylesheet'>
    <link href='../../css/animate.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="../../bower_components/jquery/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.0/css/buttons.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.11.3.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.flash.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js">
    </script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.html5.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.1.0/js/buttons.print.min.js">
    </script>
    <script type="text/javascript">
        $(document).ready(function() { 
            $('#example').DataTable( { dom: 'Bfrtip', buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print' ] } ); } );
    </script>




    <link rel="shortcut icon" href="../../img/ufps.ico">
    
</head>


<body class="dt-example">
<?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../../index.php"> <img alt="PROYECTOS FINU" src="../../img/banner2.jpg" />
                </a>           
        </div>
    </div>
    <!-- topbar ends -->
<?php } ?>
<div class="ch-container">
    <div class="row">
        <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>

        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Menu</li>
                        <li><a class="ajax-link" href="../index.php"><i class="glyphicon glyphicon-home"></i><span> Inicio</span></a>
                        </li>
                        <li><a class="ajax-link" href="../propuesta"><i
                                    class="glyphicon glyphicon-book"></i><span> Propuesta</span></a></li>
                        <li><a class="ajax-link" href="index.php"><i
                                    class="glyphicon glyphicon-list-alt"></i><span> Proyecto</span></a></li>
                        <li><a class="ajax-link" href="../convocatoria"><i
                                    class="glyphicon glyphicon-folder-open"></i><span> Convocatoria</span></a></li>
                        <li><a class="ajax-link" href="../investigador"><i
                                    class="glyphicon glyphicon-user"></i><span> Investigador</span></a></li>
                        <li><a class="ajax-link" href="../evaluador"><i
                                    class="glyphicon glyphicon-user"></i><span> Evaluador</span></a></li>
                        <li><a class="ajax-link" href="../facultad"><i
                                    class="glyphicon glyphicon-folder-close"></i><span> Facultad</span></a></li>
                        <li><a class="ajax-link" href="../grupo"><i
                                    class="glyphicon glyphicon-pencil"></i><span> Grupo de Investigaci&oacute;n</span></a></li>
                        <li><a class="ajax-link" href="../rubro"><i
                                    class="glyphicon glyphicon-usd"></i><span> Rubro</span></a></li>
                        <li><a class="ajax-link" href="../reportes"><i
                                    class="glyphicon glyphicon-file"></i><span> Reportes</span></a></li>
                        <li><a class="ajax-link" href="../../controller/cerrarsesion.php"><i
                                    class="glyphicon glyphicon-log-out"></i><span> Cerrar Sesi&oacute;n</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <?php } ?>
