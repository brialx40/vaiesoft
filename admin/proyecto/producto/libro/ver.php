<?php require('header.php'); ?>
<?php
@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "admin" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../../../index.php'; </script>";
   }

require "../../../../model/libro.php";
$lib=new libro();
$id=$_GET['id'];
$ver=$lib->buscarLibro($id);

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
          <a href="index.php">Libro</a>
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
                <h2><i class="glyphicon glyphicon-ok"></i> Ver Libro</h2>
            </div>
            <div class="box-content">                
            <form class="form-inline" role="form" method="post" name="form1" id="form1" action="index.php?id=<?php echo $ver['id_proyecto']?>">
                <div class="form-group">
                    <label class="control-label" for="inputSuccess4">Titulo:</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $ver['titulo']?>">
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Autor(es): </label>
                    <textarea  class="form-control" name="autor" size="1000" style="width: 229px; height: 50px;"><?php echo $ver['autor']?></textarea>                        
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">ISBN:</label>
                    <input type="text" class="form-control" name="isbn" id="isbn" value="<?php echo $ver['ISBN']?>">
                    <br/><br/>
                    <label for="fechafinalizacion" id="fechaFinalizacion">Fecha: </label>
                    <input name="fecha" class="form-control" type="date" id="fecha" value="<?php echo $ver['fecha']?>"  style="width:230px" />
                    <br/><br/>                              
                    <label class="control-label" for="inputSuccess4">Editorial: </label>
                    <input type="text" class="form-control" name="editorial" id="editorial" value="<?php echo $ver['editorial']?>">
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Lugar de Publicacion: </label>
                    <input type="text" class="form-control" name="lugar_publicacion" id="lugar_publicacion" value="<?php echo $ver['lugar_publicacion']?>">
                    
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

