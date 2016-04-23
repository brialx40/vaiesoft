<?php include 'config.php' ?>
<?php 

session_start();
    $id= $_SESSION['id'] ;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    
    <meta charset="utf-8">
    <title>Vicerrectoria Asistente de Investigaci&oacute;n y Extensi&oacute;n</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles 
    <link id="bs-css" href="../css/bootstrap-united.min.css" rel="stylesheet">-->

    <link href="../css/bootstrap-united.min.css" rel="stylesheet">
    

    <link href="../css/charisma-app.css" rel="stylesheet">
    <link href='../bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='../bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='../bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='../bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='../bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='../bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='../css/jquery.noty.css' rel='stylesheet'>
    <link href='../css/noty_theme_default.css' rel='stylesheet'>
    <link href='../css/elfinder.min.css' rel='stylesheet'>
    <link href='../css/elfinder.theme.css' rel='stylesheet'>
    <link href='../css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='../css/uploadify.css' rel='stylesheet'>
    <link href='../css/animate.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="../bower_components/jquery/jquery.min.js"></script>

    <link rel="shortcut icon" href="../img/ufps.ico">
    
</head>

<body>

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
            <a class="navbar-brand" href="index.php"> <img alt="PROYECTOS FINU" src="../img/banner2.jpg" />
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
                        <li><a class="ajax-link" href="index.php"><i class="glyphicon glyphicon-home"></i><span> Inicio</span></a>
                        </li>
                        <li><a class="ajax-link" href="propuesta/index.php?id=<?php echo $id?>"><i
                                    class="glyphicon glyphicon-book"></i><span> Propuesta</span></a></li>
                        <li><a class="ajax-link" href="proyecto"><i
                                    class="glyphicon glyphicon-list-alt"></i><span> Proyecto</span></a></li>
                        <li><a class="ajax-link" href="investigador"><i
                                    class="glyphicon glyphicon-user"></i><span> Investigador</span></a></li>
                        <li><a class="ajax-link" href="reportes"><i
                                    class="glyphicon glyphicon-file"></i><span> Reportes</span></a></li>
                        <li><a class="ajax-link" href="../controller/cerrarsesion.php"><i
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
