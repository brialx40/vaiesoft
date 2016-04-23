<?php include 'config.php' ?>
<!DOCTYPE html>
<html lang="es">
<head>
    
    <meta charset="utf-8">
    <title>VAIE Vicerrectoria Asistente de Investigaci&oacute;n y Extensi&oacute;n</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-united.min.css" rel="stylesheet">

    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>

    <link rel="shortcut icon" href="img/ufps.ico">
    
      <!-- bootstrap select -->
     <script src="js/bootstrap-select.min.js"></script>
     <script src="js/bootstrap-select.js.map"></script>
     <script src="js/bootstrap-select.js"></script>
     
     <link href='css/bootstrap-select.css' rel='stylesheet'>
     <link href='css/bootstrap-select.css.map' rel='stylesheet'>
     <link href='css/bootstrap-select.min.css' rel='stylesheet'>
    
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
            <a class="navbar-brand" href="index.php"> <img alt="PROYECTOS FINU" src="img/banner2.jpg" />
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
                        <li><a class="ajax-link" href="registrar.php"><i class="glyphicon glyphicon-user"></i><span> Registrarse</span></a>
                        </li>
                         <li><a class="ajax-link" href="registrar_evaluador.php"><i class="glyphicon glyphicon-user"></i><span> Registrarse Par Evaluador</span></a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <?php } ?>

<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>
    </ul>
</div>

<div class="row">  
    <div class="box col-xs-6" >
        <div class="box-inner homepage-box">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list-alt"></i> Inicio Sesi&oacute;n</h2>
            </div>
            <div class="box-content">
               <form class="form-horizontal" action="controller/sesion.php" method="post">
                    <br/><br/>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                            <input type="text" class="form-control" required name="usuario" placeholder="Usuario" >
                        </div>
                        <div class="clearfix"></div><br>

                        <div class="input-group input-group-lg" style="text-align:center;">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                            <input type="password" class="form-control" required name="clave" placeholder="Contrase&ntilde;a">
                        </div>                        
                        <br/>
                        <p class="center col-md-5">
                            <button type="submit" class="btn btn-default">Ingresar</button>
                        </p>
                </form>
            </div>
        </div>
    </div>

  
    <!--/span-->
</div><!--/row-->

<?php require('footer.php'); ?>
