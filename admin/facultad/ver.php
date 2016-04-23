<?php require('header.php'); ?>
<?php
@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "admin" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../index.php'; </script>";
   }
   
require "../../model/facultad.php";
$fac=new facultad();
$id=$_GET['id'];
$ver=$fac->buscarFacultad($id);
?>    
<div>
    <ul class="breadcrumb">
        <li>
            <a href="../index.php">Inicio</a>
        </li>
        <li>
            <a href="index.php">Facultad</a>
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
                <h2><i class="glyphicon glyphicon-ok"></i> Ver Facultad</h2>
            </div>
            <div class="box-content">                
            <form class="form-inline" role="form" method="post" name="form1" id="form1" action="index.php">
                <div class="form-group">
                    <input name="id_facultad" type="hidden" id="id_facultad" value="<?php echo $ver['id_facultad']?>"/>
                    <label class="control-label" for="inputSuccess4">Nombre:</label>
                    <label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4"><?php echo $ver['nombre']?></label>
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

