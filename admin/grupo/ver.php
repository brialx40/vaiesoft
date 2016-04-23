<?php require('header.php'); ?>
<?php
@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "admin" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../index.php'; </script>";
   }

require "../../model/grupo.php";
require "../../model/facultad.php";
$facul = new facultad();
$gr=new grupo();
$id=$_GET['id'];
$ver=$gr->buscarGrupo($id);
?>    
<div>
    <ul class="breadcrumb">
        <li>
            <a href="../index.php">Inicio</a>
        </li>
        <li>
            <a href="index.php">Grupo de Investigaci&oacute;n</a>
        </li>
        <li>
            <a href="#">Ver</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-ok"></i> Ver Grupo</h2>
            </div>
            <div class="box-content">                
            <form class="form-inline" role="form" method="post" name="form1" id="form1" action="index.php">
                <div class="form-group">
                <input name="id_grupo" type="hidden" id="id_grupo" value="<?php echo $ver['id_grupo']?>"/>
                <label class="control-label" for="inputSuccess4">Siglas:</label>
                <input type="text" class="form-control" readonly name="siglas"  value="<?php echo $ver['siglas']?>" >
                <br/><br/>
                <label class="control-label" for="inputSuccess4">Nombre:</label>
                <input type="text" class="form-control" readonly name="nombre" id="nombre" value="<?php echo $ver['nombre']?>" >
                <br/><br/>
                <label class="control-label" for="inputSuccess4">Facultad:</label>                        
                <?php
                $facultad=$facul->buscarFacultad($ver['id_facultad']);
                echo '<input type="text" class="form-control" readonly value="'.$facultad['nombre'].'" >';
                
                ?>                
                </div>
                <br/><br/>
                <input class="btn btn-default" type="submit" name="boton" value="Aceptar" />                    
            </form>
            <br>
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

</div><!--/row-->

<?php require('footer.php'); ?>

