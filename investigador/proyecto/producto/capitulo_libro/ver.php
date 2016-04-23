<?php require('header.php'); ?>
<?php
session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "investigador" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../../../index.php'; </script>";
   }
require "../../../../model/capitulo_libro.php";

$lib=new capitulo_libro();
$id=$_GET['id'];
$ver=$lib->buscarCapituloLibro($id);

?> 
<div>
    <ul class="breadcrumb">
        <li>
          <a href="../../../index.php">Inicio</a>
        </li>
        <li>
          <a href="../../index.php">Proyecto</a>
        </li>
        <li>
          <a href="../index.php">Productos</a>
        </li>
        <li>
          <a href="index.php">Cap&iacute;tulo del Libro</a>
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
                <h2><i class="glyphicon glyphicon-ok"></i> Ver Capitulo del Libro</h2>
            </div>
            <div class="box-content">                
            <form class="form-inline" role="form" method="post" name="form1" id="form1" action="index.php?id=<?php echo $ver['id_proyecto']?>">
                <div class="form-group">
                    <label class="control-label" for="inputSuccess4">Titulo del Capitulo:</label>
                    <label class="control-label" for="inputSuccess4" style="font-weight:normal;"><?php echo $ver['titulo_capitulo']?></label>
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Titulo del Libro:</label>
                    <label class="control-label" for="inputSuccess4" style="font-weight:normal;"><?php echo $ver['titulo_libro']?></label>
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Autor(es): </label>
                    <label class="control-label" for="inputSuccess4" style="font-weight:normal;"><?php echo $ver['autor']?></label>
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">ISBN:</label>
                    <label class="control-label" for="inputSuccess4" style="font-weight:normal;"><?php echo $ver['ISBN']?></label>
                    <br/><br/>
                    <label for="fechafinalizacion" id="fechaFinalizacion">Fecha: </label>
                    <label class="control-label" for="inputSuccess4" style="font-weight:normal;"><?php echo $ver['fecha']?></label>
                    <br/><br/>                              
                    <label class="control-label" for="inputSuccess4">Editorial: </label>
                    <label class="control-label" for="inputSuccess4" style="font-weight:normal;"><?php echo $ver['editorial']?></label>
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Lugar de Publicacion: </label>
                    <label class="control-label" for="inputSuccess4" style="font-weight:normal;"><?php echo $ver['lugar_publicacion']?></label>
                    
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

