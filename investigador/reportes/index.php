<?php require('header.php'); 

session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "investigador" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../index.php'; </script>";
   }

?>
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="../index.php">Inicio</a>
            </li>
            <li>
                <a href="index.php">Reportes</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="box col-md-12">
        <div class="box-inner">
        <div class="box-header well" data-original-title="">
            <h2><i class="glyphicon glyphicon-user"></i> Reportes</h2>
        </div>

        <div class="box-content">
        <a class="btn btn-default" href="reporte_propuesta.php">
            Reporte de Propuestas
        </a> <br/><br/>
        <a class="btn btn-default" href="reporte_proyecto.php">
            Reporte de Proyectos
        </a><br/><br/>
        <a class="btn btn-default" href="reporte_investigador.php">
            Reporte de Investigadores
        </a><br/><br/>
        <a class="btn btn-default" href="reporte_evaluador.php">
            Reporte de Evaluadores
        </a><br/>
        </div>
        </div>
        </div>
    
    </div><!--/row-->

<?php require('footer.php'); ?>