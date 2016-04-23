<?php require('header.php'); ?>
<?php
session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "investigador") {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../../../index.php'; </script>";
   }

require "../../../../model/articulo.php";
$art=new articulo();
$id=$_GET['id'];
$ver=$art->buscarArticulo($id);

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
          <a href="index.php">Art&iacute;culo</a>
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
                <h2><i class="glyphicon glyphicon-ok"></i> Ver Articulo</h2>
            </div>
            <div class="box-content">                
            <form class="form-inline" role="form" method="post" name="form1" id="form1" action="index.php">
                <div class="form-group">
                    <label class="control-label" for="inputSuccess4">Titulo: </label>
                    <input type="text" class="form-control" value="<?php echo $ver['titulo']?>" >
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Autor(es):</label>
                    <textarea  class="form-control"  size="1000" style="width: 229px; height: 50px;"></textarea>                        
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Pagina Inicial: </label>
                    <input type="text" class="form-control" value="<?php echo $ver['pagina_inicial']?>" onkeypress="return permite(event, 'num')">
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Pagina Final:</label>
                    <input type="text" class="form-control" value="<?php echo $ver['pagina_final']?>" onkeypress="return permite(event, 'num')">
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">DOI (Digital Object Identifier):</label>
                    <input type="text" class="form-control" value="<?php echo $ver['doi']?>">
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Año:</label>
                    <input type="text" class="form-control" value="<?php echo $ver['ano_lectivo']?>" >                              
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Mes:</label>
                    <input type="text" class="form-control" value="<?php echo $ver['mes']?>" >
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Categoria: </label>
                    <input type="text" class="form-control" value="<?php echo $ver['categoria']?>" >
                    <br/><br/>            
                    <label class="control-label" for="inputSuccess4">Nombre de la Revista: </label>
                    <input type="text" class="form-control" value="<?php echo $ver['nombre_revista']?>" >
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Volumen: </label>
                    <input type="text" class="form-control" value="<?php echo $ver['volumen']?>" >
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Numero: </label>
                    <input type="text" class="form-control" value="<?php echo $ver['numero']?>">
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">ISSN: </label>
                    <input type="text" class="form-control" value="<?php echo $ver['ISSN']?>">
                    <br/><br/>
                    <label class="control-label" for="inputSuccess4">Indice Bibliografico: </label>
                    <input type="text" class="form-control" value="<?php echo $ver['indice_bibliografico']?>" >
                    <br/><br/>  
                    <label class="control-label" for="inputSuccess4">URL:</label>
                    <input type="text" class="form-control" name="url" id="url" value="<?php echo $ver['url']?>">
                    <br/><br/> 
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

